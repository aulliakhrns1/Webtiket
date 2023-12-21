<?php $this->load->view('./template/header.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Pesanan</title>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/tf1nM3l6o8ay7wbG5l5A9uK1v7GfBPIf00FytQFAqBZjQ+M1Xa73dMECft" crossorigin="anonymous"></script>

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
        <h2>List Tiket</h2>
		<div class="mb-3">
		<input type="text" class="form-control" id="search" placeholder="Cari Nama Tiket">
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
                        <td> Rp. <?php echo $pesanan->harga; ?></td>
						<td><?php echo $pesanan->kode_pembayaran; ?></td>
						<td><?php echo $pesanan->Jenis_pembayaran; ?></td>
						<td class="text-center">
						<?php if ($pesanan->status == 1): ?>
						<span class="badge bg-success">Terbayar</span><br>
						<a type="button" class="btn btn-primary btn-sm mx-auto" href="<?php echo base_url()?>index.php/pemesanan/receipt?code=<?php echo $pesanan->kode_pembayaran; ?>">Lihat Receipt</a>
						<?php elseif ($pesanan->status == 0): ?>
						<span class="badge bg-warning">Belum Terbayar</span>
						<button type="button" class="btn btn-primary btn-sm mx-auto" data-bs-toggle="modal" data-bs-target="#belumTerbayarModal" onclick="showModalBelumTerbayar('<?php echo $pesanan->kode_pembayaran; ?>', '<?php echo $pesanan->Jenis_pembayaran; ?>','<?php echo $pesanan->harga; ?>')">Detail</button>
						<?php elseif ($pesanan->status == 2): ?>
						<span class="badge bg-danger">Batal</span>
						<?php else: ?>
						Status tidak valid
						<?php endif; ?>

						</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
	<div class="modal fade" id="belumTerbayarModal" tabindex="-1" aria-labelledby="belumTerbayarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="belumTerbayarModalLabel">Detail Pembayaran</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" id="belumTerbayarModalBody">
						<p><b>Status:</b> <?php echo $pesanan->status == 0 ? 'Belum Terbayar' : 'Belum Terbayar'; ?></p>
						<p><b>Jenis Pembayaran:</b> <span id="jenisPembayaranText"></span></p>
						<p><b>Kode Pembayaran:</b> <span id="idTiketText"></span></p>
						<p><b>Harga Yang harus dibayar:</b> Rp.<span id="idHarga"></span></p>
						<p><b>Cara Pembayaran:</b>  <span id="additionalDetails"></span></p>
					</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
	function showModalBelumTerbayar(kodePembayaran, jenisPembayaran, idHarga) {
        // Pass the data to the modal content
        document.getElementById("idTiketText").innerHTML = kodePembayaran;
        document.getElementById("jenisPembayaranText").innerHTML = jenisPembayaran;
        document.getElementById("idHarga").innerHTML = idHarga;

        var additionalDetailsSpan = document.getElementById('additionalDetails');

        switch (jenisPembayaran) {
            case 'Bank':
                additionalDetailsSpan.textContent = 'Bayar ke rekening 392xxx dan masukkan kode pembayaran ke notes';
                break;
            case 'Gopay':
                additionalDetailsSpan.textContent = 'Bayar ke nomor Gopay 08123xx dan masukkan kode pembayaran ke notes';
                break;
            case 'DANA':
                additionalDetailsSpan.textContent = 'Bayar ke nomor DANA 08123xx dan masukkan kode pembayaran ke notes';
                break;
            case 'ShopeePay':
                additionalDetailsSpan.textContent = 'Bayar ke nomor ShopeePay 08123xx dan masukkan kode pembayaran ke notes';
                break;
            case 'OVO':
                additionalDetailsSpan.textContent = 'Bayar ke nomor OVO 08123xx dan masukkan kode pembayaran ke notes';
                break;
            default:
                additionalDetailsSpan.textContent = 'Tidak ditemukan data pembayaran';
                break;
        }
		$('	#belumTerbayarModal').modal('show');
    }
	
    </script>
</script>
</html>
