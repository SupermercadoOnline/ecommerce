$(document).ready(function () {
    $('.mascara-cep').mask('99999-999');
    $('.mascara-cep').focusout(function () {
        var cep, element;
        element = $(this);
        element.unmask();
        cep = element.val().replace('/\D/g', '');
        if(cep.length == 9){
            element.mask('99999-999');
        }else{
            element.mask('99999-999');
        }
    }).trigger('focusout');
});
