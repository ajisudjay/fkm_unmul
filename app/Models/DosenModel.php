<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'dosen';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'nama', 'bidang', 'homebase', 'jabatan', 'pendidikan', 'nip', 'gambar', 's1', 'sp', 's2', 's3', 'nidn', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'telp', 'email', 'golongan', 'pangkat', 'jk', 'sinta', 'gs', 'admin', 'timestamp'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
