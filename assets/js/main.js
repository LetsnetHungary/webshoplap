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
})