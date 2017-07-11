function prepareCat(res, catname){
    content = $('.rightColumn .boxContent');
    content.empty();
    $(`<div class="boxRowAdd">
                            <button type="button" class="btn btn-success" id="addshop">Új bolt hozzáadása</button>
                        </div>`).appendTo(content);
    for(shop in res) {
        $(`<div class="boxRow" data-id="`+ res[shop]['id'] +`">`+ res[shop]['name'] +`
                            <div class="delete-row" style="display: none;">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                            </div></div>`).appendTo(content);
    }
    $('.rightColumn .boxTitleTitle').text(catname)
    $('.rightColumn').show();
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
                        $('#catname').val('');
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
}
$(function() {
    $('.container').on('click','.leftColumn .boxRow', function(e) {
        if(!$(e.target).hasClass('delete-row') && !$(e.target).hasClass('fa')) {
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
                    prepareCat(res, self.text());
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
                    console.log(result)
                    self.closest('.boxRow').remove();
                },
                error: function(xhr, status, error){
                }
            });
        }
    });
    
    $('.container').on('click', '.rightColumn .boxRow', function(e) {
        if(!$(e.target).hasClass('delete-row') && !$(e.target).hasClass('fa')) {
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
        } else {
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
        }
    });
    $('.boxTitle').on('click', function() {
        parent = $(this).closest('.col-md-6');
        if(parent.data('edit')){
            parent.find('.delete-row').hide();
            parent.data('edit', false);
            $(this).find('.boxTitleEdit').text('Szerkesztés');
        } else {
            parent.find('.delete-row').show();
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
});