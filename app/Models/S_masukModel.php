<?php

namespace App\Models;

use CodeIgniter\Model;

class S_masukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 's_masuk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'no_disposisi', 'tgl_sm', 'no_surat', 'tgl_surat', 'perihal', 'asal_surat', 'status', 'file', 'keterangan', 'tahun', 'timestamp', 'admin',];

    public function getDistinctYears()
    {
        return $this->select('DISTINCT YEAR(tgl_sm) as tahun')->orderBy('tahun', 'DESC')->findAll();
    }

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
