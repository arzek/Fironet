$(document).ready(function () {
    /**
     * TODO No price
      */
    $('#no_price').change(function () {
        if($(this).prop("checked"))
        {
            $('.field-services-price').hide();
            $('#services-price').val('');
        }else
        {
            $('.field-services-price').show();
        }
    });
});