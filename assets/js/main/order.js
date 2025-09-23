$(document).ready(function() {

	$('.status_form').submit(function(e){
		e.preventDefault();
	});

	$(document).on('click', 'button[name="status"]', function(){
		let button = $(this);
		let form = $('.status_form');
		
		$.post(form.attr('action'), {'status': button.val()}, function(res){
			$('.order_lsit').html(res);
			$('.selectpicker').selectpicker('refresh');

		})


	});
	$(document).on('change', 'select[name="change_status"]', function() {
		let form = $(this).closest('form');
		$.post(form.attr('action'), form.serializeArray(), function (res){
			if(res.success == true) {
				toastr.success('Order status updated successfully.');
			} else {
				toastr.error('Invalid status change! You cannot skip or go backwards');
			}
			$('.order_lsit').html(res.html);
			$('.selectpicker').selectpicker('refresh');
			$('#pending').text(res.category_details[0].status_count);
			$('#on_process').text(res.category_details[1].status_count);
			$('#shipping').text(res.category_details[2].status_count);
			$('#delivered').text(res.category_details[3].status_count);
		}, 'json');
		return false;
	});
	// $('.selectpicker').on('change', function () {  
	// 	let form = $(this).closest('form');
	// 	form.submit();
	// });
});
