<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>66010914013 พัชยา ศรีมุกดา (โฟม)</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; padding: 20px; background-color: #f8f9fa; }
        h1 { margin-bottom: 30px; color: #2c3e50; }
        
        /* จัดการตาราง */
        .table-container { max-width: 600px; margin: 0 auto 40px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #6c5ce7; color: white; padding: 12px; border: none; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        tr:hover { background-color: #f1f2f6; }
        
        /* จัดการกราฟ */
        .chart-wrapper { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
        .chart-box { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 400px; }
    </style>
</head>

<body>
    <h1>66010914013 พัชยา ศรีมุกดา (โฟม)</h1>

    <?php
    include_once("connectdb.php");
    $sql = "SELECT p_country, SUM(p_amount) AS total FROM popsupermarket GROUP BY p_country";
    $rs = mysqli_query($conn, $sql);
    
    $countries = [];
    $totals = [];
    $rows = [];

    while ($data = mysqli_fetch_array($rs)){
        $countries[] = $data['p_country'];
        $totals[] = (float)$data['total'];
        $rows[] = $data; // เก็บไว้แสดงในตาราง
    }
    mysqli_close($conn);
    ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ประเทศ</th>
                    <th>ยอดขาย (บาท)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo $row['p_country']; ?></td>
                    <td align="right"><strong><?php echo number_format($row['total'], 0); ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="chart-wrapper">
        <div class="chart-box">
            <canvas id="barChart"></canvas>
        </div>
        <div class="chart-box">
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <script>
        const labels = <?php echo json_encode($countries); ?>;
        const dataValues = <?php echo json_encode($totals); ?>;
        
        // ชุดสีพาสเทลสวยงาม
        const colors = [
            '#FF8080', '#FFCF96', '#F6FDC3', '#CDFAD5', '#A0E9FF', '#B692C2', '#FF90BC'
        ];

        const commonOptions = {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        };

        // กราฟแท่ง (Bar Chart)
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'ยอดขายรายประเทศ',
                    data: dataValues,
                    backgroundColor: colors,
                    borderRadius: 5
                }]
            },
            options: {
                ...commonOptions,
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'ยอดขายแยกตามประเทศ (Bar Chart)' }
                }
            }
        });

        // กราฟวงกลม (Pie Chart)
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: colors
                }]
            },
            options: {
                ...commonOptions,
                plugins: {
                    title: { display: true, text: 'สัดส่วนยอดขาย (Pie Chart)' }
                }
            }
        });
    </script>
</body>
</html>