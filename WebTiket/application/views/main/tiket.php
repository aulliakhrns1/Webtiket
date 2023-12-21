<?php $this->load->view('./template/header.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <!-- content -->
    <div class="container-fluid py-3">
        <div class="text-center title_register my-3">
            <h2>Pemesanan tiket</h2>
        </div>
        <div class="container-xxl d-flex justify-content-center">
            <div class="row justify-content-start container_register p-2 bg_color1 text-dark align-items-start">
                <label for="exampleFormControlInput1" class="form-label">Pilih Tiket</label>
                <?php foreach ($data_tiket as $tiket) : ?>
					<?php
                    $imgSrc = ($tiket->stock == 0) ? '..\..\assets\img\tiket-off.png' : '..\..\assets\img\tiket.jpg';
                    ?>
					 <?php if ($tiket->stock > 0) : ?>
                    <a href="<?php echo base_url()?>index.php/pemesanan/pesan?code=<?php echo $tiket->kode; ?>" class="text-decoration-none col-md-4">
					<?php else: ?>
						<a href="#" class="text-decoration-none col-md-4" disabled onclick="alert('Stock sudah habis');">
						<?php endif; ?>
                        <div class="card mb-3">
						<img src="<?php echo $imgSrc; ?>" class="card-img-top mx-auto d-block" alt="..." style="width: 100%; height: 17rem; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $tiket->nama_tiket; ?></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo $tiket->nama_level; ?></li>
                                <li class="list-group-item"><?php echo $tiket->tanggal; ?></li>
                                <li class="list-group-item"><?php echo $tiket->nama_seat; ?></li>
								<li class="list-group-item">Sisa: <?php echo $tiket->stock; ?></li>
								<li class="list-group-item">Rp.<?php echo $tiket->harga; ?></li>
                            </ul>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Button -->
    </div>
    <!-- content -->

    <!-- footer -->
    <?php $this->load->view('./template/footer.php'); ?>
    <!-- footer -->
</body>

</html>
