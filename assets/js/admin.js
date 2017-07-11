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
        $('<li class="list-group-item">'+ $('#labelname').val() +'</li>').appendTo('#labelholder');
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
    $('#shopname').val('');
    $('#adress').val('');
    $('#phone').val('');
    $('#bio').val('');
    $('#labelholder li:not(.active)').remove();
    $('#labelname').val('');
    $('#newshop').hide();
}
$(function() {
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
                    prepareCat(res, self.text());
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
                    el.hasClass('pinned') ? self.closest('.boxRow').removeClass('pinned-row').find('.pin-row').removeClass('pinned') : self.closest('.boxRow').addClass('pinned-row').find('.pin-row').addClass('pinned');
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
        $('#newshop').show();
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
});