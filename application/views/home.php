<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Nilai Kekeruhan Air (NTU)</span>
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="info-box-number text-success" id="kekeruhan"></span>
                                </div>
                                <div class="col-md-8">
                                    <span class="info-box-number" id="tanggal"></span>
                                </div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-xl-6 col-lg-6 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Record Data</span>
                            <span class="info-box-number" id="record"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Jadwal Pemberian Pakan Ikan
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/updateJadwal'); ?>" method="post">
                                <div class="form-group">
                                    <label>Jadwal Pagi</label>
                                    <input type="text" name="jadwal1" class="form-control js-masked-time" placeholder="__:__" value="<?= $jadwal->jadwal1; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Jadwal Siang</label>
                                    <input type="text" name="jadwal2" class="form-control js-masked-time" placeholder="__:__" value="<?= $jadwal->jadwal2; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Jadwal Malam</label>
                                    <input type="text" name="jadwal3" class="form-control js-masked-time" placeholder="__:__" value="<?= $jadwal->jadwal3; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Status Kuras
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Status Kuras</th>
                                        <th scope="col">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $kuras->status_pompa; ?></td>
                                        <td><?= date('d F Y H:i:s', strtotime($kuras->created_at)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $selesaiKuras->status_pompa; ?></td>
                                        <td><?= date('d F Y H:i:s', strtotime($selesaiKuras->created_at)); ?></td>
                                    </tr>
                                </tbody>
                            </table>
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

<script>
    function displayRealtime() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/getRealtime'); ?>",
            dataType: "json",
            success: function(response) {
                $('#kekeruhan').text(response.kekeruhan.kekeruhan)
                $('#tanggal').text(response.kekeruhan.created_at)
                $('#record').text(response.record)
                setTimeout(displayRealtime, 1000)
            }
        });
    }

    displayRealtime()
</script>