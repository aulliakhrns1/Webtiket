<?php header("Refresh: 10; URL=../pemesanan/listPesanan");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCCER TICKET</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .ticket {
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Adjusted max-width for a wider box */
            width: 100%;
            position: relative;
        }

        .banner {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .ticket-header h2 {
            color: #333;
            margin: 0;
        }

        .label {
            font-weight: bold;
        }

        .ticket-details {
            margin-top: 20px;
        }

        .ticket-details p {
            margin: 5px 0;
        }

        .barcode {
            text-align: center;
            margin-top: 20px;
        }

        .barcode img {
            max-width: 100%;
            height: auto;
        }

        @media print {
            body {
                background-color: #fff;
            }
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="banner">
            <p><img src="https://www.freeiconspng.com/thumbs/soccer-ball-png/soccer-ball-png-33.png" style="width: 20px;"> </img>Enjoy the Soccer Game!<img src="https://www.freeiconspng.com/thumbs/soccer-ball-png/soccer-ball-png-33.png" style="width: 20px;"> </p>
        </div>
        <div class="ticket-header">
            <h2>SOCCER TICKET</h2>
        </div>
        <?php foreach ($data_receipt as $receipt) : ?>
            <div class="ticket-details">
			<table style="width: 100%;">
                    <tr>
                        <td>Booking Date</td>
						<td>:</td>
                        <td><?php echo $receipt->tanggal_pembelian; ?></td>
						<td>Date</td>
						<td>:</td>
                        <td><?php echo $receipt->tanggal; ?></td>
                    </tr>
                    <tr>
                        <td>User Name</td>
						<td>:</td>
                        <td><?php echo $receipt->user; ?></td>
						<td>Ticket Level</td>
						<td>:</td>
                        <td><?php echo $receipt->tiket; ?></td>
                    </tr>
                    <tr>
                        <td>Seat Name</td>
						<td>:</td>
                        <td><?php echo $receipt->seat; ?></td>
						<td>Jumlah Tiket</td>
						<td>:</td>
						<td><?php echo $receipt->jumlah; ?></td>
                    </tr>
                </table>
                <p class="label">Kode Tiket:</p>
                <p><strong><?php echo $receipt->kode_tiket; ?></strong></p>
            </div>
        <?php endforeach; ?>
    </div>

    <script>window.print();</script>
</body>
</html>
