$(function() {
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