<?php

use CodeIgniter\Model;

class M_Game extends Model
{
    protected $table            = 'games';
    protected $primaryKey       = 'id_game';
    protected $allowedFields = ['nama_game', 'stok_game', 'harga_game', 'gambar_game'];
}
