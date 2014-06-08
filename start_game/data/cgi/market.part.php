<?php
	for ($i=$pgstart;$i<$pgstart+2;$i++) {
		echo "<tr>";
		for ($j=0;$j<16;$j++) {
			$id = $i * 16 + $j;
			$otherid = ($i-$pgstart) * 16 + $j;
			$q = mysqli_query($dblink, "SELECT `ItemID`,`Price` FROM market WHERE `ItemID`='$id'");
			$arr = mysqli_fetch_array($q, MYSQLI_ASSOC);
			echo "<td class=\"c$otherid\" onclick=\"PlayerWants.marketclicked('$id')\">";
			if ($arr) {
				echo $arr['Price'];
			} else {
				echo '0.00';
			}
			echo "</td>";
		}
		echo "</tr>";
	}
?>
