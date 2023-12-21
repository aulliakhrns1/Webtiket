<?php $this->load->view('./template/A_header.php'); ?>
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
    <div class="container mt-5">
        <h2>List Pemesanan</h2>
		<div class="mb-3">
		<input type="text" class="form-control" id="search" placeholder="Cari Nama Pesanan">
		</div>

		<table class="table" id="tiketTable">
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nama Tiket</th>
                    <th scope="col">Tiket</th>
                    <th scope="col">Seat</th>
                    <th scope="col">Tanggal Pembelian</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Kode Pembayaran</th>
					<th scope="col">Jenis Pembayaran</th>
					<th scope="col">Status</th>
					<th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($data_pesanan as $pesanan) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $pesanan->user; ?></td>
                        <td><?php echo $pesanan->nama_tiket; ?></td>
                        <td><?php echo $pesanan->tiket; ?></td>
                        <td><?php echo $pesanan->seat; ?></td>
                        <td><?php echo $pesanan->tanggal_pembelian; ?></td>
                        <td><?php echo $pesanan->tanggal; ?></td>
                        <td><?php echo $pesanan->jumlah; ?></td>
                        <td><?php echo $pesanan->harga; ?></td>
						<td><?php echo $pesanan->kode_pembayaran; ?></td>
						<td><?php echo $pesanan->Jenis_pembayaran; ?></td>
						<td>
							<?php
								if ($pesanan->status == 1) {
									echo '<span class="badge bg-success">Terbayar</span>';
								} elseif ($pesanan->status == 0) {
									echo '<span class="badge bg-warning">Belum Terbayar</span>';
								} elseif ($pesanan->status == 2) {
									echo '<span class="badge bg-danger">Batal</span>';
								} else {
									echo 'Status tidak valid';
								}
							?>
						</td>
						<td>
						<form action="<?php echo base_url()?>index.php/admin/action" method="post">
						<input type="hidden" class="form-control" name="id_order" id="exampleFormControlInput1" value="<?php echo $pesanan->id_order; ?>">
						<input type="hidden" class="form-control" name="status" id="exampleFormControlInput1" value="1">
							<button type="submit" class="btn btn-success btn-sm m-1">Confirm</button>
							</form>
						<form action="<?php echo base_url()?>index.php/admin/actionbatal" method="post">
							<input type="hidden" class="form-control" name="id_order" id="exampleFormControlInput1" value="<?php echo $pesanan->id_order; ?>">
							<input type="hidden" class="form-control" name="stock" id="exampleFormControlInput1" value="<?php echo $pesanan->jumlah; ?>">
							<input type="hidden" class="form-control" name="kode_tiket" id="exampleFormControlInput1" value="<?php echo $pesanan->kode_tiket; ?>">
								<input type="hidden" class="form-control" name="stock" id="exampleFormControlInput1" value="<?php echo $pesanan->stock_lama; ?>">
							<input type="hidden" class="form-control" name="status" id="exampleFormControlInput1" value="2">
							<button type="submit" class="btn btn-warning btn-sm m-1">Batalkan</button>
							</form>
						<form action="<?php echo base_url()?>index.php/admin/hapus" method="post">
							<input type="hidden" class="form-control" name="id_order" id="exampleFormControlInput1" value="<?php echo $pesanan->id_order; ?>">
							<button type="submit" class="btn btn-danger btn-sm m-1">Hapus</button>
							</form>
						</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<!-- Content -->


    <!-- footer -->
    <?php $this->load->view('./template/footer.php'); ?>
    <!-- footer -->

</body>
<script>
    function searchTiket() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("tiketTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; 
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    document.getElementById("search").addEventListener("input", searchTiket);
</script>
</html>
