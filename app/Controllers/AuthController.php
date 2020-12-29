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

    public function simpanRegistrasi()
    {
        /*validasi sebelum simpan data dengan function rulesRegistrasi */
        if ($this->validate($this->rulesRegistrasi())) {
            
            /* Apabila sukses tervalidasi, simpan ke database */
            $this->model->save([
                'name'      => $this->request->getPost('name'),
                'email'     => $this->request->getPost('email'),
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'role'      => 'siswa',
            ]);

            /*
            - Set session flash (One Time Session) sbg pesan registrasi berhasil
            - yg ditampung dalam variabel 'registrasi_sukses'
            */
            session()->setFlashdata('registrasi_sukses', 'Registrasi Berhasil');

            /* redirect tetap ke halaman registrasi, utk menunjukan pesan registrasi berhasil */
            return redirect()->to('/registrasi');
        } else {
            /*
            - Apabila input tdk valid dgn rulesRegistrasi
            - redirect ke halaman registrasi dgn input datanya, sehingga input yg sudah benar ter-Input tdk hilang
            */
            return redirect()->to('/registrasi')->withInput();
        }
    }

    public function rulesRegistrasi()
    {
        $setRules = [
            'name'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Nama Harus Diisi'
                ]
            ],
            'email' => [
                'rules'     => 'required|valid_email|is_unique[users.email]',
                'errors'    => [
                    'required'      => 'Email Harus Diisi',
                    'valid_email'   => 'Email Anda Tidak Valid',
                    'is_unique'     => 'Email (value) Sudah Ada'
                ]
            ],
            'password'  => [
                'rules'     => 'required|min_length[8]',
                'errors'    => [
                    'required'      => 'Password Harus Diisi',
                    'min_length'    => 'Password Minimal {param} Karakter'
                ]
            ],
            'konfirmasi_password'   => [
                'rules'     => 'required|matches[password]',
                'errors'    => [
                    'required'  => 'Konfirmasi Password Harus Diisi',
                    'matches'   => 'Konfirmasi Password Berbeda Dengan {param}',       
                ]
            ]
        ];

        return $setRules;
    }

    public function login()
    {
        $data = [
            'validation'    => \config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function prosesLogin()
    {
        if ($this->validate($this->rulesLogin())) {
            
            $query  = $this->model->where('email', $this->request->getPost('email'));
            $count  = $query->countAllResults(false);
            $data   = $query->get()->getRow();

            if ($count > 0) {

                $hashPassword = $data->password;

                if (password_verify($this->request->getPost('password'), $hashPassword)) {

                    $session = [
                        'role'      => $data->role,
                        'logged_in' => TRUE
                    ];
                    session()->set($session);

                    return redirect()->to(base_url('home'));
                } else {
                    return redirect()->to(base_url('login'))->with('login_failed', 'Username / Password Anda Salah');
                }
            } else {
                return redirect()->to(base_url('login'))->with('login_failed', 'Username Tidak Ditemukan');
            }
        } else {
            return redirect()->to(base_url('login'))->withInput();
        }
    }

    public function rulesLogin()
    {
        $setRules = [
            'email' => [
                'rules'     => 'required|valid_email',
                'errors'    => [
                    'required'      => 'Email Harus Diisi',
                    'valid_email'   => 'Email Anda Tidak Valid',
                ]
            ],
            'password'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Password Harus Diisi',
                ]
            ]
        ];

        return $setRules;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}