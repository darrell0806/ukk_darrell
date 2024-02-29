<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <style>
        /* CSS untuk cetak */
        @media print {
            /* Sembunyikan tombol cetak */
            .no-print {
                display: none !important;
            }
        }
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px; /* Atur ukuran logo sesuai kebutuhan */
            height: auto;
            margin-bottom: 10px;
        }
        .judul {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .subjudul {
            font-size: 16px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .total-label {
            font-weight: bold;
        }
        .payment-info {
            margin-top: 10px;
            font-size: 14px;
        }
        .payment-info p {
            margin: 3px 0;
        }
        .text-center {
            text-align: center;
        }
        .mb-3 {
            margin-bottom: 3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="<?=base_url('assets/compiled/svg/obor.png')?>" alt="Logo"> 
            <h3 class="judul"><?=$title?></h3>
            <h4 class="subjudul">Kasir</h4>
        </div>

        <?php foreach ($jojo as $riz) { ?>
            <p>Kasir : <?=$riz->username?></p>
            <p>Tanggal : <?=$riz->created_at?></p>

            <table>
                <thead>
                    <tr>
                        <th scope="col">Barang</th>
                        <th class="text-center" scope="col">Qty</th>
                        <th class="text-center" scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jojo2 as $data) { ?>
                        <tr>
                            <td><?=$data->NamaProduk?></td>
                            <td class="text-center"><?=$data->JumlahProduk?></td>
                            <td class="text-center">Rp <?= number_format($data->Subtotal, 0, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="total-label text-center" colspan="2">Total :</td>
                        <td class="text-center">Rp <?=number_format($riz->TotalHarga, 0, ',', '.')?></td>
                    </tr>
                </tbody>
            </table>

            <!-- Informasi Pembayaran dan Kembalian -->
            <div class="payment-info">
                <p>Bayar : Rp <?=number_format($riz->bayar, 0, ',', '.')?></p>
                <p>Kembalian : Rp <?=number_format($riz->kembalian, 0, ',', '.')?></p>
            </div>
        <?php } ?>
                                
        <h4 class="text-center mb-3">Terima Kasih Atas Kunjungan Anda</h4>
    </div>
</body>
</html>

<script>
    window.print()
</script>
