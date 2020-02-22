
function calculate() {
	var fb_quantity = document.getElementById('fb_quantity').value; 
	var fb_price = document.getElementById('fb_price').value;
	bresult = fb_quantity * fb_price;
	document.getElementById('total_price').value = bresult;
}