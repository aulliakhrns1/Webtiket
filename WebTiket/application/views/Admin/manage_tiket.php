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
	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/tTQa9gP7xjJ1sdV7rTzFt9GGpW1m1MfWdMqu8=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <!-- content -->
	

    <div class="container mt-5">
        <h2>List Tiket</h2>
		<div class="mb-3">
		<input type="text" class="form-control" id="search" placeholder="Cari Nama Tiket">
		</div>
		<button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#tambahTiketModal">Tambah Tiket</button>
		<table class="table" id="tiketTable">
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Kode Tiket</th>
                    <th scope="col">Level</th>
                    <th scope="col">Nama Stadium</th>
					<th scope="col">Stock</th>
					<th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($data_tiket as $tiket) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $tiket->nama_tiket; ?></td>
                        <td><?php echo $tiket->tanggal; ?></td>
                        <td><?php echo $tiket->kode; ?></td>
                        <td><?php echo $tiket->nama_level; ?></td>
                        <td><?php echo $tiket->nama_stadium; ?></td>
                        <td><?php echo $tiket->stock; ?></td>
						<td>
					<button type="button" class="btn btn-success btn-sm m-1"
						data-bs-toggle="modal" data-bs-target="#confirmationModal"
						onclick="setUpdateModalValues('<?php echo $tiket->id_tiket; ?>', '<?php echo $tiket->stock; ?>')">
						Update
					</button>
						<form action="<?php echo base_url()?>index.php/admin/hapustiket" method="post">
						<input type="hidden" class="form-control" name="id_tiket" id="exampleFormControlInput1" value="<?php echo $tiket->id_tiket; ?>">
							<button type="submit" class="btn btn-danger btn-sm m-1">Hapus</button>
							</form>
						</td>
                    </tr>
					<?php endforeach; ?>
					<!-- Modal -->
					<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Update Data</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
								<form action="<?php echo base_url()?>index.php/admin/stock" method="post">
									<input type="hidden" name="id_tiket" id="id_tiket">
									<label for="stock">Stock:</label>
									<input type="number" class="form-control" name="stock" id="stock" required min="0">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-success">Update</button>
								</div>
								</form>
							</div>
						</div>
					</div>

            </tbody>
        </table>
    </div>
	<div class="modal fade" id="tambahTiketModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
			<form action="<?php echo base_url() ?>index.php/admin/TambahTiket" method="post">
				<input type="hidden" name="id_tiket" id="id_tiket" value="">

				<label for="id_level">ID Level:</label>
				<select name="id_level" id="stadium">
				<?php foreach ($data_level as $level) : ?>
				<option value="<?php echo $level->id_level; ?>"><?php echo $level->nama_level; ?></option>
				<?php endforeach; ?>
				</select><br>

				<label for="nama">Nama:</label>
				<input type="text" name="nama" id="nama" value="">

				<label for="stadium">Stadium:</label>
				<select name="stadium" id="stadium">
					<?php foreach ($data_stadium as $stadium) : ?>
					<!-- Populate this dropdown with valid stadiums from the database -->
					<option value="<?php echo $stadium->id_stadium; ?>"><?php echo $stadium->nama_stadium; ?></option>
					<?php endforeach; ?>
					<!-- Add more options as needed -->
				</select><br>

				<label for="tanggal">Tanggal:</label>
				<input type="date" name="tanggal" id="tanggal" value="">

				<label for="stock">Stock:</label>
				<input type="number" name="stock" id="stock" value="" required min="0">
				<input type="hidden" name="kode_tiket" id="kode_tiket" value="" >

				<button type="submit" class="btn btn-success">Submit</button>
			</form>
			
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
            td = tr[i].getElementsByTagName("td")[1]; 
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

	function setUpdateModalValues($id, $stock) {
		document.getElementById('id_tiket').value = $id;
		document.getElementById('stock').value = $stock;
	}
</script>
</html>
