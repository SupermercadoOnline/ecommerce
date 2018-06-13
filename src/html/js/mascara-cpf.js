$(document).ready(function () {
    $(".mascara-cpf").mask("999.999.999-99");
    $(".mascara-cpf").focusout(function () {
        var cpf, element;
        element = $(this);
        element.unmask();
        cpf = element.val().replace(/\D/g, '');
        if(cpf.length == 11){
            element.mask("999.999.999-99");
        }else{
            element.mask("999.999.999-99");
        }
    }).trigger('foucusout');
});
