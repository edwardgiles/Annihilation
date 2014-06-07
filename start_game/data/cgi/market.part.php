<?php
	for ($i=$pgstart;$i<$pgstart+2;$i++) {
		echo "<tr>";
		for ($j=0;$j<16;$j++) {
			$id = $i * 16 + $j;
			$otherid = ($i-$pgstart) * 16 + $j;
			echo "<td class=\"c$otherid\" onclick=\"marketclicked('$id')\">";
			if ($prices[$id]) {
				echo $prices[$id];
			} else {
				echo '0.00';
			}
			echo "</td>";
		}
		echo "</tr>";
	}
?>
