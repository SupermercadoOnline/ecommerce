$(document).ready(function () {
    const height_body = $('body').height();
    const height_window = $(window).height();
    if(height_body < height_window){
        const margin_top_footer = height_window - height_body - 70;
        $('#footer').css('margin-top', margin_top_footer);
    }
});

