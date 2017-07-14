<?php $shops = $this->shops; ?>
<?php $catname = $this->catname ?>
<body>
    <div class="container">
          <div class="box">
            <div class="boxTitle">
              <div class="boxTitleTitle"><?php echo $catname["name"]; ?></div>
              <div class="boxTitleArrow">
                <i class="fa fa-arrow-left"></i>
              </div>
            </div>
            <div class="row" style="margin: 0;">
                <?php foreach ($shops as $shop) { ?>
                    <div class="col-lg-4 col-md-6 col-xs-12 shopHolder" data-id="<?php echo $shop["id"]; ?>">
                        <div class="boxAboutRow row">
                            <div class="col-xs-6 boxAboutImgHolder">
                                <img class="boxAboutIcon img-responsive" src="http://via.placeholder.com/160x160">
                            </div>
                            <div class="col-xs-6 boxAboutDataHolder">
                                <div class="">
                                <h3 style="margin-bottom: 30px;"><?php echo $shop["name"]; ?></h3>
                                <a href="http://<?php echo $shop['adress']; ?>"><h5><i class="fa fa-wifi icon"></i><?php echo $shop["adress"]; ?></h5></a>
                                <h5><i class="fa fa-phone icon"></i><?php echo $shop["phone"]; ?></h5>
                                </div>
                                </div>
                            </div>
                    </div>
                        <?php
                        }
                        ?>
            </div>
          </div>
    </div>
</body>