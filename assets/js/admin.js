function showShop(res) {
    emptyShop();
    $('#newshop').data('pinned',res.pinned);
    $('#newshoptitle').text('Bolt szerkesztése');
    $('#doneshop').hide();
    $('#editshop').show();
    console.log(res)
    $('#shopname').val(res.name);
    $('#adress').val(res.adress);
    $('#phone').val(res.phone);
    $('#bio').val(res.bio);
    $('#labelholder li:not(.active)').remove();
    for(label in res.labels) {
        $('<li class="list-group-item"><div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>'+ res.labels[label]["name"] +'</li>').appendTo('#labelholder');
    }
    console.log(res.products);
    for(ind in res.products) {
        product = res.products[ind];
        $(`<li data-old="true" data-id="`+ product['id'] +`" class="col-xs-6 col-sm-4 col-md-3"><div class="slide-inner"><img class='image-responsive' src = "assets/images/products/`+ product['imageid'] +`.jpg"><div class="product"> 
                            <div class="price"><h2>` + product['price'] + `Ft<h2></div></div>
                            </div></li>`).appendTo('#productsHolder');
        
    }
    $('#labelname').val('');
    $('#newshop').show();
    console.log('asd');
    $("html, body").animate({ scrollTop: $('#newshop').offset().top}, 500, 'swing'); 
}
function emptyShop() {
    $('#shopname').val('');
    $('#adress').val('');
    $('#phone').val('');
    $('#bio').val('');
    $('#labelholder li:not(.active)').remove();
    $('#labelname').val('');
}
function prepareCat(res, self){
    
    
    content = $('.rightColumn .boxContent');
    content.empty();
    $(`<div class="boxRowAdd">
                            <button type="button" class="btn btn-success" id="addshop">Új bolt hozzáadása</button>
                        </div>`).appendTo(content);
    for(shop in res) {
        e = $(`<div class="boxRow" data-id="`+ res[shop]['id'] +`">`+ res[shop]['name'] +`
                            <div class="delete-row" style="display: none;">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                            </div><div class="pin-row" style="display: none;">
                                <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                            </div></div>`); 
                            if(res[shop]['pinned'] == 1) {
                                e.addClass('pinned-row');
                                e.find('.pin-row').addClass('pinned');
                            }
                            e.appendTo(content);
    }
    $('.rightColumn .boxTitleTitle').text(self.text())
    $('.rightColumn').show().data('id',self.data('id')) ;
    if($(window).width() <992) {
        console.log( $('.rightColumn').offset().top);
        $("html, body").animate({ scrollTop: $('.rightColumn').offset().top}, 500, 'swing'); 
    }
}
function addCategory() {
    if($('#catname').val() != ''){
        $.ajax({
                    type        : 'POST',
                    url         : 'Admin_API/addCategory',
                    data        : {
                        name: $('#catname').val()
                    },
                    encode          : true,
                    success: function(result){
                        result = JSON.parse(result);
                        $('#catname').val('').focus();
                        $(`<div class="boxRow" data-id="`+ result['id'] +`">
                                ` + result['name'] +`
                                <div class="delete-row" style="display: none">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </div>
                            </div>`).appendTo('.leftColumn .boxContent');
                    },
                    error: function(xhr, status, error){
                    }
                });
    }
}
function addLabel() {
    if($('#labelname').val() != ''){
        $('<li class="list-group-item"><div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>'+ $('#labelname').val() +'</li>').appendTo('#labelholder');
        $('#labelname').val('');
    }
    $('#labelname').focus();
}

function addShop(name, id) {
    $(`<div class="boxRow" data-id="`+ id +`">`+ name +`
                            <div class="delete-row" style="display: none;">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                            </div><div class="pin-row" style="display: none;">
                                <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                            </div></div>`).appendTo($('.rightColumn .boxContent'));
    emptyShop();
    $('#newshop').hide();
}
    function readFile(file) {
    reader = new FileReader();
    reader.onload = function(e) {
        text = e.target.result;
        img = new Image();
        img.onload = function() {
          if(img.width > img.height) {
              ratio = 500/ img.width
          } else {
              ratio = 500/img.height;
          }
          rw = ratio*img.width; rh = ratio*img.height;
          canvas = $('<canvas width="500" height="500" style="display: none;"></canvas>');
          ctx = canvas[0].getContext('2d');
          ctx.fillStyle = 'white';
          ctx.fillRect(0, 0, 500, 500);
          console.log('rw: ' + rw +', rh: ' + rh + ', cuc: ' )
          console.log( 250 - (rw / 2))
          console.log( 250 + (rw / 2))
          ctx.drawImage(this,250 - (rw / 2),250 - (rh / 2),rw,rh);
          dataurl = canvas[0].toDataURL('image/jpeg');
          $('#preview-img').attr('src', dataurl);
        }
        img.src = text;
    }
    reader.readAsDataURL(file);
  }
  function clearImage() {
      $('#preview-img').attr('src','#');
      $('#prodprice').val('')
  }
$(function() {
    $('.add-row').click(function() {
        clearImage();
        $('#uploadcontainer').toggle()
    })
    $('#addproduct').click(function() {
        $(`<li class="col-xs-6 col-sm-4 col-md-3"><div class="slide-inner"><img class='image-responsive' src = "` +
        $('#preview-img').attr('src') +`"><div class="product"> 
                            <div class="price"><h2>` + $('#prodprice').val() + `Ft<h2></div></div>
                            </div></li>`).data('price', $('#prodprice').val()).appendTo('#productsHolder');
                            clearImage();
    });
  $('#prod-imginput').change(function() {
    files = this.files;
      readFile(files[0]);
  });
    $('#productsHolder').sortable({
        placeholder: "ui-state-highlight slide-inner placeholder col-xs-6 col-sm-4 col-md-3"
    });
    $('.container').on('click','.leftColumn .boxRow', function(e) {
        if(!$(e.target).hasClass('delete-row') && !$(e.target).hasClass('fa-times')) {
            self = $(this)
            $.ajax({
                type        : 'POST',
                url         : 'Admin_API/getShops',
                data        : {
                    id: self.data('id')
                },
                encode          : true,
                success: function(result){
                    res = JSON.parse(result)
                    prepareCat(res, self);
                },
                error: function(xhr, status, error){
                }
            });
        } else {
            self = $(this)
            $.ajax({
                type        : 'POST',
                url         : 'Admin_API/removeCategory',
                data        : {
                    id: self.data('id')
                },
                encode          : true,
                success: function(result){
                    if(self.data('id') == $('.rightColumn').data('id')) {
                        $('.rightColumn').hide();
                    }
                    self.closest('.boxRow').remove();
                },
                error: function(xhr, status, error){
                }
            });
        }
    });
    
    $('.container').on('click', '.rightColumn .boxRow', function(e) {
        if(!$(e.target).hasClass('delete-row') && !$(e.target).hasClass('fa-times') &&
        !$(e.target).hasClass('pin-row') && !$(e.target).hasClass('fa-thumb-tack')) {
            self = $(this)
            $.ajax({
                type        : 'POST',
                url         : 'Admin_API/getShop',
                data        : {
                    id: self.data('id')
                },
                encode          : true,
                success: function(result){
                    res = JSON.parse(result)
                    showShop(res)
                    $('#newshop').data('id',self.data('id'))
                },
                error: function(xhr, status, error){
                }
            });
        } else if($(e.target).hasClass('delete-row') || $(e.target).hasClass('fa-times')) {
            self = $(this)
            $.ajax({
                type        : 'POST',
                url         : 'Admin_API/removeShop',
                data        : {
                    id: self.data('id')
                },
                encode          : true,
                success: function(result){
                    self.closest('.boxRow').remove();
                },
                error: function(xhr, status, error){
                }
            });
        } else {
            self = $(this)
            
            $.ajax({
                type        : 'POST',
                url         : 'Admin_API/pinShop',
                data        : {
                    id: self.data('id'),
                    pin: self.closest('.boxRow').find('.pin-row').hasClass('pinned') ? 0 : 1
                },
                encode          : true,
                success: function(result){
                    console.log(result)
                    el = self.closest('.boxRow').find('.pin-row');
                    console.log(el.hasClass('pinned'))
                    if(el.hasClass('pinned')) {
                        self.closest('.boxRow').removeClass('pinned-row').find('.pin-row').removeClass('pinned')
                    } else {
                         self.closest('.boxRow').addClass('pinned-row').find('.pin-row').addClass('pinned');
                         self.closest('.boxRow').clone().insertAfter('.rightColumn .boxRowAdd');
                         self.closest('.boxRow').remove();
                    }
                },
                error: function(xhr, status, error){
                }
            });
        }
    });
    $('.boxTitle').on('click', function() {
        parent = $(this).closest('.col-md-6');
        if(parent.data('edit')){
            parent.find('.delete-row').hide();
            parent.find('.pin-row').hide();
            parent.data('edit', false);
            $(this).find('.boxTitleEdit').text('Szerkesztés');
        } else {
            parent.find('.delete-row').show();
            parent.find('.pin-row').show();
            parent.data('edit', true);
            $(this).find('.boxTitleEdit').text('Kész');
        }
    });
    $('#addcat').on('click', function() {
        addCategory();
    });
    $('#catname').keypress(function(e) {
        if(e.which == 13) {
            $(this).blur();
            $('#addcat').focus().click();
        }
    });
    $('.container').on('click', '#addshop', function() {
        emptyShop();
        $('#newshoptitle').text('Új bolt hozzáadása');
        $('#doneshop').show();
        $('#editshop').hide();
        $('#newshop').show();
        console.log('bsd')
        $("html, body").animate({ scrollTop: $('#newshop').offset().top}, 500, 'swing');
    });
    
    $('#addlabel').on('click', function() {
        addLabel();
    });
    $('#labelname').keypress(function(e) {
        if(e.which == 13) {
            $(this).blur();
            $('#addlabel').focus().click();
        }
    });
    $('.container').on('click', 'li .delete-row', function() {
        $(this).closest('li').remove();
    });
    $('#editshop').on('click', function() {
        shop = new Object();
        shop.name = $('#shopname').val();
        shop.adress = $('#adress').val();
        shop.phone = $('#phone').val();
        shop.bio = $('#bio').val();
        shop.id = $('#newshop').data('id');
        shop.category = $('.rightColumn').data('id');
        shop.pinned = $('#newshop').data('pinned');
        shop.labels = new Array();
        $('#labelholder li:not(.active)').each(function(index,elem) {
            shop.labels.push($(this).text());
        });
        shop.products = new Array();
        i = 0;
        $('#productsHolder li').each(function() {
            prod = new Object();
            if($(this).attr('data-old')){ prod.type = 'old'; prod.id = $(this).data('id') }else{ prod.type = 'new'}
            prod.image = $(this).find('img').attr('src');
            prod.price = $(this).data('price')
            prod.position = i;
            i+=1;
            shop.products.push($.extend(true, {}, prod));
            prod="";
        })
        $.ajax({
            url: 'Admin_API/updateShop',
            type: 'POST',
            data: { shop: JSON.stringify(shop)},
            dataType: 'json',
            encode: true,
            success: function(result){
                $('.rightColumn .boxRow').each(function() {
                    if($(this).data('id') == $('#newshop').data('id')){
                        e = $(`<div class="boxRow" data-id="`+ result["id"] +`">`+ result["name"] +`
                                    <div class="delete-row" style="display: none;">
                                        <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                    </div><div class="pin-row" style="display: none;">
                                        <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                                    </div></div>`).insertAfter($(this));
                                    if($('#newshop').data('pinned') == 1) {
                                        e.addClass('pinned-row').find('.pin-row').addClass('pinned');
                                    }
                        $(this).remove();
                    }
                })
                emptyShop();
                $('#newshop').hide();

            },
            error: function(xhr, status, error){
                console.log(xhr)
            }
        });
    });
    $('#doneshop').on('click', function() {
        shop = new Object();
        shop.name = $('#shopname').val();
        shop.adress = $('#adress').val();
        shop.phone = $('#phone').val();
        shop.bio = $('#bio').val();
        shop.labels = new Array();
        $('#labelholder li:not(.active)').each(function(index,elem) {
            console.log($(this))
            shop.labels.push($(this).text());
        });
        shop.category = $('.rightColumn').data('id');
        shop.products = new Array();
        i = 0;
        $('#productsHolder li').each(function() {
            prod = new Object();
            $(this).attr('data-old') ? prod.type = 'old' : prod.type = 'new';
            prod.image = $(this).find('img').attr('src');
            prod.price = $(this).data('price')
            prod.position = i;
            i+=1;
            shop.products.push($.extend(true, {}, prod));
            prod="";
        })
        console.log('eddik ok')
        $.ajax({
        url: 'Admin_API/addShop',
        type: 'POST',
        data: { shop: JSON.stringify(shop)},
        dataType: 'json',
        encode: true,
        success: function(result){
            addShop(result["name"], result["id"]);
        },
        error: function(xhr, status, error){
        }
    });
})
$('#addnewusr').click(function() {
    $('#newusrform .form-group').toggle();
    $(this).hide();
    $('#doneusr').show();
});
});