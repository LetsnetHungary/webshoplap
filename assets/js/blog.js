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
    h = $('.box-inner').height();
        $('.rc').css('max-height', h+22);
    onElementHeightChange(document.body, function(){
        h = $('.box-inner').height();
        $('.rc').css('max-height', h+22);
    });
    $(".blog-outer").click(function(l){
    self = $(this);
    if (!$(l.target).hasClass("fb-share-button")) {
      window.location = "Blog?post_id=" + self.data('id')
    }
  }).hover(function() {
    $(this).prev().addClass('blurimage');
  }, function() {
    $(this).prev().removeClass('blurimage');
  });
})