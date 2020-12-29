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
    <table class="table-bordered table-striped">
        <tr>
            <th>Nama</th>
            <th>NIS</th>
            <th>Tanggal Lahir</th>
        </tr>
        <tr>
            <td>Andi Saputra</td>
            <td>101</td>
            <td>2003-12-22</td>
        </tr>
        <tr>
            <td>Budi Cahya</td>
            <td>102</td>
            <td>2004-01-30</td>
        </tr>
    </table>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">
        Anda Tidak Memiliki Akses Untuk Melihat Data
        </div>
    <?php endif; ?>

    <?= $this->endSection(); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>