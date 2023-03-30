<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CartController extends BaseController
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
        // unset($_SESSION['cart']);
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

        return redirect()->to('/user/games/cart');
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
}
