<?php

namespace App\Controllers;

use App\Models\SiswaModel;

class MenuController extends BaseController
{
    public function __construct()
    {
        $this->model = new SiswaModel();
    }

    public function home()
    {
        return view('beranda');
    }

    public function info_kegiatan()
    {
        return view('info');
    }

    public function data_siswa()
    {
        $data = array(
            'siswa' => $this->model->findAll(),
        );

        return view('siswa', $data);
    }
}
