<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>66010914013 พัชยา ศรีมุกดา (โฟม)</title>
</head>

<body>
<h1>66010914013 พัชยา ศรีมุกดา (โฟม)</h1>

<table border="1">
<tr>
    <th>เดือน</th>
    <th>ยอดขาย</th>
</tr>
<?php
include_once("connectdb.php");
$sql = "SELECT 
MONTH(p_date) AS Month, 
SUM(p_amount) AS Total_Sales
FROM popsupermarket
GROUP BY MONTH(p_date)
ORDER BY Month;";
$rs = mysqli_query($conn,$sql);
while ($date = mysqli_fetch_array($rs)){
?>
<tr>
    <td><?php echo $date['Month'];?></td>
    <td align="right"><?php echo number_format($date['Total_Sales'],0);?></td>

</tr>
<?php
}
mysqli_close($conn);
?>
</table>

</body>
</html>