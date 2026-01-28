<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>66010914013 พัชยา ศรีมุกดา (โฟม)</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #6366f1;
            --secondary: #a855f7;
            --bg: #f8fafc;
            --white: #ffffff;
        }

        body { 
            font-family: 'Sarabun', sans-serif; 
            background-color: var(--bg); 
            margin: 0; 
            padding: 40px 20px;
            color: #1e293b;
        }

        .main-container { max-width: 1000px; margin: 0 auto; }

        .header { text-align: center; margin-bottom: 40px; }
        .header h1 { margin: 0; color: #1e293b; font-weight: 600; }
        .header p { color: #64748b; margin-top: 5px; }

        /* การตกแต่งตาราง (ด้านบน) */
        .card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 30px;
        }

        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f1f5f9; color: #475569; padding: 15px; text-align: left; border-radius: 8px 8px 0 0; }
        td { padding: 15px; border-bottom: 1px solid #f1f5f9; }
        tr:last-child td { border-bottom: none; }
        .price { font-weight: 600; color: var(--primary); text-align: right; }

        /* การจัดวางกราฟ (ด้านล่าง) */
        .charts-grid { display: grid; grid-template-columns: 1.5fr 1fr; gap: 25px; }
        @media (max-width: 768px) { .charts-grid { grid-template-columns: 1fr; } }

        .chart-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 20px; color: #334155; display: flex; align-items: center; }
        .chart-title::before { content: ""; width: 4px; height: 18px; background: var(--primary); margin-right: 10px; border-radius: 10px; }
        
        .canvas-holder { position: relative; height: 300px; }
    </style>
</head>

<body>

<div class="main-container">
    <div class="header">
        <h1>Dashboard รายงานยอดขาย</h1>
        <p>คุณพัชยา ศรีมุกดา (โฟม) | รหัส 66010914013</p>
    </div>

    <div class="card">
        <div class="chart-title">ตารางสรุปข้อมูลรายเดือน</div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>เดือนที่</th>
                        <th style="text-align: right;">ยอดขายสุทธิ (บาท)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once("connectdb.php");
                    $sql = "SELECT MONTH(p_date) AS Month, SUM(p_amount) AS Total_Sales FROM popsupermarket GROUP BY MONTH(p_date) ORDER BY Month;";
                    $rs = mysqli_query($conn, $sql);
                    
                    $labels = [];
                    $data = [];
                    
                    while ($row = mysqli_fetch_array($rs)) {
                        $labels[] = "เดือน " . $row['Month'];
                        $data[] = $row['Total_Sales'];
                    ?>
                    <tr>
                        <td>เดือนที่ <?php echo $row['Month']; ?></td>
                        <td class="price"><?php echo number_format($row['Total_Sales'], 2); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="charts-grid">
        <div class="card">
            <div class="chart-title">แนวโน้มยอดขาย</div>
            <div class="canvas-holder">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="chart-title">สัดส่วนรายได้</div>
            <div class="canvas-holder">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const labels = <?php echo json_encode($labels); ?>;
    const salesData = <?php echo json_encode($data); ?>;

    // กราฟแท่ง (Bar Chart)
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'ยอดขาย',
                data: salesData,
                backgroundColor: 'rgba(99, 102, 241, 0.8)',
                hoverBackgroundColor: 'rgba(99, 102, 241, 1)',
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });

    // กราฟวงกลม (Pie Chart)
    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut', // ใช้ Doughnut จะดูทันสมัยกว่า Pie ปกติครับ
        data: {
            labels: labels,
            datasets: [{
                data: salesData,
                backgroundColor: [
                    '#6366f1', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981', '#3b82f6'
                ],
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
            },
            cutout: '70%' // ทำให้เป็นวงแหวนดูสวยขึ้น
        }
    });
</script>

</body>
</html>