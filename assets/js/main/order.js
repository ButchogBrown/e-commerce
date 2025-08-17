$(document).ready(function() {
	$('.selectpicker').on('change', function () {  
		let form = $(this).closest('form');
		form.submit();
	});
});
