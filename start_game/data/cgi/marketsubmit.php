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
			die('You have tried to sell what you don\'t have.');
		} else {
			die('You don\'t have enough money for this transaction.');
		}
	}
	$queryforuser = mysqli_fetch_array(mysqli_query($dblink, "SELECT `Inventory1`, `Inventory2`, `Inventory3`, `Inventory4`,`Money` FROM `playerdata` WHERE `UserID`='$userid'", MYSQLI_ASSOC));
	if (!$queryforuser) {
		die("An error occured and we could not complete the $action. Your savedata is unchanged.");
	} else (
		if ($action=="buy") {
			$invresults=array("", "", "", "");
			$invs=array();
			$cost=0;
			for ($abc=1;$abc<5;$abc++) {
				$invs[abc]=explode(';', $queryforuser["Inventory$abc"]);
				for ($i=0;$i<32;$i++) {
					$invresults[$abc] .= bcto32(intval($invs[$abc][$i], 32) + intval($splitquant[$i+32*$abc], 32)) . ';'
					$queryforuser = mysqli_fetch_array(mysqli_query($dblink, "SELECT `Inventory1`, `Inventory2`, `Inventory3`, `Inventory4`,`Money` FROM `playerdata` WHERE `UserID`='$userid'", MYSQLI_ASSOC));
				}
			}
			mysqli_query($dblink, "UPDATE `playerdata` SET `Inventory1`='$invresult1',`Inventory2`='$invresult2',`Inventory3`='$invresult3',`Inventory4`='$invresult4' WHERE `UserID`='$userid'"
		} else if ($action=="sell") {
			$invresults=array("", "", "", "");
			$invs=array();
			for ($abc=1;$abc<5;$abc++) {
				$invs[i]=explode(';',$queryforuser['Inventory1']);
				for ($i=0;$i<32;$i++) {
					if (intval($splitquant[$i+32*$abc], 32)>intval($invs[$abc][$i], 32)) {
						$invresults[$abc] .= bcto32(intval($invs[$abc][$i], 32) - intval($splitquant[$i+32*$abc], 32)) . ';'
					} else {
						error();
					}
				}
			}
			mysqli_query($dblink, "UPDATE `playerdata` SET `Inventory1`='$invresult1',`Inventory2`='$invresult2',`Inventory3`='$invresult3',`Inventory4`='$invresult4' WHERE `UserID`='$userid'"
		} else {
			die('Stop trying to hack the game.');
		}
	}
?>
