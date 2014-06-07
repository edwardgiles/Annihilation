<?php session_start(); ?>

<html>
<head>
<title>Annihilation Domination</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="data/swag.php?yolo=text/css&swag=SWAG&swaɡ=SWAG">
<script type="text/javascript" src="data/swag.php?yolo=text/javascript&swag=SWAG&swaɡ=ALSOSWAG"></script>
<script type="text/javascript">
var a = new IX(10000)
var b = [];
var buildingIDs = [12, 12, 12, 12]
function uis() {
	var c = a.serializePart((InvRender.page - 1)*32, 32);
	document.getElementById("inventory").src = "InvDisplay.htm?page=" + InvRender.page + "&contents=" + c;
	document.getElementById("inventoryWeight").innerText = "Weight: " + a.currentWeight.toFixed(2) + "kg/10000kg"
	for (var i=0;i<buildingIDs.length;i++) {
		document.getElementById("available" + buildingIDs[i]).innerText = a.getQuantity(buildingIDs[i]);
	}
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
			result_so_far += b[i][j].toString(32);
		}
	}
	return result_so_far;
}
window.addEventListener("message", receiveMessage, false);
function receiveMessage(event)
{
  	var data = event.data;
  	if (data[0]=="Building") {
  		updBuildingResources(data);
  	} else if (data[0]=="BuildingExtern") {
		b[data[1]][data[2]] = data[3];
		document.getElementById("buildingControl").contentWindow.postMessage(data, "*");
	} else if (data[0]=="Inventory") {
		a.inventoryData[data[1]] = data[2];
		a.recalcStoredWeight()
		uis();
	}
}
function deserializeBuilding(bstr) {
	b = [];
	for (var i=0;i<10;i++) {
		b[i] = [];
		for (var j=0;j<10;j++) {
			b[i][j] = parseInt(bstr.charAt(i * 10 + j), 32);
			document.getElementById("buildingControl").contentWindow.postMessage(["BuildingExtern", i, j, parseInt(bstr.charAt(i * 10 + j), 32)], "*");
		}
	}
}
function errorfunction() {
	document.getElementById("container").innerHTML = '<p style="background-color:red;">An error occured. Please log in again.</p>'
}
function updBuildingResources(data) {
	var prevtile = b[data[1]][data[2]];
	var currenttile = data[3];
	for (var i=1; i<=buildingIDs.length;i++) {
		if (prevtile == 0 & currenttile == i) {
			if (a.tryConsumeItem(buildingIDs[i - 1], 1)) {
				b[data[1]][data[2]] = data[3];
			} else {
				document.getElementById("buildingControl").contentWindow.postMessage(["BuildingExtern", data[1], data[2], 0], "*");
			}
		} else if (prevtile == i & currenttile == 0) {
			if (a.addItem(buildingIDs[i - 1], 1)) {
				b[data[1]][data[2]] = 0;
			} else {
				document.getElementById("buildingControl").contentWindow.postMessage(["BuildingExtern", data[1], data[2], prevtile], "*");
			}
		}
	}
	uis()
}
function updControls() {
	document.getElementById("Inv1Submit").value = a.serializePart(0, 32);
	document.getElementById("Inv2Submit").value = a.serializePart(32, 32);
	document.getElementById("Inv3Submit").value = a.serializePart(64, 32);
	document.getElementById("Inv4Submit").value = a.serializePart(96, 32);
	document.getElementById("BuildingSubmit").value = serializeBuilding();
}
function bu() {
	updControls();
	document.getElementById("savedataform").submit();
	return "Exit the game?";
}
</script>
<?php
// Sets $dblink to a link to the database.
include("data/cgi/dbconnect.php");
$id = $_SESSION['id'];
if ($id) {
	$querylink = mysqli_query($dblink, "SELECT * FROM `playerdata` WHERE `UserID`='$id'") or die("Query failed");
	$arr = mysqli_fetch_array($querylink) or die("Array fetch failed");
	echo('<script type="text/javascript">
	errorfunction = function() {
	a.deserialize("' . $arr['Inventory1'] . $arr['Inventory2'] . $arr['Inventory3'] . $arr['Inventory4'] . '");
	deserializeBuilding("' . $arr['Building'] . '");
	} </script>');
}
mysqli_close($dblink);
?>
</head>
<body onload="errorfunction(); uis(); updControls();" onbeforeunload="bu();">
<h1>Annihilation - Domination</h1>

<table style="width:100%; height:70%;">
	<tr>
		<td style="vertical-align: top;">
			<div id="container">
				<div class="tabactivated" id="inventoryTab"><div class="tabheader" onclick="activate('inventoryTab')">Inventory</div>
					<div class="tabcontent">
						<iframe src="InvDisplay.htm?page=1&contents=" id="inventory" style="width:360px; height:190px;" scrolling="no"></iframe>
						<div class="vertcentred">
							<input type="button" value="Prev" onclick="InvRender.prevPage(); uis()"> 
							Page <span id="pagenav">1</span> of 4 
							<input type="button" value="Next" onclick="InvRender.nextPage(); uis()">
    	            		<span id="inventoryWeight">Weight: 0</span>
						</div>
					</div>
				</div>
				<div class="tab" id="builderTab"><div class="tabheader" onclick="activate('builderTab')">Builder</div>
					<div class="tabcontent">
						<img alt="Walls available" src="data/sprites/basic/stonewall.png"> = <span id="available12">0</span><br>
        				<iframe name="buildingControl" id="buildingControl" src="Building.htm" style="width:450px; height: 320px;"></iframe>
					</div>
				</div>
			</div>
		</td>
		<td style="width:400px; vertical-align: top;">
		<iframe name="chat" id="chat" style="width:100%; height:100%;" src="Chat.htm"></iframe>
		</td>
	</tr>
</table>
<form method="post" action="data\cgi\savedata.php" id="savedataform">
	<input type="hidden" name="UserID" value="<?php echo($id); ?>" >
	<input type="hidden" name="Inv1" id="Inv1Submit" value="0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;" >
	<input type="hidden" name="Inv2" id="Inv2Submit" value="0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;" >
	<input type="hidden" name="Inv3" id="Inv3Submit" value="0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;" >
	<input type="hidden" name="Inv4" id="Inv4Submit" value="0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;" >
	<input type="hidden" name="Building" id="BuildingSubmit" value="0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000" >
	<input type="submit" name="Submit" style="width: 200px; height: 40px; font-size:18pt;" value="Save" onmouseenter="focus();" onfocus="updControls()">
</form>
<p style="font-size:9pt;">Your progress is also saved when you close the browser.</p>
</body>

</html>
 