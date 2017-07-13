curr = 100;
oldscroll = 0;
breakpoint = '';
function readyCarousel() {
}
function colCount() {
    if (breakpoint == 'xs') {
        return 1;
    }
    else if (breakpoint == 'sm') {
        return 2;
    }
    else if (breakpoint == 'md') {
        return 3;
    }
    else  {
        return 4;
    }
}
function removeBox() {
    old = $('.boxAbout');
    old.css('margin-bottom',0)
    old.animate({height: 0}, 500, 'swing', function() {
        old.remove();
        curr = 100;
    }); 
}
var waitForFinalEvent = function(){var b={};return function(c,d,a){a||(a="I'm a banana!");b[a]&&clearTimeout(b[a]);b[a]=setTimeout(c,d)}}();
function isBreakpoint( alias ) {
    return $('.device-' + alias).is(':visible');
}
function getBreakPoint() {
    if(isBreakpoint('lg')) {
        return 'lg';
    } else if (isBreakpoint('md')){
        return 'md';
    } else if (isBreakpoint('sm')){
        return 'sm';
    } else{
        return 'xs';
    }
}
function setBreakpoint() {
    newbreakpoint = getBreakPoint();
    if(breakpoint != newbreakpoint) {
        $(window).trigger('breakpointChanged', [breakpoint, newbreakpoint]);
    }
    breakpoint = newbreakpoint;
}
function initShop(self,shop) {
    oldscroll = $(window).scrollTop();
    removeBox();
    elem = $(`<div class="col-xs-12 boxAbout" style="height: 0px">
    <div class="box">
                <div class="boxTitle">
                            <div class="boxTitleTitle">` + shop['name'] +`</div>
                                <div class="boxTitleArrow">
                                    <i class="fa fa-arrow-left"></i>
                                </div>
                        </div>
                        <div class="boxAboutRow row">
                        <div class="col-xs-6 boxAboutImgHolder">
                            <img class="boxAboutIcon img-responsive" src="http://via.placeholder.com/200x200">
                        </div>
                        <div class="col-xs-6 boxAboutDataHolder">
                            <div class="">
                            <h3 style="margin-bottom: 30px;">` + shop['name'] +`</h3>
                            <a href="http://` + shop['adress'] +`"><h4><i class="fa fa-wifi icon"></i>` + shop['adress'] +`</h4></a>
                            <h4><i class="fa fa-phone icon"></i>` + shop['phone'] +`</h4>
                            </div>
                            </div>
                        <button class="boxAboutButton btn">Több info</button>
                        </div>
                        <div class="boxAboutRow row">
                            <div class="col-xs-12 slider-container">
                                <div class="slider">
                                    
                                </div>
                            </div>
                        </div>
                        </div>
          </div>`);
          elem.data('id',self.data('id'));
        cc = colCount();
        parent = self.closest('.boxHolder')
        ind = $('.boxHolder').index(parent) + 1;
        pos = (ind) % cc;
        if(pos == 0) { pos = cc; }
        elem.insertBefore($('.boxHolder').eq(ind-pos));
        hely = ind-pos;
        cucc = hely / cc;
        scrol = 520;
        if(shop['products'].length == 0) {
            scrol = 300;
            elem.find('.boxAboutRow').eq(1).remove();
        }
        elem.animate({height: scrol}, 500, 'swing', function() {
        } );
        $("html, body").animate({ scrollTop: $('#mainrow').offset().top + (270*cucc)}, 500, 'swing', function() {
                
            });
        //tt = elem.offset().top
        /*if(curr > hely) {
            console.log('ez')
            $("html, body").animate({ scrollTop: tt}, 500, 'swing', function() {
                curr = hely;
                console.log(curr)
            });
        } else {
            $("html, body").animate({ scrollTop: tt-scrol}, 500, 'swing', function() {
                curr = hely;
                console.log(curr)
            });
        }*/
        for(ind in shop['products']) {
            prod = shop['products'][ind];
            asd = $('<div class="slide"><div class="slide-inner"><div class="product" style="background-image: url(\'assets/images/products/'+ prod['imageid'] +'.jpg\');"><div class="price"><h2>'+ prod['price'] +'Ft<h2></div></div></div></div>');
            elem.find('.slider').append(asd);
            asd = '';
        }
        if(shop['products'].length > 0) {
        elem.find('.slider').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [
                {
                breakpoint: 1170,
                settings: {
                    slidesToShow: 4
                }
                },
                {
                breakpoint: 970,
                settings: {
                    slidesToShow: 3
                }
                },
                {
                breakpoint: 750,
                settings: {
                    slidesToShow: 2
                }
                },
                {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1
                }
                }
            ]
        });
        }
}
$(function() {
    setBreakpoint();
    $(window).resize(function() {
        waitForFinalEvent(function() {
            setBreakpoint();
        });
    });
    $(window).on('breakpointChanged', function(event, oldb, newb) {
        if($('.boxAbout').length > 0) {
            $("html, body").scrollTop($('.boxAbout').offset().top);
        }
    })
    readyCarousel();
    $('.boxRow').on('click', function() {
     self = $(this);
     if(self.data('id') != $('.boxAbout').data('id')){
         $.ajax({
            type        : 'POST',
            url         : 'Shop_API/getShop',
            data        : {
                id: self.data('id')
            },
            encode          : true,
            success: function(result){
                res = JSON.parse(result)
                initShop(self,res)
            },
            error: function(xhr, status, error){
            }
        })
     } else {
         removeBox();
         $("html, body").animate({ scrollTop: oldscroll}, 500, 'swing');
     }
    });
    $('.container').on('click','.boxAbout .boxTitle', function() {
        removeBox();
        $("html, body").animate({ scrollTop: oldscroll}, 500, 'swing');
    })
    $('.container').on('click','.boxAboutButton', function() {
        id = $(this).closest('.boxAbout').data('id');
        f = $('<form action="Shop" name="vote" method="get" style="display:none;"><input type="text" name="id" value="' + id + '" /></form>').appendTo('body');
        f.submit();
    })
    $('.boxHolder .boxTitle').on('click', function() {
        id = $(this).closest('.boxHolder').data('id');
        window.location = 'Category?id=' + id;
    })
})