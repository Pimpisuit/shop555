<?php session_start();
if (!$_SESSION["email"]){
	header("location:form-login.php"); 
}else { 

include("connect.php");	   
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ตะกร้า</title>
</head>
	<style>
		body{
			text-align: center;
		}
		table, td, th{
			border: 1px solid black;
			margin-bottom: 2%;
		}
	</style>
<body>
	<h2>ตะกร้าสินค้า</h2>
	<table align="center">
		<tr>
			<th>ชื่อสินค้า</th>
			<th>จำนวน</th>
			
		</tr>
		<?php 
		if(isset($_COOKIE["cart"])) {
			foreach($_COOKIE["cart"] as $index => $valus) {
				$sql = "SELECT * FROM stock WHERE id='".$index."'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
    				while($row = $result->fetch_assoc()) {
		?>	
		<tr>
    		<td><?php echo $row["name"]; ?></td>
			<td><?php echo $valus; ?></td>
			
  		</tr>
		<?php 		}
				} 
			}
		}
		?>
	</table>
	
	
	<a href="form-cart.php">ย้อนกลับ</a> <br><br>
	<form action="php-submitCart.php" method="post"><input type="submit" value="ยืนยันการสั่งซื้อ"></form>
</body>
</html>
<?php  $conn->close(); } ?>


