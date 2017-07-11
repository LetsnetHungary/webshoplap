<?
 $blog_post = $this->blog_post;   //a databaseből kiszedett postok (szerző, dátum, cím, tartalom...)
 $b_count = count($blog_post);
?>
<main>
  <div class="postholder">
    <?
      for ($i=0; $i < $b_count ; $i++) {

        ?>
        <div class="col-md-6">
          <div class="imageholder">
            <img src="assets/img/placeholder_pic.png" alt="">
          </div>
          <div class="blog_details">
            <p> <?php print_r($blog_post['blog_title']); ?></p>
          </div>
           <!--
          <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=80&layout=button_count&action=like&size=small&show_faces=false&share=false&height=21&appId" width="80" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
          https://developers.facebook.com/docs/plugins/like-button# <- facebook like gomb -->
        </div>
        <?
      }
      ?>

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
