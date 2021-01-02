<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<?php if (session()->get('role') === 'admin') : ?>
    <h3>Input Data Siswa</h3>
    <form action="<?= base_url('data-siswa/simpan') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="form-group row">
            <label for="nis" class="col-sm-2 col-form-label">NIS</label>
            <div class="col-sm-4">
                <input type="text" 
                class="form-control <?php if ($validation->hasError('nis')) echo 'is-invalid' ?>" 
                id="nis" name="nis" value="<?= old('nis') ?>">
                <div class="invallid-feedback">
                    <?= $validation->getError('nis') ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nama Siswa</label>
            <div class="col-sm-4">
            <input type="text" 
                class="form-control <?php if ($validation->hasError('name')) echo 'is-invalid' ?>" 
                id="name" name="name" value="<?= old('name') ?>">
                <div class="invallid-feedback">
                    <?= $validation->getError('name') ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-4">
            <input type="date" 
                class="form-control <?php if ($validation->hasError('tgl_lahir')) echo 'is-invalid' ?>" 
                id="tgl_lahir" name="tgl_lahir" value="<?= old('tgl_lahir') ?>">
                <div class="invallid-feedback">
                    <?= $validation->getError('tgl_lahir') ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
<?php else : ?>
    <div class="alert alert-danger" role="alert">
        Anda Tidak Memiliki akses untuk Melihat Data
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>