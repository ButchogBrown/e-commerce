

$(document).ready(function () {
	$('.status_form').submit(function(e){
		e.preventDefault();
	});
	$('.search_form').submit(function(e){
		e.preventDefault();
	});
	$('.delete_product_form').submit(function(e){
		e.preventDefault();
	});

	$(document).on('click', 'button[name="category_type"]', function(){
		let button = $(this);
		let form = $('.status_form');

		$('button[name="category_type"]').removeClass('active');
		$(this).addClass('active');

		$.post(form.attr('action'), { category_type: button.val() }, function(res){
			$('.product_list').html(res);	
		});
		return false;
	});	

	$(document).on('keyup', 'input[name="search"]', function(){
		let form = $('.search_form');

		$.post(form.attr('action'), form.serializeArray(), function(res){
			
			$('.product_list').html(res);	
		});
	});	

	$(document).on('click', 'button[name="remove"]', function(){
		let button = $(this);
		let form = button.closest('form');
		$.post(form.attr('action'), form.serializeArray(), function(res){
			button.closest("tr").removeClass("show_delete");
			$(".popover_overlay").fadeOut();
			$("body").removeClass("show_popover_overlay");
			$('.product_list').html(res.html);	
			$('#all_products').text(res.allProduct);
			$('#vegetables').text(res.category_count[0].category_count);
			$('#fruits').text(res.category_count[1].category_count);
			$('#pork').text(res.category_count[2].category_count);
			$('#beef_meat').text(res.category_count[3].category_count);
			$('#chicken').text(res.category_count[4].category_count);


			if (res.success) {
				toastr.success('Product successfully deleted.');
			} else {
				toastr.error('Something went wrong.');
			}
		}, 'json');
		return false;
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

	$('form.edit_product_form').submit(function (e) { 
		e.preventDefault();
		
		let form = $(this);
		$.post(form.attr('action'), form.serializeArray(), function(res){
			$("#edit_product_modal").modal("hide");
			if (res.success) {
				toastr.success('Product successfully edited.');
			} else {
				toastr.error('Something went wrong.');
			}
			$('.product_list').html(res.html);
			$('#vegetables').text(res.category_count[0]['category_count']);
			$('#fruits').text(res.category_count[1]['category_count']);
			$('#pork').text(res.category_count[2]['category_count']);
			$('#beef_meat').text(res.category_count[3]['category_count']);
			$('#chicken').text(res.category_count[4]['category_count']);

		}, 'json');	
		return false;
	});

	$('form.add_product_form').submit(function(e){
		e.preventDefault();
		let form  = $(this);

		let formData = new FormData(this);
		
		$.ajax({
			url: form.attr('action'),
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (res){
				$("#add_product_modal").modal("hide");
				if (res.success) {
					toastr.success('Product successfully edited.');
				} else {
					toastr.error('Something went wrong.');
				}
				$('.product_list').html(res.html);
				$('#vegetables').text(res.category_count[0]['category_count']);
				$('#fruits').text(res.category_count[1]['category_count']);
				$('#pork').text(res.category_count[2]['category_count']);
				$('#beef_meat').text(res.category_count[3]['category_count']);
				$('#chicken').text(res.category_count[4]['category_count']);
				form.trigger('reset');
				preview.innerHTML = "";
			},
			error: function(xhr){
				console.log('upload failed');
			}
		});
	});

});
