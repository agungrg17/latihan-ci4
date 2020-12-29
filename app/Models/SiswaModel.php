<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{

    protected $table = 'siswa';
    protected $allowFields = ['name', 'nis', 'tgl_lahir'];
}