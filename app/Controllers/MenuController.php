<?php

namespace App\Controllers;

class MenuController extends BaseController
{
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
        return view('siswa');
    }
}