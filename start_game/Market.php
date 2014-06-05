<?php include("data/dbconnect.php") ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" href="data/inventory.css" />
<title>Market</title>
<?php
echo '<script type="text/javascript">
/* This was created by a PHP script. */
var Market = [];
Market.length = 256;
';
	$prices = array();
	$q = mysqli_query($dblink, "SELECT `ItemID`,`Price` FROM market WHERE 1");
	while ($a = mysqli_fetch_array($q, MYSQLI_ASSOC)) {
		$iid = $a['ItemID'];
		$iprice = $a['Price'];
		echo "Market[$iid] = $iprice;\n";
		// To be used in market.part.php
		$prices[$iid] = $iprice;
	}
	echo '</script>';
?>
<script type="text/javascript">
function marketclicked(id) {
	
}
</script>
</head>
<body>
<table id="market-p1" class="inventorytable large p1">
<?php
	$pgstart = 0;
	include('data/market.part.php');
?>
</table>
<table id="market-p2" class="inventorytable large p2">
<?php
	$pgstart = 2;
	include('data/market.part.php');
?>
</table>
<table id="market-p3" class="inventorytable large p3">
<?php
	$pgstart = 4;
	include('data/market.part.php');
?>
</table>
<table id="market-p4" class="inventorytable large p4">
<?php
	$pgstart = 6;
	include('data/market.part.php');
?>
</table>
<?php mysqli_close($dblink); ?>
</body>

</html>