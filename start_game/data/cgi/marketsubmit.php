<?php
	include('dbconnect.php');
	function bcto32($number) {
		return base_convert(dechex($number), 16, 32);
	}
	$userid = $_POST['id'];
	$action = $_POST['action'];
	$quantities = $_POST['quantities'];
	$splitquant = explode(';', $quantities);
	function error() {
		global $action;
		if ($action=="sell") {
			die('You have tried to sell what you don\'t have, and you can\'t, so we have not changed your inventory or money supply at all.');
		} else {
			die('You don\'t have enough money for this transaction. We have not changed your inventory or money supply at all.');
		}
	}
	$queryforuser = mysqli_fetch_array(mysqli_query($dblink, "SELECT * FROM `playerdata` WHERE `UserID`='$userid'", MYSQLI_ASSOC));
	if (!$queryforuser) {
		die("An error occured and we could not complete the $action. Your savedata is unchanged.");
	} else (
		if ($action=="buy") {
			$invresult1="";
			$inv1=explode(';',$queryforuser['Inventory1']);
			for ($i=0;$i<32;$i++) {
				$invresult1 .= bcto32(intval($inv1[$i], 32) + intval($splitquant[$i], 32)) . ';'
			}
			$invresult2="";
			$inv2=explode(';',$queryforuser['Inventory2']);
			for ($i=0;$i<32;$i++) {
				$invresult2 .= bcto32(intval($inv2[$i], 32) + intval($splitquant[$i+32], 32)) . ';'
			}
			$invresult3="";
			$inv3=explode(';',$queryforuser['Inventory3']);
			for ($i=0;$i<32;$i++) {
				$invresult3 .= bcto32(intval($inv3[$i], 32) + intval($splitquant[$i+64], 32)) . ';'
			}
			$invresult4="";
			$inv4=explode(';',$queryforuser['Inventory4']);
			for ($i=0;$i<32;$i++) {
				$invresult4 .= bcto32(intval($inv4[$i], 32) + intval($splitquant[$i+96], 32)) . ';'
			}
			mysqli_query($dblink, "UPDATE `playerdata` SET `Inventory1`='$invresult1',`Inventory2`='$invresult2',`Inventory3`='$invresult3',`Inventory4`='$invresult4' WHERE `UserID`='$userid'"
		} else if ($action=="sell") {
			$invresult1="";
			$inv1=explode(';',$queryforuser['Inventory1']);
			for ($i=0;$i<32;$i++) {
				if (intval($splitquant[$i], 32)>intval($inv1[$i], 32)) {
					$invresult1 .= bcto32(intval($inv1[$i], 32) - intval($splitquant[$i], 32)) . ';'
				} else {
					error();
				}
			}
			$invresult2="";
			$inv2=explode(';',$queryforuser['Inventory2']);
			for ($i=0;$i<32;$i++) {
				if (intval($splitquant[$i+32], 32)>intval($inv2[$i], 32)) {
					$invresult2 .= bcto32(intval($inv2[$i], 32) - intval($splitquant[$i+32], 32)) . ';'
				} else {
					error();
				}
			}
			$invresult3="";
			$inv3=explode(';',$queryforuser['Inventory3']);
			for ($i=0;$i<32;$i++) {
				if (intval($splitquant[$i+64], 32)>intval($inv3[$i], 32)) {
					$invresult3 .= bcto32(intval($inv3[$i], 32) - intval($splitquant[$i+64], 32)) . ';'
				} else {
					error();
				}
			}
			$invresult4="";
			$inv4=explode(';',$queryforuser['Inventory4']);
			for ($i=0;$i<32;$i++) {
				if (intval($splitquant[$i+96], 32)>intval($inv4[$i], 32)) {
					$invresult4 .= bcto32(intval($inv4[$i], 32) - intval($splitquant[$i+96], 32)) . ';'
				} else {
					error();
				}
			}
			mysqli_query($dblink, "UPDATE `playerdata` SET `Inventory1`='$invresult1',`Inventory2`='$invresult2',`Inventory3`='$invresult3',`Inventory4`='$invresult4' WHERE `UserID`='$userid'"
		} else {
			die('Stop trying to hack the game.');
		}
	}
?>
