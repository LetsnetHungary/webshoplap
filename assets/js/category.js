$(function() {
    $('.shopHolder').on('click', function() {
        id = $(this).data('id');
        window.location = 'Shop?id='+id
    });
    $('.boxAboutIcon').removeClass('boxAboutIcon').load(function() {
        $(this).addClass('boxAboutIcon')
    });
    
});