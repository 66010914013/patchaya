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
    <th>Oder ID </th>
    <th>ซื้อสินค้า </th>
    <th>ประเภทสินค้า </th>
    <th>วันที่ </th>
    <th>ประเทศ </th>
    <th>จำนวนเงิน </th>
    <th>รูปภาพ </th>
</tr>
<?php
include_once("connectdb.php");
$sql = "SELECT * FROM popsupermarket";
$rs = mysqli_query($conn,$sql);
while ($date = mysqli_fetch_array($rs)){
?>
<tr>
    <td><?php echo $date['p_order_id'];?></td>
    <td><?php echo $date['p_product_name'];?></td>
    <td><?php echo $date['p_category'];?></td>
    <td><?php echo $date['p_date'];?></td>
    <td><?php echo $date['p_country'];?></td>
    <td align="right"><?php echo number_format($date['p_amount'],0);?></td>
    <td><img src="img/<?php echo $date['p_product_name'];?>.jpg" width="100"></td>
</tr>
<?php
}
mysqli_close($conn);
?>
</table>

</body>
</html>