<?php

namespace App\Controllers;

use App\Models\KonfigurasiModel;
use App\Models\MainmenuModel;
use App\Models\SubmenuModel;
use App\Models\MitraModel;
use App\Models\SlideshowModel;
use App\Models\PejabatModel;
use App\Models\DosenModel;
use App\Models\TendikModel;
use App\Models\BeritaModel;
use App\Models\LinkModel;
use App\Models\ProdiModel;
use App\Models\SkModel;
use App\Models\Kategori_skModel;
use App\Models\SemesterModel;

class Pages extends BaseController
{
    protected $MainmenuModel;
    protected $SubmenuModel;
    protected $MitraModel;
    protected $SlideshowModel;
    protected $PejabatModel;
    protected $DosenModel;
    protected $TendikModel;
    protected $KonfigurasiModel;
    protected $BeritaModel;
    protected $LinkModel;
    protected $ProdiModel;
    protected $SkModel;
    protected $Kategori_skModel;
    protected $SemesterModel;
    public function __construct()
    {
        $this->MainmenuModel = new MainmenuModel();
        $this->SubmenuModel = new SubmenuModel();
        $this->MitraModel = new MitraModel();
        $this->SlideshowModel = new SlideshowModel();
        $this->PejabatModel = new PejabatModel();
        $this->DosenModel = new DosenModel();
        $this->TendikModel = new TendikModel();
        $this->KonfigurasiModel = new KonfigurasiModel();
        $this->BeritaModel = new BeritaModel();
        $this->LinkModel = new LinkModel();
        $this->ProdiModel = new ProdiModel();
        $this->SkModel = new SkModel();
        $this->Kategori_skModel = new Kategori_skModel();
        $this->SemesterModel = new SemesterModel();
    }
    // BEGIN FRONTEND

    public function showFile()
    {
        $uri = current_url(true);
        $total = $uri->getTotalSegments();

        // Cek akses jika bukan 'content'
        if ($uri->getSegment(3) != 'content' && session()->get('username') == NULL) {
            return redirect()->to('/');
        }

        // Minimal harus ada 3 segment
        if ($total < 3 || $total > 10) {
            return redirect()->to('/');
        }

        helper("filesystem");

        // Ambil semua segment setelah domain
        $segments = [];
        for ($i = 2; $i <= $total; $i++) {
            $segments[] = $uri->getSegment($i);
        }

        $path = WRITEPATH . implode('/', $segments);

        // Cek file exist
        if (!is_file($path)) {
            return redirect()->to('/');
        }

        $file = new \CodeIgniter\Files\File($path, true);
        $binary = readfile($path);

        return $this->response
            ->setHeader('Content-Type', $file->getMimeType())
            ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
            ->setStatusCode(200)
            ->setBody($binary);
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'title_pages' => '',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->where('submenu.halaman', 'Fakultas')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->where('mainmenu.halaman', 'Fakultas')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->where('mainmenu.halaman', 'Fakultas')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->where('mainmenu.halaman', 'Fakultas')->findAll(11, 5),
            'konfigurasi' => $this->KonfigurasiModel->where('halaman', 'Fakultas')->first(),
            'berita' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(6),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'data_prodi' => $this->ProdiModel->orderBy('prodi', 'DESC')->findAll(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/beranda', $data);
    }

    public function prodi($slug)
    {
        $cek_prodi = $this->ProdiModel->where('slug', $slug)->first();
        $prodix = $cek_prodi['prodi'];
        $data = [
            'title' => 'Beranda',
            'title_pages' => '',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->where('submenu.halaman', $prodix)->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->where('mainmenu.halaman', $prodix)->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->where('mainmenu.halaman', $prodix)->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->where('mainmenu.halaman', $prodix)->findAll(11, 5),
            'konfigurasi' => $this->KonfigurasiModel->where('halaman', $prodix)->first(),
            'berita' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(6),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'data_prodi' => $this->ProdiModel->where('prodi', $prodix)->findAll(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/berandaprodi', $data);
    }

    public function pages($slug)
    {
        $uri = current_url(true);
        $slugx = $uri->getSegment(2); // Method - instrument
        $cek_menu = $this->SubmenuModel->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->where('slug', $slugx)->first();
        $judul = $cek_menu['mainmenu'];
        $halaman = $cek_menu['halaman'];
        $data = [
            'title' => '',
            'title_pages' => $judul,
            'slug'  => $slug,
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->where('mainmenu.halaman', $halaman)->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->where('mainmenu.halaman', $halaman)->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->where('mainmenu.halaman', $halaman)->findAll(6),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->where('mainmenu.halaman', $halaman)->findAll(7, 6),
            'content' => $this->SubmenuModel->where('slug', $slugx)->findAll(),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'data_prodi' => $this->ProdiModel->orderBy('prodi', 'DESC')->findAll(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];


        return view('frontend/pages/pages', $data);
    }

    public function dosen()
    {
        $data = [
            'title' => 'SDM',
            'title_pages' => 'Tenaga Pendidik',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(7, 6),
            'dosens2kesmas' => $this->DosenModel->orderBy('nip', 'ASC')->where('homebase', 'S2 Kesehatan Masyarakat')->get()->getResultArray(),
            'dosens1kesmas' => $this->DosenModel->orderBy('nip', 'ASC')->where('homebase', 'S1 Kesehatan Masyarakat')->get()->getResultArray(),
            'dosengizi' => $this->DosenModel->orderBy('nip', 'ASC')->where('homebase', 'S1 Gizi')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/dosen', $data);
    }

    public function dosen_detail($nip)
    {
        $data = [
            'title' => 'Dosen',
            'title_pages' => 'Dosen',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(7, 6),
            'dosen' => $this->DosenModel->where('nip', $nip)->first(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/dosen-detail', $data);
    }

    public function tendik()
    {
        $data = [
            'title' => 'SDM',
            'title' => 'SDM',
            'title_pages' => 'Tenaga Kependidikan',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(7, 6),
            'tendik' => $this->TendikModel->orderBy('nip', 'ASC')->orderBy('nama', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/tendik', $data);
    }

    public function sk()
    {
        $data = [
            'title' => 'SK',
            'title_pages' => 'Surat Keputusan',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(7, 6),
            'sk' => $this->SkModel->orderBy('tanggal', 'DESC')->select('*')->select('sk.id as id_sk')->select('kategori_sk.kategori as nama_kategori')->select('semester.semester as nama_semester')->join('kategori_sk', 'kategori_sk.id=sk.kategori')->join('semester', 'semester.id=sk.semester')->get()->getResultArray(),
            'kategori_sk' => $this->Kategori_skModel->orderBy('kategori', 'ASC')->get()->getResultArray(),
            'semester' => $this->SemesterModel->orderBy('semester', 'DESC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/sk', $data);
    }

    public function informasi()
    {
        $data = [
            'title' => 'Informasi',
            'title_pages' => '',
            'slug'  => 'Berita, Artikel dan Kegiatan',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(7, 6),
            'berita' => $this->BeritaModel->first(),
            'berita10' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(10),
            'populer' => $this->BeritaModel->orderBy('dilihat', 'DESC')->findAll(3),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
            'terbaru' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(3),
            'beritalengkap' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(),
        ];
        return view('frontend/pages/informasi', $data);
    }

    public function informasi_kategori($kategori)
    {
        $data = [
            'title' => 'Informasi',
            'title_pages' => '',
            'judul'  => $kategori,
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(7, 6),
            'berita_kategori' => $this->BeritaModel->where('kategori', $kategori)->orderBy('tanggal', 'DESC')->findAll(),
            'populer' => $this->BeritaModel->orderBy('dilihat', 'DESC')->findAll(3),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
            'terbaru' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(3),
            'beritalengkap' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(),
        ];
        return view('frontend/pages/informasi-kategori', $data);
    }

    public function informasi_lengkap()
    {
        $data = [
            'title' => 'Informasi',
            'title_pages' => '',
            'slug'  => 'Berita, Artikel dan Kegiatan',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(7, 6),
            'berita' => $this->BeritaModel->first(),
            'beritalengkap' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(),
            'populer' => $this->BeritaModel->orderBy('dilihat', 'DESC')->findAll(3),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
            'terbaru' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(3),
        ];
        return view('frontend/pages/informasi-lengkap', $data);
    }

    public function informasi_detail($slug)
    {
        $data = [
            'title' => 'Informasi',
            'title_pages' => '',
            'slug'  => $slug,
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(7, 6),
            'berita' => $this->BeritaModel->where('slug', $slug)->first(),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'prodi' => $this->SubmenuModel->orderBy('urutan', 'ASC')->where('id_mainmenu', '25')->findAll(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
            'terbaru' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(3),
        ];
        return view('frontend/pages/informasi-detail', $data);
    }

    public function menu()
    {
        $data = [
            'title' => 'Menu',
            'title_pages' => '',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(7, 6),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'prodi' => $this->SubmenuModel->orderBy('urutan', 'ASC')->where('id_mainmenu', '25')->findAll(),
        ];
        return view('frontend/pages/menu', $data);
    }
    // END FRONTEND

    // START BACKEND
    public function beranda()
    {
        if (session()->get('username') !== NULL) {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'title' => 'Beranda',
                'lvl' => $lvl,
                'admin' => $admin,
                'foto' => $gambar,
            ];
            return view('backend/pages/beranda', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function login()
    {
        $captcha1 = rand(0, 9);
        $captcha2 = rand(0, 9);
        $captcha3 = rand(0, 9);
        $captcha4 = rand(0, 9);
        $captcha = $captcha1 . $captcha2 . $captcha3 . $captcha4;
        $data = [
            'title' => 'Login',
            'captcha' => $captcha,
        ];
        return view('backend/pages/login', $data);
    }
    // END BACKEND
}
