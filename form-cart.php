<?php session_start();
if (!$_SESSION["email"]){
	header("location:form-login.php"); 
}else { 

include("connect.php");
$sql = "SELECT * FROM stock";
$result = $conn->query($sql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>7Shop</title>
</head>
	<style>
		body, input{
			text-align: center;
			margin-bottom: 3%;
		}
		table, td, th{
			border: 1px solid black;
			 font-family: arial, sans-serif;
              border-collapse: collapse;

		}
	</style>
<body>
	
	
	<!-- เมนูรายการ -->
	
				<form action="form-reportMember.php" method="post">
					<input type="submit" value="รายชื่อสมาชิก">
				</form>
			
				<form action="form-cartMe.php" method="post">
					<input type="submit" value="ตะกร้าของฉัน">
				</form>
			
				<form action="form-addProduct.php" method="post" target="_blank">
					<input type="submit" value="เพิ่มสินค้า">
				</form>
		
	
	<!-- ตารางสินค้าและค้นหา -->
	<h2>รายการสินค้า</h2>
	ค้นหา : <input type="text" id="myInput" onkeyup="myFunction()" placeholder="---ค้นหา--- "Type in a name">
	<table align="center" id="myTable">
  		<tr class="header">
			
    		<th>ชื่อสินค้า</th>
    		<th>จำนวน</th>
			
  		</tr>
		<?php 
		if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
		?>
 
			
    		<td><?php echo $row["name"]; ?></td>
			<td><?php echo $row["amount"]; ?></td>
			<br>
			<br>
			<br>
				<form action="form-editProduct.php" method="post" target="_blank">
					<button type="submit" name="id" value="<?php echo $row["id"]; ?>">แก้ไขสินค้า</button>
				</form>
			
			
				<form action="php-delProduct.php" method="post" target="_blank">
					<button type="submit" name="id" value="<?php echo $row["id"]; ?>">ลบสินค้า</button>
				</form>
			
				<form action="php-addToCart.php" method="post">
					<button type="submit" name="id" value="<?php echo $row["id"]; ?>">สั่งซื้อ</button>
				</form>
			
		<?php }
			} else {
    			echo "0 results";
		} ?>
	</table>
	
	<br>
	<br>
	<br>
	<!-- ออกจากระบบ -->
	<form action="php-logout.php" method="post"><input type="submit" value="ออกจากระบบ"></form>
	
	<!-- เงื่อนไขการค้นหา -->
	<script>
		function myFunction() {
  			var input, filter, table, tr, td, i, txtValue;
  			input = document.getElementById("myInput");
  			filter = input.value.toUpperCase();
  			table = document.getElementById("myTable");
  			tr = table.getElementsByTagName("tr");
  			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[1];
    			if (td) {
      				txtValue = td.textContent || td.innerText;
      				if (txtValue.toUpperCase().indexOf(filter) > -1) {
        				tr[i].style.display = "";
      				} else {
        				tr[i].style.display = "none";
      				}
    			}       
  			}
		}
	</script>
	
</body>
</html>
<?php $conn->close(); } ?>