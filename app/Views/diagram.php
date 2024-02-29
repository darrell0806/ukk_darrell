<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagram Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">

                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "pos_kasir");
        $result = mysqli_query($conn, "SELECT DISTINCT YEAR(TanggalPenjualan) AS Tahun FROM penjualan");

        while ($row = mysqli_fetch_assoc($result)) {
            $tahun = $row["Tahun"];
            $result_bulan = mysqli_query($conn, "SELECT MONTH(TanggalPenjualan) AS Bulan, SUM(TotalHarga) AS TotalHarga 
                        FROM penjualan 
                        WHERE YEAR(TanggalPenjualan) = $tahun 
                        AND deleted_at IS NULL 
                        GROUP BY MONTH(TanggalPenjualan)");

            $labels = [];
            $data = [];

            while ($bulan = mysqli_fetch_assoc($result_bulan)) {
                $labels[] = date("F", mktime(0, 0, 0, $bulan["Bulan"], 1));
                $data[] = $bulan["TotalHarga"];
            }
        ?>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Diagram Penjualan Tahun <?= $tahun ?></h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="bar-<?= $tahun ?>"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <script>
                var chartColors = {
                    red: "rgb(255, 99, 132)",
                    orange: "rgb(255, 159, 64)",
                    yellow: "rgb(255, 205, 86)",
                    green: "rgb(75, 192, 192)",
                    info: "#41B1F9",
                    blue: "#3245D1",
                    purple: "rgb(153, 102, 255)",
                    grey: "#EBEFF6",
                };

                var ctxBar<?= $tahun ?> = document.getElementById("bar-<?= $tahun ?>").getContext("2d");
                var myBar<?= $tahun ?> = new Chart(ctxBar<?= $tahun ?>, {
                    type: "bar",
                    data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: [{
                            label: "Total Harga",
                            backgroundColor: chartColors.blue,
                            data: <?php echo json_encode($data); ?>,
                        }, ],
                    },
                    options: {
                        responsive: true,
                        barRoundness: 1,
                        title: {
                            display: true,
                            text: "Total Penjualan per Bulan Tahun <?= $tahun ?>",
                        },
                        legend: {
                            display: false,
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    suggestedMax: Math.max(...<?php echo json_encode($data); ?>) + 10,
                                    padding: 10,
                                },
                                gridLines: {
                                    drawBorder: false,
                                },
                            }, ],
                            xAxes: [{
                                gridLines: {
                                    display: false,
                                    drawBorder: false,
                                },
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 0,
                                    minRotation: 0,
                                },
                            }, ],
                        },
                    },
                });
            </script>

        <?php
        }
        mysqli_close($conn);
        ?>

    </div>
</body>

</html>
