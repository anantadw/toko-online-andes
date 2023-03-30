<?php

namespace App\Controllers;

class GameController extends BaseController
{
    protected $gameModel;
    protected $validation;

    public function __construct()
    {
        session();
        $this->gameModel = model(\M_Game::class);
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/v_display_games', [
            'games' => $this->gameModel->findAll()
        ]);
    }

    public function create()
    {
        return view('admin/v_add_game', [
            'validation' => $this->validation
        ]);
    }

    public function store()
    {
        $rules = [
            'judul' => 'required|alpha_numeric_space|min_length[4]|is_unique[games.nama_game]',
            'stok' => 'required|numeric|greater_than[0]|less_than[1000]',
            'harga' => 'required|numeric|greater_than_equal_to[0]',
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/png,image/jpeg,image/jpg]|is_image[gambar]'
        ];

        if (!$this->validateData($this->request->getPost(), $rules)) {
            return redirect()->to(current_url())->with('validation_error', $this->validator->getErrors());
        }

        $gambar = $this->request->getFile('gambar');
        $nama_gambar = $gambar->getName();
        $gambar->move('images/games', $nama_gambar);

        $this->gameModel->save([
            'nama_game' => $this->request->getPost('judul'),
            'stok_game' => $this->request->getPost('stok'),
            'harga_game' => $this->request->getPost('harga'),
            'gambar_game' => $nama_gambar
        ]);

        return redirect()->to('/admin/games');
    }

    public function delete($id)
    {
        if ($this->request->isAJAX()) {
            if ($this->gameModel->delete($id)) {
                $response = [
                    'status' => true,
                    'message' => 'Berhasil dihapus.'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Gagal dihapus.'
                ];
            }

            return json_encode($response);
        }
    }
}
