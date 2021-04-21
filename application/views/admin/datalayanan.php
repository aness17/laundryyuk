<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- Data JenisLayanan     -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="h3 mb-2 text-gray-800">Jenis Layanan</h1>
            <a href="<?= base_url('index.php/superadmin/addlayanan') ?>" type="button" class="btn btn-success text-white btn-sm">
                Tambah
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Estimasi Waktu</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="list">

                        <?php $no = 1;
                        $user = $this->db->query("SELECT * FROM layananld");  
                        foreach ($user->result_array() as $users) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $users['nama_layanan'] ?></td>
                                <td><?= $users['estimasi_waktu_layanan'] ?> Hari</td>
                                <td><?= $users['harga_layanan'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('index.php/superadmin/editlayanan/' . $users['id_layanan']) ?>" type="button" class="fas fa-edit" style="color:limegreen">
                                    </a>
                                    <a href="<?= base_url('index.php/superadmin/deletelayanan/' . $users['id_layanan']) ?>" type="button" class="fas fa-trash" style="color:red" onclick="return confirm('Are you sure to delete this row ?')">
                                    </a>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Data Jenis Laundry     -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="h3 mb-2 text-gray-800">Jenis Laundry</h1>
            <a href="<?= base_url('index.php/superadmin/addjenis') ?>" type="button" class="btn btn-success text-white btn-sm">
                Tambah
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Satuan</th>
                            <th>Estimasi Waktu</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="list">

                        <?php $no = 1;
                        $user = $this->db->query("SELECT * FROM jenisld");
                        foreach ($user->result_array() as $users) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $users['nama_jenis'] ?></td>                                
                                <td><?= $users['satuan_jenis'] ?></td>
                                <td><?= $users['estimasi_waktu_jenis'] ?> Hari</td>
                                <td><?= $users['harga_jenis'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('index.php/superadmin/editjenis/' . $users['id_jenis']) ?>" type="button" class="fas fa-edit" style="color:limegreen">
                                    </a>
                                    <a href="<?= base_url('index.php/superadmin/deletejenis/' . $users['id_jenis']) ?>" type="button" class="fas fa-trash" style="color:red" onclick="return confirm('Are you sure to delete this row ?')">
                                    </a>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->