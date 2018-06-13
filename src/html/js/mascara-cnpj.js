$(document).ready(function () {
    $('.mascara-cnpj').mask('99.999.999/9999-99');
    $('.mascara-cnpj').focusout(function () {
        var cnpj, element;
        element = $(this);
        element.unmask();
        cnpj = element.val().replace('/\D/g', '');
        if(cnpj.length == 14){
            element.mask('99.999.999/9999-99')
        }else{
            element.mask('99.999.999/9999-99')
        }
    }).trigger('focusout');
});
