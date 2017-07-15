<?php $shops = $this->shops; ?>
<?php $labelname = $this->labelname ?>
<body>
    <div class="container">
          <div class="box">
            <div class="boxTitle">
              <div class="boxTitleTitle"><?php echo $labelname; ?></div>
              <div class="boxTitleArrow">
                <i class="fa fa-arrow-left"></i>
              </div>
            </div>
            <div class="row justify-content-center" style="margin: 0;">
                <?php foreach ($shops as $shop) { ?>
                    <div class="col-lg-4 col-md-6 col-xs-12 shopHolder" data-id="<?php echo $shop["id"]; ?>">
                        <div class="boxAboutRow row">
                            <div class="col-xs-6 boxAboutImgHolder">
                                <img class="boxAboutIcon img-responsive" src="<? if($shop["image"] == ""){echo "assets/images/placeholder.jpg";  }else{echo $shop["image"];}?>">
                            </div>
                            <div class="col-xs-6 boxAboutDataHolder">
                                <div class="dataholder">
                                <h3 class="datatitle" style="margin-bottom: 30px;"><?php echo $shop["name"]; ?></h3>
                                <a "target = "_blank" href=<?php echo $shop['adress']; ?>"><h5 class="datatext"><i class="fa fa-wifi icon"></i><?php echo $shop["adress"]; ?></h5></a>
                                <h5 class="datatext"><i class="fa fa-phone icon"></i><?php echo $shop["phone"]; ?></h5>
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
