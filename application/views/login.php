<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">
    <div class="toastr-success" data-flashdata="<?= $this->session->flashdata('toastr-success'); ?>"></div>
    <div class="toastr-error" data-flashdata="<?= $this->session->flashdata('toastr-error'); ?>"></div>

    <div class="login-box mb-5">
        <!-- /.login-logo -->
        <div class="text-center">
            <img src="<?= base_url('assets/image/phb.png'); ?>" alt="logo phb" class="img-fluid" width="170">
            <h3 class="mb-5">Smart Aquarium Berbasis IoT</h3>
        </div>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">

                <h4>Form Login</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('auth/proses'); ?>" method="post" id="form-login">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="username" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>

    <script src="<?= base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/toastr/customScript.js"></script>

    <script>
        $(document).ready(function() {

            $("#form-login").validate({
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true,
                    }
                },
                messages: {
                    username: {
                        required: "harap isi username"
                    },
                    password: {
                        required: "harap isi password"
                    }
                },
                errorPlacement: function(label, element) {
                    label.addClass('arrow text-sm text-danger');
                    label.insertAfter(element);
                },
                wrapper: 'span'
            });
        });
    </script>

</body>

</html>