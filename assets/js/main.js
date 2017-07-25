var oldsize = 0;
function resize() {
    $('.datatitle').each(function() {
        $(this).css('font-size', oldsize)
        if($(this).find('span').length > 0) {
            sp = $(this).find('span');
                while(sp.position().left + sp.width() > $(this)[0].offsetWidth){
                    $(this).css('font-size', $(this).css('font-size').replace('px','') -1)
                }
        }
        
    })
}
$(function() {
    $('.pinned-image').each(function() {
        parent = $(this).parent();
        words = parent.text().split(' ')
        last = words[words.length-2]
        words.splice(words.length-2, 1)
        parent.text(words.join(' '))
        parent.append('<span style="white-space: nowrap;">' + last 
        + ' <img title="partner" class="pinned-image" src="assets/images/pinned.png"></span>');
        $(this).remove();
    });
    oldsize = $('.datatitle').eq(0).css('font-size').replace('px', '')
    resize()
    $(window).resize(function() {
        resize()
    })
});
