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

    public function tambahSiswa()
    {
        $data = [
            'validation'    => \Config\Services::validation()
        ];
        return view('tambah_siswa', $data);
    }

    public function simpanSiswa()
    {
        if ($this->validate($this->rulestambahSiswa())) 
        {

        $data = array(
            'nis'       => $this->request->getVar('nis'),
            'name'      => $this->request->getVar('name'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
        );

        $this->model->insert($data);

        return redirect()->to(base_url('data-siswa'));
        } else {
            return redirect()->to(base_url('data-siswa/tambah'))->withInput();
        }
    }

    public function rulestambahSiswa()
    {
        $setRules   = [
            'nis'       => [
                'rules'     => 'required|is_unique[siswa.nis]',
                'errors'    => [
                    'required'  => 'NIS Harus Diisi',
                    'is_unique' => 'NIS Sudah Ada'
            ]
                ],
        'name'  => [
            'rules'     => 'required',
            'errors'    => [
                'required'  => 'Nama Harus Diisi'
            ]
            ],
        'tgl_lahir' => [
            'rules'     => 'required',
            'errors'    => [
                'required'  => 'Tanggal Lahir Harus Diisi'
            ]
        ]
        ];
        
        return $setRules;

    }

    public function editSiswa($id)
    {
        $data = array(
            'siswa' => $this->model->find($id),
        );

        return view('edit_siswa', $data);
    }

    public function updateSiswa($id)
    {
        $data = array(
            'nis'       => $this->request->getVar('nis'),
            'name'      => $this->request->getVar('name'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
        );

        $this->model->update($id, $data);
        return redirect()->to(base_url('data-siswa'));
    }

    public function deleteSiswa($id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('data-siswa'));
    }
}
