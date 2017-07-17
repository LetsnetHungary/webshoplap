<?php $shops = $this->shops;
      $products = $this->products?>
<head>
<meta charset="utf-8">
<title>Webshoplap.hu</title>
<base target="_self">
<meta name="description" content="Magyarország összes webshopja egy helyen" />
<meta name="twitter:title" content="Webshoplap.hu">
<meta name="twitter:description" content="Magyarország összes webshopja egy helyen">
<meta name="twitter:image" content="/img/logo.png">
<meta property="og:title" content="Webshoplap.hu" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://webshoplap.hu/" />
<meta property="og:image" content="http://webshoplap.hu/img/logo.png" />
<meta property="og:description" content="Magyarország összes webshopja egy helyen" />
<meta property="fb:admins" content="1261262102,100000893412243" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
  <div class="container">
      <div class="row" id="mainrow">
        <!-- itt kezdődik a váz -->
        <div class="col-xs-12 slider-container">
                                <div id="topslider" class="slider">
                                  <?foreach($products as $product) {?>
                                  <div class="slide">
                                    <div class="slide-inner">
                                      <div class="product" style="background-image: url('assets/images/products/<?echo $product['imageid'];?>.jpg');">
                                        <div class="price">
                                          <h2><?echo $product['price'];?> Ft<h2>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <?}?>
                                </div>
                            </div>
        <?php foreach($shops as $key => $value) {

       ?>
       <!-- itt van a cucc -->
 <div class="col-xs-12 boxAbout" style="height: 520px">
   <div class="box">
      <div class="boxTitle">
         <div class="boxTitleTitle">adshsadkj</div>
         <div class="boxTitleArrow">
            <i class="fa fa-arrow-left"></i>
         </div>
      </div>
      <div class="boxAboutRow row hidden-xs">
         <div class="col-xs-6 boxAboutImgHolder">
            <img class="boxAboutIcon img-responsive" src="`+ ((shop['image'] == '') ? 'assets/images/placeholder.jpg' : shop['image']) +`">
         </div>
         <div class="col-xs-6 boxAboutDataHolder">
            <div class="">
               <h3 style="margin-bottom: 30px;">salkdjlkd</h3>
               <a target="_blank" href="` + shop['adress'] +`">
                  <h4><i class="fa fa-wifi icon"></i>www.index.hu</h4>
               </a>
               <h4><i class="fa fa-phone icon"></i>06-20-123-456, 06-20-123-456</h4>
               <iframe src="https://www.facebook.com/plugins/like.php?href=` + ((shop['facebook'] != '') ? shop['facebook'] : shop['adress']) +`&amp;width=120&amp;layout=button_count&amp;action=like&amp;size=small&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=118443608242792" width="120" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
            </div>
         </div>
         <button class="boxAboutButton btn">Több info</button>
      </div>
      <div class="boxAboutRow row hidden-sm hidden-md hidden-lg">
      <div class="col-xs-12" style="text-align:center;">
               <h3 style="margin-bottom: 30px;">salkdjlkd</h3>
      </div>
         <div class="col-xs-12 boxAboutImgHolder" style="text-align:center;">
            <img class="boxAboutIcon img-responsive" src="http://drlupo.hu/Content/images/products/p_18305/18305_1_thumb.jpg">
         </div>
         <div class="col-xs-12 boxAboutDataHolder">
            <div class="dataholder">
               <a target="_blank" href="` + shop['adress'] +`">
                  <h4 class="datatext"><i class="fa fa-wifi icon"></i>www.index.hu</h4>
               </a>
               <h4 class="datatext"><i class="fa fa-phone icon"></i>06-20-123-456</h4>
               <iframe src="https://www.facebook.com/plugins/like.php?href=` + ((shop['facebook'] != '') ? shop['facebook'] : shop['adress']) +`&amp;width=120&amp;layout=button_count&amp;action=like&amp;size=small&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=118443608242792" width="120" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
            </div>
         </div>
         <button class="boxAboutButton btn">Több info</button>
      </div>
      <div class="boxAboutRow row">
         <div class="col-xs-12 slider-container">
            <div class="slider">
            </div>
         </div>
      </div>
   </div>
</div>
          <!-- itt van a cucc -->
       <div class="boxHolder col-lg-3 col-md-4 col-sm-6 col-xs-12" data-id="<?php echo $value['id']; ?>">
          <div class="box">
            <div class="boxTitle">
              <div class="boxTitleTitle"><?php echo $key; ?></div>
              <div class="boxTitleArrow">
                <i class="fa fa-arrow-right"></i>
              </div>
            </div>
            <div class="boxContent">
              <?php foreach($value["pinned"] as $shop) { ?>
                <div class="boxRow pinned-row" data-id="<?php echo $shop['id'] ?>">
                  <p><?php echo $shop["name"]; ?></p>
                </div>
            <?php } ?>
            <?php foreach($value["unpinned"] as $shop) { ?>
                <div class="boxRow" data-id="<?php echo $shop['id'] ?>">
                  <p><?php echo $shop["name"]; ?></p>
                </div>
            <?php } ?>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
        <!-- itt végződik a váz -->
      </div>
      <!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent 
      <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "content": {
    "message": "Ez a weboldal cookie-kat (sütiket) használ azért, hogy weboldalunk használata során a lehető legjobb élményt tudjuk biztosítani. A weboldalunkon történő további böngészéssel hozzájárul a cookie-k használatához.",
    "dismiss": "Megértettem!",
    "link": "További információ.",
    "href": "http://webshoplap.hu/docs/adatvedelmi_szabalyzat.pdf"
  }
})});
</script>
      End Cookie Consent plugin Basszátok meg:(((((((-->
      <div class="device-xs visible-xs"></div>
  <div class="device-sm visible-sm"></div>
  <div class="device-md visible-md"></div>
  <div class="device-lg visible-lg"></div>
    </body>
