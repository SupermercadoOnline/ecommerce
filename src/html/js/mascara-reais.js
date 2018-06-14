$(document).ready(function () {
    $('.mascara-reais').maskMoney({
        prefix: '',
        allowNegative: false,
        allowZero: true,
        thousands: '.',
        decimal: ','
    });
});