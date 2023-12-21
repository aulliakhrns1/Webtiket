<!-- header -->
<?php $this->load->view('./template/header.php'); ?>
    <!-- header -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('../assets/style.css');?>" media="all"/>
</head>

<body>
    <div class="container">

        <div class="card-container">
            <div class="left">
                <div class="left-container">
                    <h2>Tentang Kami</h2>
                    <p>Tetap terhubung dengan kami melalui media sosial kami atau hubungi tim dukungan kami untuk pertanyaan lebih lanjut. Kami berkomitmen untuk memberikan layanan terbaik</p>
                    <br>
                    <p>Terima kasih telah memilih Soccer Tickets sebagai mitra pemesanan tiket sepak bola Anda.</p>
                </div>
            </div>
            <div class="right">
                <div class="right-container">
				<form action="<?php echo base_url()?>index.php/pemesanan/sendFeedback" method="POST">
                        <h2 class="lg-view">Hubungi Kami</h2>
                        <h2 class="sm-view">Hubungi Kami</h2>
                        <input type="hidden" name="id_contact" value="">
						<input type="text" name="nama" placeholder="Nama">
                        <input type="email" name="email" placeholder="Alamat Email">
                        <input type="phone" name="notelp" placeholder="Telepone" autocomplete="off">
                        <textarea rows="10" name="pesan" placeholder="Pesan"></textarea>
                        <button type="submit" name="submit">Kirim</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
<!-- Footer -->
<?php $this->load->view('./template/footer.php'); ?>
