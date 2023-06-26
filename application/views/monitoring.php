<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nilai Kekeruhan</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($nilai as $data) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $data->kekeruhan; ?> NTU</td>
                                                <td>
                                                    <?php if ($data->status == "JERNIH") : ?>
                                                        <div class="badge badge-success">
                                                            <?= $data->status; ?>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="badge badge-danger">
                                                            <?= $data->status; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= date('d F Y H:i:s', strtotime($data->created_at)); ?></td>
                                                <td>
                                                    <a href="<?= base_url('monitoring/delete/' . $data->id); ?>" onclick="return confirm('apakah data akan dihapus?')" class="badge badge-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->