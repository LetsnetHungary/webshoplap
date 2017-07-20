function onElementHeightChange(elm, callback){
    var lastHeight = elm.clientHeight, newHeight;
    (function run(){
        newHeight = elm.clientHeight;
        if( lastHeight != newHeight )
            callback();
        lastHeight = newHeight;

        if( elm.onElementHeightChangeTimer )
            clearTimeout(elm.onElementHeightChangeTimer);

        elm.onElementHeightChangeTimer = setTimeout(run, 200);
    })();
}
$(function() {
    
        h = $('.leftColumn').height();
        $('.rightColumn').css('max-height', h-10);
        onElementHeightChange(document.body, function(){
        h = $('.leftColumn').height();
        $('.rightColumn').css('max-height', h-10);
    });
        $('.slider').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 2,
            slidesToScroll: 1,
            responsive: [
                {
                breakpoint: 990,
                settings: {
                    slidesToShow: 3
                }
                },
                {
                breakpoint: 700,
                settings: {
                    slidesToShow: 2
                }
                },
                {
                breakpoint: 530,
                settings: {
                    slidesToShow: 1
                }
                }
            ]
        });
        $(window).resize(function() {
            //$('.rightColumn').css('max-height', $('.leftColumn').height());
        });
        $('.shopHolder').on('click', function() {
            id = $(this).data('id');
            window.location = 'Shop?id='+id
        });
    
})