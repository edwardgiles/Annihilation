// This file handles IX objects.
// The constructor function.
var IX = function IX(maxweight) {
	this.maxWeight=0;
    if (maxweight) {this.maxWeight=maxweight;}
    this.currentWeight = 0;
    this.ixData = [];
    this.ixData.length = IX.prototype.ixLength;
    this.recalcStoredWeight()
}
// Stores the number of items in an ix.
IX.prototype.ixLength = 128;

// this.weights stores the weights of each item, ordered by ID.
IX.prototype.weights = [];
IX.prototype.weights.length = IX.prototype.ixLength;

// Checks if an ID passed in is valid.
IX.prototype.isIdValid = function(id) {
	return !(id < 0 || id > IX.prototype.ixLength)
}
// Gets quantity of given item ID.
IX.prototype.getQuantity = function(id) {
	if (IX.prototype.isIdValid(id)&&this.ixData[id]) {
		return this.ixData[id];
	} else {
		return 0;
	}
}
/* Tries consuming a given quantity of a given item ID.
 * It returns true and alters the ix if it succeeded or
 * returns false and does nothing.
 */
IX.prototype.tryConsumeItem = function(id, quantity) {
	if (IX.prototype.isIdValid(id) && this.getQuantity(id) >= quantity) {
		this.ixData[id] -= quantity;
		this.recalcStoredWeight()
		return true;
	} else {
		return false;
	}
}
/* Adds a quantity of a given item ID to the ix.
 * Returns true if succeeded, or returns false and does nothing.
 */
IX.prototype.addItem = function(id, quantity) {
	if (IX.prototype.isIdValid(id)&&(this.maxWeight==0||this.currentWeight + quantity * IX.prototype.getWeight(id) <= this.maxWeight)) {
		this.ixData[id] += quantity;
		this.recalcStoredWeight();
		return true;
	} else {
		return false;
	}
}
// Outputs a string representing the ix contents.
IX.prototype.serializePart = function(partStart, partLength) {
	var result = "";
	for(var i=partStart;i<partStart+partLength;i++) {
		if (!this.ixData[i]) {this.ixData[i] = 0;}
		result += this.ixData[i].toString(32) + ";"
	}
	return result;
}

// Outputs a string representing the ix contents.
IX.prototype.serialize = function() {
	return this.serializePart(0, IX.ixLength);
}
// Sets the contents of this IX to the contents in the input.
IX.prototype.deserialize = function(serialized) {
	var input = serialized.split(";",this.ixLength + 1);
	for(var i=0;i<this.ixLength;i++) {
		this.ixData[i] = parseInt(input[i], 32)
	}
	this.maxWeight = parseInt(input[IX.ixLength], 32)
	this.recalcStoredWeight()
}

// Recalculates currentWeight
IX.prototype.recalcStoredWeight = function() {
	var weightSoFar = 0;
	for (var i=0;i<this.ixLength;i++) {
			if (!this.ixData[i]) {this.ixData[i] = 0;}
			weightSoFar += this.ixData[i] * IX.prototype.getWeight(i)
	}
	this.currentWeight = weightSoFar;
}

IX.prototype.getWeight = function(id) {
	if (IX.prototype.isIdValid(id)&&IX.prototype.weights[id]) {
		return IX.prototype.weights[id];
	} else {
		return 0;
	}
}
var InvRender = {};
InvRender.page = 1;
InvRender.nextPage = function() {
	InvRender.page = Math.min(InvRender.page + 1, 4)
	document.getElementById("pagenav").innerHTML = InvRender.page;
}
InvRender.prevPage = function() {
	InvRender.page = Math.max(InvRender.page - 1, 1)
	document.getElementById("pagenav").innerHTML = InvRender.page;
}


// Weights (kg/item)
IX.prototype.weights[0]  = 2.04; // Wood
IX.prototype.weights[1]  = 2.60; // Stone
IX.prototype.weights[2]  = 1.10; // Carbon
IX.prototype.weights[3]  = 2.58; // Copper
IX.prototype.weights[4]  = 1.95; // Iron
IX.prototype.weights[5]  = 2.27; // Alloy
IX.prototype.weights[6]  = 2.24; // Steel
IX.prototype.weights[7]  = 5.40; // Gold
IX.prototype.weights[8]  = 0.21; // Stick
IX.prototype.weights[9]  = 0.39; // Ironrod
IX.prototype.weights[10] = 1.08; // Goldrod
IX.prototype.weights[11] = 0.22; // Carbonrod