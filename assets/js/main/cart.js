$(document).ready(function () {

	$('body').on('click', '.remove', function() {
		let cart_id = $(this).data('cart');
		let form = $('.cart_items_form');
		form.attr('action', 'cart/remove/'+ cart_id);
		let formAction = form.attr('action');

		$.post(formAction, form.serializeArray(), function (res) {
			$('.cart_items').html(res);
			$.get('cart_count', function(res){
				let data = JSON.parse(res)
				$('.show_cart').text('Cart (' + data.count + ')');
			})
		});
		return false;
	});

	$(document).on('click', '.increase_decrease_quantity', function() {
		let ctrl = $(this).data('quantity-ctrl');
		let details = $(this).closest('ul').prev('input');
		let quantity = Number(details.val());
		let price = Number(details.data('price'));
		let max_quantity = Number(details.data('stock'));

		if ( (quantity + 1 ) <= max_quantity && ctrl == 1) {
			quantity++;
		}
		else if ( (quantity + 1 ) > 1 && ctrl == 0) {
			quantity--;
		}else {
			return;
		}
		$('#quantity').val(quantity);
		let total_amount = "$ " + (price * quantity).toFixed(2);
		$(this).closest('ul').closest('li').next('li').find('.total_amount').text(total_amount);
	
	});

	$('#place_order').click(function() {
		$('.cart_items_form').attr('action', 'order');
		$('.cart_items_form').submit();
	});
	
});
