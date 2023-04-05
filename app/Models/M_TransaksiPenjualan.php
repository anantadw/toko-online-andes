<?php

use CodeIgniter\Model;

class M_TransaksiPenjualan extends Model
{
    protected $table            = 'transaksi_penjualan';
    protected $primaryKey       = 'no_transaksi';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['no_transaksi', 'tanggal', 'nama', 'nomor_hp', 'alamat', 'kecamatan', 'kota', 'kode_pos', 'total_transaksi'];

    public function getLastRow()
    {
        $builder = $this->db->table($this->table);
        $builder->select($this->primaryKey);
        $builder->orderBy($this->primaryKey, 'desc');
        $builder->limit(1);

        $query = $builder->get();
        $row = $query->getRowArray();

        return $row;
    }
}
