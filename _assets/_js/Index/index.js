function colCount() {
    if ($(window).width() < 750) {
        return 1;
    }
    else if ($(window).width() >= 750 &&  $(window).width() < 970) {
        return 2;
    }
    else if ($(window).width() >= 970 &&  $(window).width() < 1170) {
        return 3;
    }
    else  {
        return 4;
    }
}
function removeBox() {old = $('.boxAbout');
    old.css('height', 0);
     setTimeout(function() {
         old.remove();
     }, 250)
}
$(function() {
    $('.boxRow').on('click', function() {
     removeBox();
    elem = $(`<div class="col-xs-12 boxAbout" style="height: 0px">
              <div class="box" style="height: 100%">
                  <div class="boxTitle">
                      <div class="boxTitleTitle">Boltnev</div>
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
                    <h3 style="margin-bottom: 30px;">Boltnev</h3>
                    <a href="www.bolt.hu"><h4><i class="fa fa-wifi icon"></i>www.bolt.hu</h4></a>
                    <h4><i class="fa fa-phone icon"></i>+36306665544</h4>
                    </div>
                    </div>
                  </div>
                  <button class="boxAboutButton btn">Több info</button>
              </div>
          </div>`);
        cc = colCount();
        console.log('cc ' + cc)
        parent = $(this).closest('.boxHolder')
        ind = $('.boxHolder').index(parent) + 1;
        pos = (ind) % cc;
        if(pos == 0) { pos = cc; }
        console.log(ind)
        console.log(pos)
        console.log(ind-pos)
        elem.insertBefore($('.boxHolder').eq(ind-pos));
        setTimeout(function(){
            elem.css('height', '');
        }, 10);
    });
    $('.container').on('click','.boxAbout .boxTitle', function() {
        removeBox();
    })
})