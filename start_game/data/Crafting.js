var Crafting = {};

Crafting.crafters = {};

Crafting.addRecipe = function(Crafter, items, results) {
	var tmp = Crafting.crafters[Crafter];
	if (!Crafting.crafters[Crafter]
	for (var i=0;i<items.length;i++) {
		if (!tmp['i' + items[i]]) {
			tmp['i' + items[i]] = {};
		}
		tmp = tmp['i' + items[i]];
	}
	tmp(results);
}