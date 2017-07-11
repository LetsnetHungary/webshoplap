function prepareCat(res, catname){
    content = $('.rightColumn .boxContent');
    content.empty();
    for(shop in res) {
        $(`<div class="boxRow" data-id="`+ res[shop]['id'] +`">`+ res[shop]['name'] +`
                            <div class="delete-row" style="display: none;">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                            </div></div>`).appendTo(content);
    }
    $('.rightColumn .boxTitleTitle').text(catname)
    $('.rightColumn').show();
}
$(function() {
    $('.leftColumn .boxRow').on('click', function(e) {
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
    $('.boxTitleEdit').on('click', function() {
        parent = $(this).closest('.col-md-6');
        if(parent.data('edit')){
            parent.find('.delete-row').hide();
            parent.data('edit', false);
            $(this).text('Szerkesztés');
        } else {
            parent.find('.delete-row').show();
            parent.data('edit', true);
            $(this).text('Kész');
        }
    });
});