

$(document).ready(function () {
	$('body').on('click', '.category_type', function(){
		alert('heelo');
	});


		$('.add_product_form').validate({
			rules: {
				'product_name' : {
					required: true
				},
				'description': {
					required: true
				},
				'selectpicker': {
					required: true
				},
				'price': {
					required: true
				},
				'inventory': {
					required: true
				}
			},
			errorPlacement: function(error, element) {
				let error_message = element.siblings('p');
				error_message.text(error.text());
				error_message.show();
			}
		});
	
});
