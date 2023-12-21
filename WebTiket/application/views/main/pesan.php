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
        <form action="<?php echo base_url()?>index.php/pemesanan/pesanan" method="POST">
            <div class="container-xxl justify-content-center w-50">
                <div class="row justify-content-center container_register p-2 bg_color1 text-dark">
				<?php foreach ($data_tiket_pesan as $tiket) : ?>
                        <div class="form-check">
                                <b><?php echo $tiket->nama_tiket; ?></b> <br>
                                <?php echo $tiket->nama_level; ?> <br>
                                <?php echo $tiket->tanggal; ?><br>
                                <b>Seat:</b><br>
                                <?php echo $tiket->nama_seat; ?>	
                        </div>
                    <?php endforeach; ?>
					<br>
				<input type="hidden" name="kode_tiket"  value="<?php echo $tiket->kode; ?>">
				<input type="hidden" name="tanggal"  value="<?php echo $tiket->tanggal; ?>">
				<input type="hidden" name="level_tiket" value="<?php echo $tiket->nama_level; ?>">
				<input type="hidden" name="nama_seat" value="<?php echo $tiket->nama_seat; ?>">
				<input type="hidden" name="nama_tiket" value="<?php echo $tiket->nama_tiket; ?>">
				<input type="hidden" name="harga"  value="<?php echo $tiket->harga; ?>">
				<input type="hidden" name="code" value="<?php echo $this->input->get('code'); ?>">
				<input type="hidden" name="stock"  value="<?php echo $tiket->stock; ?>">
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="user" id="exampleFormControlInput1"
                            placeholder="Masukkan Nama" value="<?php echo $this->session->userdata['nama']?>">
                    </div>
                    <!-- Username -->

                    <!-- Date Input -->
                    <!-- <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="exampleFormControlInput2" required>
                    </div> -->
                    <!-- Date Input -->

                 <!-- Total Ticket Input -->
				<div class="mb-3">
					<label for="exampleFormControlInput3" class="form-label">Jumlah Tiket</label>
					<input type="number" class="form-control" name="jumlah_tiket" id="exampleFormControlInput3"
						placeholder="Masukkan Jumlah Tiket" required min="0">
				</div>

				<div class="btn-group">
					<button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#paymentMethods" aria-expanded="false" aria-controls="paymentMethods">
						Pilih Metode Pembayaran
					</button>
                </div>
				<div class="collapse" id="paymentMethods">
						<div class="card card-body ">
						<!-- Radio -->
						<div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
							<input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off" checked value="Bank">
							<label class="btn btn-outline-primary" for="vbtn-radio1">Bank</label>
							<input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" autocomplete="off" value="Gopay">
							<label class="btn btn-outline-primary" for="vbtn-radio2">Gopay</label>
							<input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" autocomplete="off" value="DANA">
							<label class="btn btn-outline-primary" for="vbtn-radio3">DANA</label>
							<input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio4" autocomplete="off" value="QRis">
							<label class="btn btn-outline-primary" for="vbtn-radio4">QRis</label>
							<input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio5" autocomplete="off" value="OVO">
							<label class="btn btn-outline-primary" for="vbtn-radio5">OVO</label>
							<input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio6" autocomplete="off" value="ShopeePay">
							<label class="btn btn-outline-primary" for="vbtn-radio6">ShopeePay</label>
							</div>
						<!-- Radio -->
					</div>
				</div>
            </div>
            <input type="hidden" class="input_register form-control" name="status" value="1">
            <!-- Button -->
            <div class="d-grid gap-2 col-3 mx-auto">
                <button type="submit" class="btn btn-primary">Pesan</button>
                <a class="btn btn-primary " href="index.php">Batal</a>
            </div>
            <!-- Button -->
        </form>
    </div>
    <!-- content -->

    <!-- footer -->
    <?php $this->load->view('./template/footer.php'); ?>
    <!-- footer -->
</body>

</html>
