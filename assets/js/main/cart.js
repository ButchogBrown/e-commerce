$(document).ready(function () {
	$('body').on('click', '.remove', function() {
		let cart_id = $(this).data('cart');
		let form = $('.cart_items_form').attr('action', 'cart/remove/'+ cart_id);
		form.submit();
	});

	
});
