var PlayerWants = {};
PlayerWants.marketclicked = function(id) {
	if (!PlayerWants[id]) {
		PlayerWants[id] = 1;
	} else {
		PlayerWants[id]++;
	}
	PlayerWants.UpdScreen();
}
PlayerWants.dontwantclicked = function(id) {
	if (PlayerWants[id]<=1) {
		delete PlayerWants[id];
	} else {
		PlayerWants[id]--;
	}
	PlayerWants.UpdScreen();
}
PlayerWants.dontwantall = function(id) {
	delete PlayerWants[id];
	PlayerWants.UpdScreen();
}

PlayerWants.UpdScreen = function() {
	var DomElement = document.getElementById("buysellinterface");
	DomElement.innerHTML = "";
	for (var propName in PlayerWants) {
		if (!isNaN(propName)) {
			DomElement.innerHTML += "<div>" + PlayerWants.GetTextForID(propName, PlayerWants[propName]) + "</div>";
		}
	}
}
PlayerWants.GetTextForID = function(id, quantity) {
	var result = ItemNames[id] + " x " + quantity + " ";
	result += '<input type="button" value="Remove" onclick="PlayerWants.dontwantclicked(';
	result += id;
	result += ');" />'
	if (quantity>1) {
		result += '<input type="button" value="Remove All" onclick="PlayerWants.dontwantall(';
		result += id;
		result += ');" />'
	}
	return result;
}