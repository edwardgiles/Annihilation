var Building = {};
Building.tool = 1;
Building.numTypes = 5;
Building.sideLength = 10;
Building.getX = function(cellX, cellY) {
	return 200 - 20 * (cellX - cellY)
}
Building.getY = function(cellX, cellY) {
	return 60 + 10 * (cellX + cellY)
}
Building.init = function() {
	var toolcontainer = document.getElementById("buildtoolbox");
	toolcontainer.innerHTML = '<img alt="Eraser" src="data/sprites/building/eraser.png" onclick="Building.tool=0;" class="buildtool"/>';
	for (var i=1;i<Building.numTypes;i++) {
		toolcontainer.innerHTML += '<span onclick="Building.tool=' + i + '"><img alt="Place ' + i + '" src="data/sprites/building/tile' + i + '.png" class="buildtool"/></span>';
	}
	var contentcontainer = document.getElementById("buildcontainer");
	contentcontainer.innerHTML = '<img alt="Base" src="data/sprites/building/base.png" style="position:absolute;left:22px;top:86px;" />';
	Building.data = [];
	for (var i=0;i<Building.sideLength;i++) {
		Building.data[i] = [];
		for (var j=0;j<Building.sideLength;j++) {
			Building.data[i][j] = 0;
			contentcontainer.innerHTML += '<img alt="Cell" src="data/sprites/building/tile0.png" id="cell' + i + '' + j + '" onclick="Building.cell_click2(' + i + ',' + j +')" />'
			document.getElementById("cell" + i + j).style.position = "absolute";
			document.getElementById("cell" + i + j).style.left = Building.getX(i, j) + "px";
			document.getElementById("cell" + i + j).style.top = Building.getY(i, j) + "px";
		}
	}
	for (var i=0;i<Building.sideLength;i++) {
		Building.data[i] = [];
		for (var j=0;j<Building.sideLength;j++) {
			contentcontainer.innerHTML += '<div onclick="Building.cell_click(' + i + ',' + j +')" class="buildclicker" id="cclick' + i + '' + j + '">&nbsp;</div>'
			document.getElementById("cclick" + i + j).style.left = (Building.getX(i, j) + 14) + "px";
			document.getElementById("cclick" + i + j).style.top = (Building.getY(i, j) + 30) + "px";
		}
	}

}
Building.cell_click = function(cellX, cellY) {
	if (Building.data[cellX + 1][cellY + 1]) {
		Building.cell_click2(cellX + 1, cellY + 1);
	} else {
		Building.cell_click2(cellX, cellY);
	}
}
Building.cell_click2 = function(cellX, cellY) {
	if (cellX==0|cellY==0|cellY>=Building.sideLength - 1|cellX>=Building.sideLength - 1) {
		if (Building.data[cellX][cellY]==0 & Building.tool==1) {
			Building.cellUpd(cellX, cellY)
		}
	} else {
		Building.cellUpd(cellX, cellY);
	}

}
Building.cellUpd = function(cellX, cellY) {
	Building.data[cellX][cellY] = Building.tool;
	Building.redraw(cellX, cellY);
	parent.postMessage(["Building", cellX, cellY, Building.tool], "*");
}
Building.redraw = function(cellX, cellY) {
	document.getElementById("cell" + cellX + cellY).src = "data/sprites/building/tile" + Building.data[cellX][cellY] + ".png"
}

Building.receiveMessage = function(event)
{
  	var evdata = event.data;
	if (evdata[0]=="BuildingExtern") {
		Building.data[evdata[1]][evdata[2]] = evdata[3];
		Building.redraw(evdata[1], evdata[2]);
	}
}

window.addEventListener("message", Building.receiveMessage, false);