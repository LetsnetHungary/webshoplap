<?php $shops = $this->shops;?>
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
        <?php foreach($shops as $key => $value) {

       ?>
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
