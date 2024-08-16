<?php

namespace App\Controllers;

use App\Models\SkModel;
use App\Models\Kategori_skModel;
use App\Models\SemesterModel;
use App\Controllers\BaseController;

class Sk_view extends BaseController
{
    protected $SkModel;
    protected $Kategori_skModel;
    protected $SemesterModel;
    public function __construct()
    {
        $this->SkModel = new SkModel();
        $this->Kategori_skModel = new Kategori_skModel();
        $this->SemesterModel = new SemesterModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Surat Keputusan',
            'semester' => $this->SemesterModel->orderBy('semester', 'DESC')->get()->getResultArray(),
        ];
        return view('backend/sk_view/index', $data);
    }
    public function view()
    {
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $semesterx = $request->getVar('semesterx');
            $data = [
                'sel_semester' => $this->SemesterModel->where('id', $semesterx)->first(),
                'sk' => $this->SkModel->orderBy('tanggal', 'DESC')->select('*')->select('sk.id as id_sk')->select('kategori_sk.kategori as nama_kategori')->select('semester.semester as nama_semester')->where('sk.semester', $semesterx)->join('kategori_sk', 'kategori_sk.id=sk.kategori')->join('semester', 'semester.id=sk.semester')->get()->getResultArray(),
                'kategori_sk' => $this->Kategori_skModel->orderBy('kategori', 'ASC')->get()->getResultArray(),
                'semester' => $this->SemesterModel->orderBy('semester', 'DESC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/sk_view/view', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }
}
