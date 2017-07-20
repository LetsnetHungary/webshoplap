<?
function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'éve',
        2592000 => 'hónapja',
        604800 => 'hete',
        86400 => 'napja',
        3600 => 'órája',
        60 => 'perce',
        1 => 'másodperce'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text;
    }

}
 $blog_post = $this->blog_post;   //a databaseből kiszedett postok (szerző, dátum, cím, tartalom...)
 $b_count = count($blog_post);
 if (isset($_GET['post_id'])) {
 $id = $b_count - $_GET['post_id']; }

?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
<?php if (isset($_GET[ 'post_id'])) {?>
$('#og_title').attr('content', '<?php echo $blog_post[$id]["blog_title"]; ?>');
$('#og_description').attr('content', 'webshoplap.hu');
$('#og_image').attr('content', 'http://webshoplap.graphed.hu/assets/images/blogs/<?php echo $_GET[ 'post_id']; ?>.png');
<?}?>
</script>

<main>

    <div class="container">
        <!-- minden, amibe bootstrapes elem kerül -->


        <div class="postholder row">
            <?php if (isset($_GET[ 'post_id'])) {?>
            <div class="col-md-8">
                <div class="box box-inner">
                    <div class="box-text">

                        <h1><?php echo $blog_post[$id]["blog_title"]; ?></h1>
                        <h4>Írta: <?php echo $blog_post[$id]['blog_author'] ?></h4>
                        <h5><span class="glyphicon glyphicon-time"></span> Közzétéve: <?php print_r($blog_post[$id]['blog_date']); ?></h5>
                        <h5><?php print_r($blog_post[$id]['blog_subtitle']); ?></h5>
                        <?php print_r($blog_post[$id][ 'blog_content']); ?>
                        
                    </div>
                    <div class="fbholder">
                        <!--<div class="fb-share-button" data-href="http://www.webshoplap.graphed.hu/Blog?=<?php echo $_GET['post_id']; ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Megosztás</a>-->
                        <div class="fb-share-button" data-href="<?php echo " http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "; ?>" data-layout="button_count" data-size="small" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwebshoplap.graphed.hu%2FBlog%3Fpost_id%3D8&amp;src=sdkpreparse">Megosztás</a></div>
                    </div>
                    <div data-width="100%" class="fb-comments" data-href="<?php echo " http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "; ?>" data-numposts="5"></div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 blogSuggest">
                <div class="box rc" style="margin-bottom: 0px;">
                    <!--<div class="boxTitle">
                        <div class="boxTitleTitle">Ajánlott blogbejegyzések</div>
                    </div>-->
                    <div class="row rightColumn">
                        <?php $count = 0; foreach ($blog_post as $value) { if(intval($value['blog_id'])!=intval($_GET['post_id']) && $count < 5){?>
                        <!--<div class="col-xs-12 shopHolder" data-id="<?php echo $blog_post; ?>">
                            <div class="boxAboutRow row">
                              <div class="absolute box-outer" data-id="<?php echo $value['blog_id']; ?>">
                                  <script type="text/javascript">
                                      $(".box-outer").click(function(l) {
                                          self = $(this);
                                          if (!$(l.target).hasClass("fb-share-button")) {
                                              window.location = "Blog?post_id=" + self.data('id')
                                          }
                                      })
                                  </script>

                                  <div class="blog_details">
                                      <h1> <?php print_r($blog['blog_title']); ?></h1>
                                      <h4>Írta: <?php print_r($blog['blog_author']); ?></h4>
                                      <h5><span class="glyphicon glyphicon-time"></span> Közzétéve: <?php print_r($blog['blog_date']); ?></h5>
                                      <h5><?php print_r($blog['blog_subtitle']);  ?></h5>
                                      <div class="fb-share-button" data-href="http://www.webshoplap.graphed.hu/Blog?=<?php echo $_GET['post_id']; ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Megosztás</a>
                                      </div>
                                  </div>
                              </div>
                            </div>

                        </div>-->
                        <div class="col-xs-12">
                            <div class="blogholder">
                                <div class="blogimage" style="background-image: url('/assets/images/blogs/<?echo $value['blog_id'];?>.png')"></div>
                                <div class="blog-outer smallblog" data-id="<?echo $value['blog_id'];?>">
                                    <div class="blogtext">
                                        <h5 style="width: 100%; margin-top: 0!important;"><?echo humanTiming(strtotime($value['blog_date']));?></h5>
                                        <div class="titleholder">
                                        <h4 style="width: 100%; margin: 0!important;"><?echo $value['blog_title'];?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <? $count++; ?>
                        <?php } }?> 
                    </div>
                </div>
                <?php }else{
                  foreach ($blog_post as $value) {?>

<div class="col-xs-12 col-md-6">
  <div class="blogholder">
    <div class="blogimage" style="background-image: url('/assets/images/blogs/<?echo $value['blog_id'];?>.png')"></div>
    <div class="blog-outer" data-id="<?echo $value['blog_id'];?>">
      <div class="blogtext">
        <h5 style="width: 100%; margin-top: 0!important;"><?echo humanTiming(strtotime($value['blog_date']));?></h5>
        <div class="titleholder">
          <h4 style="width: 100%; margin: 0!important;"><?echo $value['blog_title'];?></h4>
        </div>
      </div>
    </div>
  </div>
  </div>

<?}?>

<?}?>
  </div>
  </div>
  

</main>