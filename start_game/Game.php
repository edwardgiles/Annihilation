<?php session_start(); ?>
<html>
<head>
<title>Annihilation Domination</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="global.css">
<script type="text/javascript" src="data/Inventory.js"></script>
<script type="text/javascript">
var inv = new Inventory(10000)
var buildingData = [];
for (var i=0;i<10;i++) {
	buildingData[i] = [];
	for (var j=0;j<10;j++) {
		buildingData[i][j] = 0;
	}
}
function updateInvScreen() {
	var serialized = inv.serializePart((InvRender.page - 1)*32, 32);
	document.getElementById("inventory").src = "InvDisplay.htm?page=" + InvRender.page + "&contents=" + serialized;
	document.getElementById("inventoryWeight").innerText = "Weight: " + inv.currentWeight.toFixed(2) + "kg/10000kg"
}
function activate(id) {
	var chcontrols = document.getElementById("container").childNodes;
	for (var i=0;i<chcontrols.length;i++) {
		chcontrols[i].className = "tab";
	}
	document.getElementById(id).className = "tabactivated";
}
function serializeBuilding() {
	var result_so_far = "";
	for (var i=0;i<10;i++) {
		for (var j=0;j<10;j++) {
			result_so_far += buildingData[i][j].toString(32);
		}
	}
	return result_so_far;
}
window.addEventListener("message", receiveMessage, false);
function receiveMessage(event)
{
  	var data = event.data;
  	if (data[0]=="Building") {
  		buildingData[data[1]][data[2]] = data[3];
  	} else if (data[0]=="BuildingExtern") {
		buildingData[data[1]][data[2]] = data[3];
		document.getElementById("buildingControl").contentWindow.postMessage(data, "*");
	} else if (data[0]=="Inventory") {
		inv.inventoryData[data[1]] = data[2];
		inv.recalcStoredWeight()
		updateInvScreen();
	}
}
function deserializeBuilding(buildingData) {
	for (var i=0;i<10;i++) {
		for (var j=0;j<10;j++) {
			document.getElementById("buildingControl").contentWindow.postMessage(["BuildingExtern", i, j, parseInt(buildingData.charAt(i * 10 + j), 32)], "*");
		}
	}
}
function errorfunction() {
	document.getElementById("container").innerHTML = '<p style="background-color:red;">An error occured. Please log in again.</p>'
}
</script>
<?php
$loginname = "root";
$loginpass = "test";
$dbname = "quest";

$dblink = mysqli_connect("localhost", $loginname, $loginpass, $dbname) or die("Failed to connect to database");
$id = $_SESSION['id'];
if ($id) {
	$querylink = mysqli_query($dblink, "SELECT * FROM `playerdata` WHERE `UserID`='$id'") or die("Query failed");
	$arr = mysqli_fetch_array($querylink, MYSQL_ASSOC) or die("Array fetch failed");
	echo('<script type="text/javascript">
	errorfunction = function() {
	inv.deserialize("' . $arr['Inventory1'] . $arr['Inventory2'] . $arr['Inventory3'] . $arr['Inventory4'] . '");
	deserializeBuilding("' . $arr['Building'] . '");
	} </script>');
}
mysqli_close($dblink);
?>
</head>
<body onLoad="errorfunction(); updateInvScreen();">
<h1>Annihilation - Domination</h1>

<div id="container">
	<div class="tabactivated" id="inventoryTab"><div class="tabheader" onClick="activate('inventoryTab')">Inventory</div>
		<div class="tabcontent">
			<iframe src="InvDisplay.htm" id="inventory" style="width:360px; height:190px;" scrolling="no"></iframe>
			<div class="vertcentred">
				<input type="button" value="Prev" onClick="InvRender.prevPage(); updateInvScreen()"> 
				Page <span id="pagenav">1</span> of 4 
				<input type="button" value="Next" onClick="InvRender.nextPage(); updateInvScreen()">
                <span id="inventoryWeight">Weight: 0</span>
			</div>
		</div>
	</div>
	<div class="tab" id="builderTab"><div class="tabheader" onClick="activate('builderTab')">Builder</div>
		<div class="tabcontent">
        	<iframe name="buildingControl" id="buildingControl" src="Building.htm" style="width:450px; height: 320px;"></iframe>
		</div>
	</div>
</div>
</body>

</html>
 