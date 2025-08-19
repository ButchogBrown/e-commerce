

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
				},
				'image': {
					required: true,
				}
			},
			errorPlacement: function(error, element) {
				let error_message = element.siblings('p');
				error_message.text(error.text());
				error_message.show();
			}
		});
	$('.edit_product_form').validate({
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
				},
				'image': {
					required: true,
				}
			},
			errorPlacement: function(error, element) {
				let error_message = element.siblings('p');
				error_message.text(error.text());
				error_message.show();
			}
		});


	const input = document.getElementById('image_input');
	const preview = document.getElementById('preview');

	input.addEventListener('change', () => {
		preview.innerHTML = "";

		[...input.files].forEach(file => {
			const img = document.createElement('img');

			img.src = URL.createObjectURL(file);
			img.width = 115;
			img.style.margin = "5px";
			img.style.border = "1px solid #9C89FF"
			img.style.borderRadius = "10px";
			preview.appendChild(img);
		});
		$('.upload_image').hide();
	});

	
	
});
