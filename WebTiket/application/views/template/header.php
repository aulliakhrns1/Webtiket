<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h, initial-scale=1.0">
    <title>Soccer Tickets</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Poppins:wght@100;300;400;700&family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
		<link rel="stylesheet" href="<?= base_url('assets/style.css'); ?>">
<style>
  .navbar-nav li.nav-item a.nav-link:hover {
    color: red; /* Ganti warna sesuai keinginan */
  }
</style>
<!-- Mengecheck apakah user sudah login atau belum menggunakan session -->
<?php if (!isset($this->session->userdata['nama'])): ?>
    <nav class="navbar navbar-expand-lg bg-black flex-end">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="<?php echo base_url()?>index.php/pemesanan">SOCCER TICKETS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse  justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="<?php echo base_url()?>index.php/pemesanan">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/pemesanan/about">ABOUT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/auth/login">LOGIN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/auth/register">REGISTER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/pemesanan/contact">CONTACT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/pemesanan/faq">FAQ</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php else: ?>
	<nav class="navbar navbar-expand-lg bg-black flex-end">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="<?php echo base_url()?>index.php/pemesanan">SOCCER TICKETS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse  justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="<?php echo base_url()?>index.php/pemesanan">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/pemesanan/about">About</a>
        </li>
		<li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/pemesanan/tiket">Pesan</a>
        </li>
				<li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/pemesanan/listPesanan">List Pesanan</a>
        </li>
				<li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/pemesanan/contact">CONTACT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/pemesanan/faq">FAQ</a>
        </li>
				<li class="nav-item">
          <a class="nav-link text-white" href="<?php echo base_url()?>index.php/auth/logout">Logout</a>
        </li>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php endif; ?>
  </head>
</head>
<body>
