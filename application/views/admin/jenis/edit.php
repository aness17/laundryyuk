<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-7 order-xl-1 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Tambah Jenis Layanan </h3>
                        </div>
                    </div>
                </div>
                <form method="POST" action="<?= base_url('index.php/superadmin/editjenis/' . $jenis['id_jenis']) ?>">
                    <div class="card-body">
                        <?= form_open_multipart('index.php/superadmin/editjenis/' . $jenis['id_jenis']); ?>
                        <div class="pl-lg-4">
                            <div class="form-group mb-3">
                                <label class="form-control-label" for="input-username">Nama</label>
                                <input type="text" id="input-username" class="form-control" name="nama" placeholder="Nama" value="<?= $jenis['nama_jenis'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label" for="input-username">Satuan Jenis Laundry</label>
                                <input type="text" id="input-username" class="form-control" name="satuan" placeholder="Satuan Layanan" value="<?= $jenis['satuan_jenis'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label" for="input-username">Estimasi Waktu</label>
                                <input type="text" id="input-username" class="form-control" name="estimasi" placeholder="Estimasi Waktu" value="<?= $jenis['estimasi_waktu_jenis'] ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Harga Layanan</label>
                                        <input type="number" id="input-username" class="form-control" name="harga" placeholder="Harga" value="<?= $jenis['harga_jenis'] ?>" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="pl-lg-4 mt-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>