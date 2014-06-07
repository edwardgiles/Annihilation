<?php
	require("dbconnect.php");
	$id = $_POST['UserID'];
	$building = $_POST['Building'];
	$inv1 = $_POST['Inv1'];
	$inv2 = $_POST['Inv2'];
	$inv3 = $_POST['Inv3'];
	$inv4 = $_POST['Inv4'];
	mysqli_query($dblink, "UPDATE `playerdata` SET `Inventory1`='$inv1',`Inventory2`='$inv2',`Inventory3`='$inv3',`Inventory4`='$inv4',`Building`='$building' WHERE `UserID`='$id'");
	mysqli_close($dblink);
	/* Show redirect button */
	echo('<p>Your progress has been saved.</p><input type="button" value="Return to Game" onclick="window.location.replace(\'../../Game.php\');" />');
?>