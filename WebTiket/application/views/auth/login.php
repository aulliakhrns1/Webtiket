<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('/style/style.css')?>">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>


    <!-- header -->
	<?php $this->load->view('./template/header.php'); ?>
    <!-- header -->

    <!-- Content -->
    <div class="container-fluid container_height">
        <div class="container-xxl">
        <div class="d-flex h-100 justify-content-center align-items-center">
            <div class="d-block">
                <h1 class="text-center my-lg-5 my-md-5 my-sm-5 my-4">LOGIN</h1>
                <form action="<?php echo base_url()?>index.php/auth/checklogin" method="POST">
                    <input type="text" class="form-control input_login" placeholder="Masukkan Username" name="username">
                    <input type="password" class="form-control my-lg-3 my-md-3 my-sm-3 my-2 input_login" placeholder="Masukkan Password" name="password">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <p class="mb-5 text-center text_login">Belum Memiliki Akun? <a href="<?php echo base_url()?>index.php/auth/register">Klik disini untuk Daftar</a></p>
            </div>
        </div>
        </div>
    </div>
    <!-- Content -->

    <!-- footer -->
    <div class="container-fluid">
        <div class="row">
        <div class="col-12 py-3 bg_color1">
            <div class="container-xxl text_footer">
            </div>
        </div>
        </div>
    </div>
    <!-- footer -->
</body>

</html>
