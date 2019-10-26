

const quantityform = document.getElementById("quantityform");
const decrease = document.getElementById("decrease_quantity");
const increas = document.getElementById("increas_quantity");
const item_quantity = document.getElementById("item_quantity");

quantityform.addEventListener('change', function(e) {
    let quantity = 0;
    
    if (increase.checked) {
    	item_quantity.value = item_quantity.value+1;
    }
    if (decrease.checked){
    	if (item_quantity.value>=1) {
    	item_quantity.value = item_quantity.value-1;
    	}
	}
	return item_quantity;
}


function plus(){
    let quantityCount = parseInt(item_quantity.value);
    quantityCount++;
    item_quantity.value = quantityCount;
    document.write(quantityCount);
}