<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>66010914013 พัชยา ศรีมุกดา (โฟม)</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Sarabun', sans-serif; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; }
        .main-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; }
        .card-header-custom { background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%); color: white; padding: 25px; border: none; }
        .table thead { background-color: #f8f9fa; }
        .product-img { object-fit: cover; border-radius: 10px; transition: transform .2s; cursor: pointer; border: 2px solid #eee; }
        .product-img:hover { transform: scale(1.5); z-index: 999; position: relative; }
        /* ตกแต่งช่อง Search */
        .dataTables_filter input { border-radius: 20px; border: 1px solid #2575fc; padding: 5px 15px; }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card main-card">
            <div class="card-header card-header-custom text-center">
                <h2 class="mb-0"><i class="fa-solid fa-cart-shopping me-2"></i> ระบบจัดการข้อมูล Pop Supermarket</h2>
                <small class="opacity-75">ผู้จัดทำ: 66010914013 พัชยา ศรีมุกดา (โฟม)</small>
            </div>
            
            <div class="card-body p-4 bg-white">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-hover align-middle w-100">
                        <thead>
                            <tr>
                                <th class="text-primary">ID</th>
                                <th>รูปสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>หมวดหมู่</th>
                                <th>วันที่ขาย</th>
                                <th>ประเทศ</th>
                                <th class="text-end">ยอดเงิน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once("connectdb.php");
                            $sql = "SELECT * FROM popsupermarket";
                            $rs = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($rs)) {
                            ?>
                            <tr>
                                <td><span class="fw-bold">#<?php echo $data['p_order_id']; ?></span></td>
                                <td>
                                    <img src="img/<?php echo $data['p_product_name']; ?>.jpg" 
                                         class="product-img shadow-sm" width="50" height="50"
                                         onerror="this.src='https://via.placeholder.com/50?text=No+Img'">
                                </td>
                                <td><?php echo $data['p_product_name']; ?></td>
                                <td><span class="badge bg-info text-dark fw-normal"><?php echo $data['p_category']; ?></span></td>
                                <td class="text-muted small"><?php echo $data['p_date']; ?></td>
                                <td><i class="fa-solid fa-location-dot text-danger me-1"></i><?php echo $data['p_country']; ?></td>
                                <td class="text-end fw-bold text-primary">
                                    <?php echo number_format($data['p_amount'], 2); ?>
                                </td>
                            </tr>
                            <?php } mysqli_close($conn); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/th.json" // เมนูภาษาไทย
                },
                "pageLength": 10,
                "order": [[ 0, "desc" ]] // เรียงจาก ID ล่าสุด
            });
        });
    </script>
</body>
</html>