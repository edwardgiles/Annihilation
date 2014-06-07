var Crafting = {};

Crafting.recipes = [];
Crafting.recipes.length = 128;
/* Recipe format
	ingredients - Array of 1 to 3 item IDs.
	quantities - Array of quantities, same length as itemIDs.
	probability - A decimal value representing the probability that the craft will work. Must be 0 to 1.
	failItem - An item ID representing what is produced if the craft fails.
*/
Crafting.addRecipe = function(result, failresult, probwork, ingredients, quantities) {
    if (!Crafting.recipes[result]) {
        Crafting.recipes[result] = [];
    }
    /* Push the recipe based on the input. */
    var newrecipe1 = {};
    newrecipe1.ingredients = ingredients;
    newrecipe1.quantities = quantities;
    newrecipe1.failItem = failresult;
    newrecipe1.probability = probwork;
    Crafting.recipes[result].push(newrecipe1);
    /* Push the opposite recipe, with the "failed item" now the item desired. */
    var newrecipe2 = {};
    newrecipe2.ingredients = ingredients;
    newrecipe2.quantities = quantities;
    newrecipe2.failItem = result;
    newrecipe2.probability = 1 - probwork;
    Crafting.recipes[failresult].push(newrecipe2);
}
Crafting.getPossibleRecipes = function(result) {
	return Crafting.recipes[result];
}