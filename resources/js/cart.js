(function ($) {
    $('.item-quantity').on('change', function (e) { // any element has class called item-quantity in change event
        //ajax setting
        $.ajax({
            url: "/cart/" + $(this).data('id'), // will get attribute data-id value
            method: 'put',
            data: {
                quantity: $(this).val(), // the value of the field
                _token: csrf_token      // variable
            }
        });
    });

    $('.remove-item').on('click', function (e) { // onclick
        //ajax setting
        $.ajax({
            url: "/cart/" + $(this).data('id'), // will get attribute data-id value
            method: 'delete',
            data: {
                _token: csrf_token      // variable
            },
            success: Response => {
                $(`#${$(this).data('id')}`).remove();  // this will remove the all element 
            }
        });
    });

})(jQuery);
