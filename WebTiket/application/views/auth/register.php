<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <!-- header -->
  <?php $this->load->view('./template/header.php'); ?>
    <!-- header -->

    <!-- content -->
    <div class="container-fluid py-3">
        <div class="text-center title_register my-3">
            <h2>Register</h2>
        </div>
        <form action="<?php echo base_url()?>index.php/auth/register_user" method="POST">
            <div class="container-xxl d-flex justify-content-center">
                <div class="row justify-content-center container_register p-2 bg_color1 text-dark">
				<input type="hidden" class="form-control" name="id_user" id="exampleFormControlInput1" value="">
                    <!-- Username -->
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Username</label>
						<input type="text" class="form-control" name="username" id="exampleFormControlInput1" placeholder="Masukkan Username">
						</div>
                    <!-- Username -->
					<!-- Email -->
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Email</label>
						<input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Masukkan Email">
						</div>
					<!-- Email -->
                 	<!-- Password -->
				 	<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Password</label>
						<input type="password" class="form-control" name="password" id="exampleFormControlInput1" placeholder="Masukkan Password">
						</div>
                    <!-- Password -->

                </div>
            </div>
			<input type="hidden" class="input_register form-control" name="status" value="1">
            <!-- Button -->
            <div class="d-grid gap-2 col-3 mx-auto">
                <button type="submit" class="btn btn-primary">Register</button>
                <a class="btn btn-primary " href="<?php echo base_url()?>index.php/auth/login">Batal</a>
            </div>
            <!-- Button -->
        </form>
    </div>
    <!-- content -->

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
