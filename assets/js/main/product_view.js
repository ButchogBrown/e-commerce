function updateButtons(quantity, max_quantity) {
    if (quantity <= 1) {
        $('button[data-quantity-ctrl="0"]').prop('disabled', true); // disable decrease
    } else {
        $('button[data-quantity-ctrl="0"]').prop('disabled', false);
    }

    if (quantity >= max_quantity) {
        $('button[data-quantity-ctrl="1"]').prop('disabled', true); // disable increase
    } else {
        $('button[data-quantity-ctrl="1"]').prop('disabled', false);
    }
}

$(document).on('click', '.increase_decrease_quantity', function() {
    let ctrl = $(this).data('quantity-ctrl');
    let quantity = Number($('#quantity').val());
    let max_quantity = Number($('#stock').val());
    let price = Number($('#price').data('price'));

    if (ctrl === 1 && quantity < max_quantity) {
        quantity++;
    } else if (ctrl === 0 && quantity > 1) {
        quantity--;
    } else {
        return; // no change, ignore click
    }

    $('#quantity').val(quantity);
    let total = "$ " + (quantity * price).toFixed(2);
    $('#total_amount').text(total);

    updateButtons(quantity, max_quantity);
});

// initialize buttons state on page load
$(document).ready(function() {
    let quantity = Number($('#quantity').val());
    let max_quantity = Number($('#stock').val());
    updateButtons(quantity, max_quantity);

	
});




