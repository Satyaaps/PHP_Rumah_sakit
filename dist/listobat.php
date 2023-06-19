<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HaiMedic Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/medicikon.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">HaiMedic</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action list-group-item-light p-3">Dashboard</a>
                <a href="janjimedis.php" class="list-group-item list-group-item-action list-group-item-light p-3">Janji Medis</a>
                <a href="listobat.php" class="list-group-item list-group-item-action list-group-item-light p-3">List Obat</a>
                <a href="pembelian.php" class="list-group-item list-group-item-action list-group-item-light p-3">Pembelian Obat</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">Menu</button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a href="profile.php" class="nav-link">Profile</a>
                            </li>
                            <li class="nav-item active">
                                <a href="logout.php" class="nav-link">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid">
                <div class="col-sm-4">
                    <h3>Tabel Data Obat</h3>
                    <br>
                    <form action="" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <tr>
                            <th>NO</th>
                            <th>NAMA OBAT</th>
                            <th>STOK</th>
                            <th>HARGA JUAL</th>
                            <th>HARGA BELI</th>
                            <th>JENIS OBAT</th>
                        </tr>
                        <?php
                        include "dbconnect.php";
                        $collection = $database->selectCollection("obat");
                        $no = 1;
                        $NAMA = "";
                        if (isset($_GET['search'])) {
                            $NAMA = $_GET['search'];
                        }

                        // Filter parameter
                        $filter = "";
                        if (isset($_GET['filter'])) {
                            $filter = $_GET['filter'];
                        }

                        // Kueri pencarian
                        $searchQuery = [];
                        if (isset($_GET['search'])) {
                            $searchQuery = [
                                '$or' => [
                                    ['nama_obat' => ['$regex' => $_GET['search'], '$options' => 'i']],
                                    ['stok' => ['$regex' => $_GET['search'], '$options' => 'i']],
                                    ['harga_jual' => ['$regex' => $_GET['search'], '$options' => 'i']],
                                    ['harga_beli' => ['$regex' => $_GET['search'], '$options' => 'i']],
                                    ['jenis_obat' => ['$regex' => $_GET['search'], '$options' => 'i']],
                                ],
                            ];
                        }

                        // Kueri filter
                        $filterQuery = [];
                        if ($filter === "tabel" || $filter === "kapsul" || $filter === "sirup") {
                            $filterQuery = ['jenis_obat' => $filter];
                        }

                        // Menggabungkan kueri pencarian dan filter
                        $query = array_merge($searchQuery, $filterQuery);

                        // Mengambil data obat dengan batasan jumlah dan halaman tertentu
                        $limit = 5;
                        $page = 1;
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        }
                        $skip = ($page - 1) * $limit;

                        $options = [
                            'skip' => $skip,
                            'limit' => $limit
                        ];

                        // Mengambil data obat tanpa pengurutan
                        $tampil = $collection->find($query, $options);

                        // Mengurutkan data setelah mengambilnya dari database
                        $dataObat = iterator_to_array($tampil);
                        usort($dataObat, function ($a, $b) use ($filterQuery) {
                            foreach ($filterQuery as $key => $order) {
                                if ($a[$key] === $b[$key]) {
                                    continue;
                                }
                                return ($a[$key] < $b[$key]) ? $order : -$order;
                            }
                            return 0;
                        });

                        foreach ($dataObat as $data) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nama_obat'] ?></td>
                                <td><?php echo $data['stok'] ?></td>
                                <td><?php echo $data['harga_jual'] ?></td>
                                <td><?php echo $data['harga_beli'] ?></td>
                                <td><?php echo $data['jenis_obat'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <?php
                    $total = $collection->count($query);
                    $pages = ceil($total / $limit);
                    ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php if ($page <= 1) {
                                echo 'disabled';
                            } ?>">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo $NAMA; ?>&filter=<?php echo $filter; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <?php
                            for ($i = 1; $i <= $pages; $i++) {
                                ?>
                                <li class="page-item <?php if ($i == $page) {
                                echo 'active';
                            } ?>"><a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $NAMA; ?>&filter=<?php echo $filter; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item <?php if ($page >= $pages) {
                                echo 'disabled';
                            } ?>">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo $NAMA; ?>&filter=<?php echo $filter; ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- Custom script for filtering-->
    <script>
        $(document).ready(function() {
            $("#filterButton").click(function() {
                var filter = $("#filter").val();
                var search = "<?php echo $NAMA; ?>";
                var url = "listobat.php?page=1&search=" + search + "&filter=" + filter;
                window.location.href = url;
            });
        });
    </script>
</body>
</html>
