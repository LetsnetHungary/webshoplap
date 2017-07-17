<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?
 $blog_post = $this->blog_post;   //a databaseből kiszedett postok (szerző, dátum, cím, tartalom...)
 $b_count = count($blog_post);
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<main>

  <div class="container"> <!-- minden, amibe bootstrapes elem kerül -->


  <div class="postholder row">
    <?php
    if (isset($_GET['post_id'])) {?>
      <div class="col-xs-12">
        <div class="box box-inner">
          <h1><?php echo $blog_post[0]["blog_title"]; ?></h1>
          <h4>Írta: <?php echo $blog_post[0]['blog_author'] ?></h4>
          <h5><span class="glyphicon glyphicon-time"></span> Közzétéve: <?php print_r($blog_post[0]['blog_date']); ?></h5>
          <h5><?php print_r($blog_post[0]['blog_subtitle']); ?></h5>
          <?php print_r($blog_post[0]['blog_content']); ?>

        </div>
        <div data-width="100%" class="fb-comments" data-href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" data-numposts="5"></div>

      </div>
    <?php }
    else{
      foreach ($blog_post as $value) {
        $title = $value['blog_title'];
        $url = "Blog address";

        ?>
        <div class="col-md-6">
          <div class="box box-outer" data-id="<?php echo $value['blog_id']; ?>">
            <script type="text/javascript">
              $(".box").click(function(l){
                self = $(this);
                if (!$(l.target).hasClass("fb-share-button")) {
                  window.location = "Blog?post_id=" + self.data('id')
                }
              })
            </script>

          <div class="blog_details">
            <h1> <?php print_r($value['blog_title']); ?></h1>
            <h4>Írta: <?php print_r($value['blog_author']); ?></h4>
            <h5><span class="glyphicon glyphicon-time"></span> Közzétéve: <?php print_r($value['blog_date']); ?></h5>
            <h5><?php print_r($value['blog_subtitle']);  ?></h5>
            <div class="fb-share-button" data-href="http://www.webshoplap.graphed.hu/Blog?=<?php echo $_GET['post_id']; ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Megosztás</a></div>
          </div>

           <!--
          <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=80&layout=button_count&action=like&size=small&show_faces=false&share=false&height=21&appId" width="80" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
          https://developers.facebook.com/docs/plugins/like-button# <- facebook like gomb -->
        </div>
      </div>
        <?
      }
    }
      ?>
  </div>
  </div>
</main>






<!--


    <div class="container">
      <div class="row">

        <div class="col-md-6">
          <p class="title"><a href="link oldal">Title of the blog post</a></p>
          <p class="author">Írta: XY</p>
          <p class="date">Közzétéve: 2017.06.27</p>
          <p class="further">További info</p>

        </div>

        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
      </div>
    </div>
  -->
