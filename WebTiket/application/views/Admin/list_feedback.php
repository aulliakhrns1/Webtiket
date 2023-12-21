<?php $this->load->view('./template/A_header.php'); ?>
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
        <h2>List Feedback</h2>
		<div class="mb-3">
		<input type="text" class="form-control" id="search" placeholder="Cari Feedback">
		</div>

		<table class="table" id="tiketTable">
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">No. Telp</th>
					<th scope="col">Pesan</th>
					<th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($data_contact as $contact) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $contact->nama; ?></td>
                        <td><?php echo $contact->email; ?></td>
                        <td><?php echo $contact->notelp; ?></td>
                        <td><?php echo $contact->pesan; ?></td>
                        <td>
						<form action="<?php echo base_url()?>index.php/admin/hapuscontact" method="post">
							<input type="hidden" class="form-control" name="id_contact" id="exampleFormControlInput1" value="<?php echo $contact->id_contact; ?>">
							<button type="submit" class="btn btn-danger btn-sm m-1">Hapus</button>
							</form>
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
						<p>Status: <?php echo $pesanan->status == 0 ? 'Belum Terbayar' : 'Unknown'; ?></p>
						<p>Jenis Pembayaran: <span id="jenisPembayaranText"></span></p>
						<p>ID Tiket: <span id="idTiketText"></span></p>
						<p>Cara Pembayaran:  <span id="additionalDetails"></span></p>
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
	function showModalBelumTerbayar(kodePembayaran, jenisPembayaran) {
        // Pass the data to the modal content
        document.getElementById("idTiketText").innerHTML = kodePembayaran;
        document.getElementById("jenisPembayaranText").innerHTML = jenisPembayaran;
       
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
