<?php

namespace App\Controllers;

use App\Models\AuthModel;

class AuthController extends BaseController
{
    public function _construct()
    {
        $this->model = new AuthModel();
    }
    public function registrasi()
    {
        $data = [
            'validation' => \config\Services::validation()
        ];
        return view('auth/registrasi', $data);
    }
}