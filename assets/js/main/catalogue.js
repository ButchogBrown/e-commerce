$(document).ready(function() {
	

	$('form.categories_form').submit(function(event){
		event.preventDefault();
	});

	$(document).on('click', "button[name='category_type']", function(){
		$('.category_btn').removeClass('active');
		$(this).addClass('active');
		
		let form = $('.categories_form');
		let formData = $('.categories_form').serializeArray();
		formData.push({name: this.name, value: this.value});
		
		$.post(form.attr('action'), formData, function(res){
			$('.catalogue').html(res);
		});
	});

	$(document).on('keyup', '.search', function() {
		let form = $(this).parent();
		
		$.post(form.attr('action'), form.serializeArray(), function(res){
			$('.catalogue').html(res);
		});
		return false;
	});
});

