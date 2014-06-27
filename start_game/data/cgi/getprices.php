<?php
	include("dbconnect.php");
	$prices = array();
	for ($i=127;$i;$i--) {
		$prices[$i] = 0;
	}
	$q = mysqli_query($dblink, "SELECT `ItemID`, `Price` FROM `market` WHERE 1 ORDER BY `ItemID`")
	while ($a = mysqli_fetch_array($q, MYSQLI_ASSOC))
		$prices[
?>
