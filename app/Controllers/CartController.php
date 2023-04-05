<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CartController extends BaseController
{
    protected $gameModel;
    protected $transaksiModel;
    protected $validation;

    public function __construct()
    {
        session();
        $this->gameModel = model(\M_Game::class);
        $this->transaksiModel = model(\M_TransaksiPenjualan::class);
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('user/v_display_games', [
            'games' => $this->gameModel->findAll()
        ]);
    }

    public function addToCart()
    {
        if ($this->request->is('post')) {
            $game = $this->gameModel->find([$this->request->getPost('id_game')]);
            $game[0]['stok_game'] = 1;

            if (isset($_SESSION['cart'])) {
                session()->push('cart', $game);
            } else {
                session()->set('cart', $game);
            }

            return redirect()->to(current_url());
        }
    }

    public function cart()
    {
        // dd(session('cart'));
        return view('user/v_display_cart');
    }

    public function quantity()
    {
        $type = $this->request->getPost('type');
        $index = $this->request->getPost('index');

        if ($type == 'add') {
            $_SESSION['cart'][$index]['stok_game'] += 1;
        } else if ($type == 'subtract') {
            $_SESSION['cart'][$index]['stok_game'] -= 1;
            if ($_SESSION['cart'][$index]['stok_game'] == 0) {
                unset($_SESSION['cart'][$index]);
            }
        }

        if (count($_SESSION['cart']) == 0) {
            unset($_SESSION['cart']);
        }

        return redirect()->to('/user/cart');
    }

    public function deleteItem()
    {
        $index = $this->request->getPost('index');
        unset($_SESSION['cart'][$index]);

        if (count($_SESSION['cart']) == 0) {
            unset($_SESSION['cart']);
        }

        return redirect()->to(current_url());
    }

    public function checkout()
    {
        $last_row = $this->transaksiModel->getLastRow();
        if (!$last_row) {
            $new_no_transaksi = 'INV/' . date('Ymd') . '/TR00001';
        } else {
            $date = substr($last_row['no_transaksi'], 4, 8);
            $id = (int) substr($last_row['no_transaksi'], 15);
            if ($date == date('Ymd')) {
                $new_no_transaksi = 'INV/' . date('Ymd')  . sprintf('/TR%05s', $id + 1);
            } else {
                $new_no_transaksi = 'INV/' . date('Ymd') . '/TR00001';
            }
        }

        $total_harga = 0;
        foreach (session('cart') as $game) {
            $total_harga += $game['harga_game'] * $game['stok_game'];
        };

        return view('user/v_display_checkout', [
            'no_transaksi' => $new_no_transaksi,
            'total_harga' => $total_harga
        ]);
    }

    public function store()
    {
        $db = db_connect();

        $db->transBegin();
        try {
            $data = [
                'no_transaksi' => $this->request->getPost('no_transaksi'),
                'tanggal' => date('Y-m-d H:i:s'),
                'nama' => $this->request->getPost('nama'),
                'nomor_hp' => $this->request->getPost('no_telepon'),
                'alamat' => $this->request->getPost('alamat'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kota' => $this->request->getPost('kota'),
                'kode_pos' => $this->request->getPost('kodepos'),
                'total_transaksi' => $this->request->getPost('total_harga')
            ];
            $this->transaksiModel->save($data);

            $builder = $db->table('jual');
            $jual = [];
            foreach (session('cart') as $game) {
                $temp = [
                    'no_transaksi' => $this->transaksiModel->insertID,
                    'id_game' => $game['id_game'],
                    'jumlah_jual' => $game['stok_game'],
                    'harga_jual' => $game['harga_game'] * $game['stok_game']
                ];
                array_push($jual, $temp);
            }
            $builder->insertBatch($jual);

            $db->transCommit();
        } catch (\Exception $e) {
            $db->transRollback();
        }

        $db->close();
        unset($_SESSION['cart']);

        return redirect()->to('user/games')->with('message', 'Transaksi Berhasil!');
    }
}
