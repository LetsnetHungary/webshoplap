curr = 100;
oldscroll = 0;
breakpoint = '';

function readyCarousel() {}

function colCount() {
    if (breakpoint == 'xs') {
        return 1;
    } else if (breakpoint == 'sm') {
        return 2;
    } else if (breakpoint == 'md') {
        return 3;
    } else {
        return 4;
    }
}

function removeBox() {
    old = $('.boxAbout');
    old.css('margin-bottom', 0)
    old.animate({
        height: 0
    }, 500, 'swing', function () {
        old.remove();
        curr = 100;
    });
}
var waitForFinalEvent = function () {
    var b = {};
    return function (c, d, a) {
        a || (a = "I'm a banana!");
        b[a] && clearTimeout(b[a]);
        b[a] = setTimeout(c, d)
    }
}();

function isBreakpoint(alias) {
    return $('.device-' + alias).is(':visible');
}

function getBreakPoint() {
    if (isBreakpoint('lg')) {
        return 'lg';
    } else if (isBreakpoint('md')) {
        return 'md';
    } else if (isBreakpoint('sm')) {
        return 'sm';
    } else {
        return 'xs';
    }
}

function setBreakpoint() {
    newbreakpoint = getBreakPoint();
    if (breakpoint != newbreakpoint) {
        $(window).trigger('breakpointChanged', [breakpoint, newbreakpoint]);
    }
    breakpoint = newbreakpoint;
}

function initShop(self, shop) {
    oldscroll = $(window).scrollTop();
    removeBox();
    elem = $(` <div class="col-xs-12 boxAbout" style="height: 0px">
   <div class="box">
      <div class="boxTitle">
         <div class="boxTitleTitle">` + shop['name'] + `</div>
         <div class="boxTitleArrow">
            <i class="fa fa-arrow-left"></i>
         </div>
      </div>
      
      
      <div class="boxAboutRow row hidden-sm hidden-md hidden-lg">
      <div class="col-xs-12 boxAboutTitleHolder" style="text-align:center;">
               <h3 class="shopname" style="margin-bottom: 10px; margin-top: 10px;">` + shop['name'] + `</h3>
      </div>
         <div class="col-xs-12 boxAboutImgHolderSmall" style="text-align:center;">
            <img class="boxAboutIcon img-responsive" src="` + ((shop['image'] == '') ? 'assets/images/placeholder.png' : shop['image']) + `">
         </div>
         <div class="col-xs-12 boxAboutDataHolderSmall">
           <div style="padding-right: 0" class="col-xs-9">
            <div class="dataholder">
               <a target="_blank" href="` + shop['adress'] + `">
                  <h4 class="datatext"><i class="fa fa-wifi icon"></i>` + shop['adress'] + `</h4>
               </a>
               <h4 class="datatext"><i class="fa fa-phone icon"></i>` + shop['phone'] + `</h4>
            </div>
          </div>
          <div class="col-xs-3" style="text-align:right">
            <button class="boxAboutButtonSmall btn">Több info</button>
            <iframe style="position: relative; left: 6px;" src="https://www.facebook.com/plugins/like.php?href=` + ((shop['facebook'] != '') ? shop['facebook'] : shop['adress']) + `&amp;width=120&amp;layout=button_count&amp;action=like&amp;size=small&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=118443608242792" width="120" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
        </div>
         </div>
      </div>
      <div class="boxAboutRow row hidden-xs">
         <div class="col-xs-6 boxAboutImgHolder">
            <img class="boxAboutIcon img-responsive" src="` + ((shop['image'] == '') ? 'assets/images/placeholder.png' : shop['image']) + `">
         </div>
         <div class="col-xs-6 boxAboutDataHolder">
            <div class="">
               <h3 class="shopname" style="margin-bottom: 30px;">` + shop['name'] + ` </h3>
               <a target="_blank" href="` + shop['adress'] + `">
                  <h4><i class="fa fa-wifi icon"></i>` + shop['adress'] + `</h4>
               </a>
               <h4><i class="fa fa-phone icon"></i>` + shop['phone'] + `</h4>
               <iframe src="https://www.facebook.com/plugins/like.php?href=` + ((shop['facebook'] != '') ? shop['facebook'] : shop['adress']) + `&amp;width=120&amp;layout=button_count&amp;action=like&amp;size=small&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=118443608242792" width="120" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
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
    elem.data('id', self.data('id'));
    if (self.hasClass('pin')) {
        elem.find('.shopname').append($('<img title="partner" class="pinned-image" src="assets/images/pinned.png">'));
    }
    cc = colCount();
    parent = self.closest('.boxHolder')
    ind = $('.boxHolder').index(parent) + 1;
    pos = (ind) % cc;
    if (pos == 0) {
        pos = cc;
    }
    elem.insertBefore($('.boxHolder').eq(ind - pos));
    hely = ind - pos;
    cucc = hely / cc;
    scrol = 520;
    if (shop['products'].length == 0) {
        scrol = 300;
        elem.find('.boxAboutRow').eq(2).remove();
    }
    elem.animate({
        height: scrol
    }, 500, 'swing', function () {});
    $("html, body").animate({
        scrollTop: $('#mainrow').offset().top + (270 * cucc)
    }, 500, 'swing', function () {

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
    for (ind in shop['products']) {
        prod = shop['products'][ind];
        asd = $('<div class="slide"><div class="slide-inner"><div class="product" style="background-image: url(\'assets/images/products/' + prod['imageid'] + '.png\');"><div class="price"><h2>' + prod['price'] + 'Ft<h2></div></div></div></div>');
        elem.find('.slider').append(asd);
        asd = '';
    }
    if (shop['products'].length > 0) {
        elem.find('.slider').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [{
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

function initSlider() {
    $('#topslider').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [{
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

function initSlider2() {
    $('.partnerslider').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1170,
                settings: {
                    dots: false,
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 970,
                settings: {
                    dots: false,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 750,
                settings: {
                    dots: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 500,
                settings: {
                    dots: false,
                    slidesToShow: 1
                }
            }
        ]
    });
}
$(function () {
    initSlider2();
    initSlider();
    setBreakpoint();
    $(window).resize(function () {
        waitForFinalEvent(function () {
            setBreakpoint();
        });
    });
    $(window).on('breakpointChanged', function (event, oldb, newb) {
        if ($('.boxAbout').length > 0) {
            $("html, body").scrollTop($('.boxAbout').offset().top);
        }
    })
    readyCarousel();
    $('.boxRow').on('click', function () {
        self = $(this);
        if (self.data('id') != $('.boxAbout').data('id')) {
            $.ajax({
                type: 'POST',
                url: 'Shop_API/getShop',
                data: {
                    id: self.data('id')
                },
                encode: true,
                success: function (result) {
                    res = JSON.parse(result)
                    initShop(self, res)
                },
                error: function (xhr, status, error) {}
            })
        } else {
            removeBox();
            $("html, body").animate({
                scrollTop: oldscroll
            }, 500, 'swing');
        }
    });
    $('.container').on('click', '.boxAbout .boxTitle', function () {
        removeBox();
        $("html, body").animate({
            scrollTop: oldscroll
        }, 500, 'swing');
    })
    $('.container').on('click', '.boxAboutButton', function () {
        id = $(this).closest('.boxAbout').data('id');
        f = $('<form action="Shop" name="vote" method="get" style="display:none;"><input type="text" name="id" value="' + id + '" /></form>').appendTo('body');
        f.submit();
    })
    
    $('.container').on('click', '.boxAboutButtonSmall', function () {
        id = $(this).closest('.boxAbout').data('id');
        f = $('<form action="Shop" name="vote" method="get" style="display:none;"><input type="text" name="id" value="' + id + '" /></form>').appendTo('body');
        f.submit();
    })
    $('.boxHolder .boxTitle').on('click', function () {
        id = $(this).closest('.boxHolder').data('id');
        window.location = 'Category?id=' + id;
    })
})