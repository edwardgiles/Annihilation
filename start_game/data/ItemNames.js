var ItemNames = [];
var ItemNameToID = {};
ItemNames.length = 128;
for (var i=0;i<128;i++) {
	ItemNames[i] = "ID" + i;
	ItemNameToID["ID" + i] = i;
}
ItemNameToID.AddItem = function(id, name) {
	ItemNames[id] = name;
	ItemNameToID[name] = id;
}
ItemNameToID.English = function() {
	ItemNameToID.AddItem(0  ,"Wood");
	ItemNameToID.AddItem(1  ,"Stone");
	ItemNameToID.AddItem(2  ,"Carbon");
	ItemNameToID.AddItem(3  ,"Copper");
	ItemNameToID.AddItem(4  ,"Iron");
	ItemNameToID.AddItem(5  ,"Alloy");
	ItemNameToID.AddItem(6  ,"Steel");
	ItemNameToID.AddItem(7  ,"Gold");
	ItemNameToID.AddItem(8  ,"Stick");
	ItemNameToID.AddItem(9  ,"Iron Rod");
	ItemNameToID.AddItem(10 ,"Gold Rod");
	ItemNameToID.AddItem(11 ,"Carbon Rod");
	ItemNameToID.AddItem(12 ,"Stone Wall");
	ItemNameToID.AddItem(13 ,"Alloy Wall");
}