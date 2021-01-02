<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
     <!-- Navbar -->
    <!-- Extend - memanggil view lain -->
    <!-- Disini memanggil view tempalte.php di folder views/layout/template.php -->
    <?= $this->extend('layout/template'); ?>

    <!-- Section - setiap kita melakukan extend (dlm hal ini layout/template)
    * maka dia akan mencari function renderSection() yg ada di layout/template
    * maka semua code yg ada diantara $this->section('content') dan $this->endSection()
    * akan disisipkan di renderSection('content') -->
    
    <?= $this->section('content'); ?>
    
    <?php if (session()->get('role') === 'admin') : ?>
    <h3>Data Siswa</h3>
    <a href="<?= base_url('data-siswa/tambah') ?>" class="btn btn-sm btn-primary mb-2">Tambah Data Siswa</a>
    <table class="table-bordered table-striped">
        <tr>
            <th>Nama</th>
            <th>NIS</th>
            <th>Tanggal Lahir</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($siswa as $s) : ?>
        <tr>
            <td><?= $s['name'] ?></td>
            <td><?= $s['nis'] ?></td>
            <td><?= $s['tgl_lahir'] ?></td>
            <td>
                <a href="<?= base_url('data-siswa/edit/' . $s['id']) ?>" class="btn btn-warning">Edit</a>
                <form action="<?= base_url('data-siswa/delete/' . $s['id']) ?>" method="POST" class="d-inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="confirm('Apakah Anda Yakin ?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else : ?>
        <a href="<?= base_url('data-siswa') ?>">Data Siswa</a>
    <table class="table-bordered table-striped">
        <tr>
            <th>Nama</th>
            <th>NIS</th>
            <th>Tanggal Lahir</th>
        </tr>
        <?php foreach ($siswa as $s) : ?>
        <tr>
            <td><?= $s['name'] ?></td>
            <td><?= $s['nis'] ?></td>
            <td><?= $s['tgl_lahir'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
        
    <?php endif; ?>

    <?= $this->endSection(); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>