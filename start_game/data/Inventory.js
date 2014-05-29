// This file handles Inventory objects.
// The constructor function.
var Inventory = function Inventory(maxweight) {
	this.maxWeight=0;
    if (maxweight) {this.maxWeight=maxweight;}
    this.currentWeight = 0;
    this.inventoryData = [];
    this.inventoryData.length = Inventory.prototype.inventoryLength;
    this.recalcStoredWeight()
}
// Stores the number of items in an inventory.
Inventory.prototype.inventoryLength = 256;

// this.weights stores the weights of each item, ordered by ID.
Inventory.prototype.weights = [];
Inventory.prototype.weights.length = Inventory.prototype.inventoryLength;

// Checks if an ID passed in is valid.
Inventory.prototype.isIdValid = function(id) {
	return !(id < 0 || id > Inventory.prototype.inventoryLength)
}
// Gets quantity of given item ID.
Inventory.prototype.getQuantity = function(id) {
	if (Inventory.prototype.isIdValid(id)&&this.inventoryData[id]) {
		return this.inventoryData[id];
	} else {
		return 0;
	}
}
/* Tries consuming a given quantity of a given item ID.
 * It returns true and alters the inventory if it succeeded or
 * returns false and does nothing.
 */
Inventory.prototype.tryConsumeItem = function(id, quantity) {
	if (Inventory.prototype.isIdValid(id) && this.getQuantity(id) >= quantity) {
		this.inventoryData[id] -= quantity;
		this.recalcStoredWeight()
		return true;
	} else {
		return false;
	}
}
/* Adds a quantity of a given item ID to the inventory.
 * Returns true if succeeded, or returns false and does nothing.
 */
Inventory.prototype.addItem = function(id, quantity) {
	if (Inventory.prototype.isIdValid(id)&&(this.maxWeight==0||this.currentWeight + quantity * Inventory.prototype.getWeight(id) <= this.maxWeight)) {
		this.inventoryData[id] += quantity;
		this.recalcStoredWeight();
		return true;
	} else {
		return false;
	}
}
// Outputs a string representing the inventory contents.
Inventory.prototype.serializePart = function(partStart, partLength) {
	var result = "";
	for(var i=partStart;i<partStart+partLength;i++) {
		if (!this.inventoryData[i]) {this.inventoryData[i] = 0;}
		result += this.inventoryData[i].toString(32) + ";"
	}
	return result;
}

// Outputs a string representing the inventory contents.
Inventory.prototype.serialize = function() {
	return this.serializePart(0, Inventory.inventoryLength);
}
// Sets the contents of this Inventory to the contents in the input.
Inventory.prototype.deserialize = function(serialized) {
	var input = serialized.split(";",this.inventoryLength + 1);
	for(var i=0;i<this.inventoryLength;i++) {
		inventoryData[i] = parseInt(input[i], 32)
	}
	this.maxWeight = parseInt(input[Inventory.inventoryLength], 32)
	this.recalcStoredWeight()
}

// Recalculates currentWeight
Inventory.prototype.recalcStoredWeight = function() {
	var weightSoFar = 0;
	for (var i=0;i<this.inventoryLength;i++) {
			if (!this.inventoryData[i]) {this.inventoryData[i] = 0;}
			weightSoFar += this.inventoryData[i] * Inventory.prototype.getWeight(i)
	}
	this.currentWeight = weightSoFar;
}

Inventory.prototype.getWeight = function(id) {
	if (Inventory.prototype.isIdValid(id)&&Inventory.prototype.weights[id]) {
		return Inventory.prototype.weights[id];
	} else {
		return 0;
	}
}
var InvRender = {};
InvRender.page = 1;
InvRender.nextPage = function() {
	InvRender.page = Math.min(GUI.page + 1, 4)
	document.getElementById("pagenav").innerHTML = InvRender.page;
}
InvRender.prevPage = function() {
	InvRender.page = Math.max(GUI.page - 1, 1)
	document.getElementById("pagenav").innerHTML = InvRender.page;
}


// Weights (kg/item)
Inventory.prototype.weights[0] = 2.04; // Wood
Inventory.prototype.weights[1] = 2.60; // Stone
Inventory.prototype.weights[2] = 1.10; // Carbon
Inventory.prototype.weights[3] = 2.58; // Copper
Inventory.prototype.weights[4] = 1.95; // Iron
Inventory.prototype.weights[5] = 2.27; // Alloy
Inventory.prototype.weights[6] = 2.24; // Steel
Inventory.prototype.weights[7] = 5.40; // Gold
Inventory.prototype.weights[8] = 0.26; // Copper Coin
Inventory.prototype.weights[9] = 0.54; // Gold Coin
Inventory.prototype.weights[9] = 0.21; // Stick