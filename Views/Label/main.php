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
            <div class="row" style="margin: 0;">
                <?php foreach ($shops as $shop) { ?>
                    <div class="col-lg-6 col-md-6 col-xs-12 shopHolder" data-id="<?php echo $shop["id"]; ?>">
                    <div class="shopHolderInner">
                        <div class="boxAboutRow row">
                            <div class="col-xs-5 boxAboutImgHolder vcenter">
                                 <div class="innerimageholder">
                                     <div>
                                        <img class="boxAboutIcon" src="<? if($shop["image"] == ""){echo "assets/images/placeholder.png";  }else{echo $shop["image"];}?>">
                                     </div>
                                </div>
                            </div><!--
    --><div class="col-xs-7 boxAboutDataHolder vcenter">
                                <div class="dataholder">
                                <h3 class="datatitle" style="margin-bottom: 30px;"><?php echo $shop["name"]; ?> <? if($shop['pinned'] != 0){?><img title="partner" class="pinned-image" src="assets/images/pinned.png"><?} ?></h3>
                                <a target = "_blank" href="<?php echo $shop['adress']; ?>"><h5 class="datatext"><i class="fa fa-wifi icon"></i><?php echo $shop["adress"]; ?></h5></a>
                                <h5 class="datatext"><i class="fa fa-phone icon"></i><?php echo $shop["phone"]; ?></h5>
                                </div>
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
