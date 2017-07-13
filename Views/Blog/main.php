<?
 $blog_post = $this->blog_post;   //a databaseből kiszedett postok (szerző, dátum, cím, tartalom...)
 $b_count = count($blog_post);
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<main>

  <div class="container"> <!-- minden, amibe bootstrapes elem kerül -->


  <div class="postholder row">
    <?
      for ($i=0; $i < $b_count ; $i++) {

        ?>
        <div class="col-md-6">
          <div class="box">
            <script type="text/javascript">
              $(".box").click(function(l){
                if (!$(l.target).hasClass("fb-share-button")) {
                  window.location = "Index"
                }
              })
            </script>
          <div class="blog_details">
            <h1> <?php print_r($blog_post[$i]['blog_title']); ?></h1>
            <h4>Írta: <?php print_r($blog_post[$i]['blog_author']); ?></h4>
            <h5><span class="glyphicon glyphicon-time"></span> Közzétéve: <?php print_r($blog_post[$i]['blog_date']); ?></h5>
            <h5><?php print_r($blog_post[$i]['blog_subtitle']);  ?></h5>
            <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Megosztás</a></div>          </div>
           <!--
          <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=80&layout=button_count&action=like&size=small&show_faces=false&share=false&height=21&appId" width="80" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
          https://developers.facebook.com/docs/plugins/like-button# <- facebook like gomb -->
        </div>
      </div>
        <?
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
