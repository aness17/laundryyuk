<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="h3 mb-2 text-gray-800">Data Seluruh Customer</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>

                        </tr>
                    </thead>
                    <tbody class="list">

                        <?php $no = 1;
                        $user = $this->db->query("SELECT * FROM user where fk_role = '1'");
                        foreach ($user->result_array() as $users) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $users['nama_cs'] ?></td>
                                <td><?= $users['email_cs'] ?></td>
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