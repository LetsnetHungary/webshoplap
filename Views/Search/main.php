<?php $shops=$this->shops; $products = $this->products;?>

<body>
    <div class="container">
        <div class="box">
            <div class="boxTitle">
                <div class="boxTitleTitle"></div>
                <div class="boxTitleArrow">
                    <i class="fa fa-arrow-left"></i>
                </div>
            </div>
            <div class="row" style="margin: 0;">
                <?php if (count($shops) < 1 && count($products) < 1) {?>
                <p class="no-search-result">
                    <?php echo "Nincs a keresésnek megfelelő elem"; ?>
                </p>
                <?php return; } else{ ?>

              <? if(count($products)> 0) {?>
                <div class="col-xs-12">
                    <h4>Termékek:</h4>
                </div>
                <?} foreach ($products as $product) { ?>
                      <div class="col-md-4 col-sm-6 col-xs-12 shopHolder"  data-id="<?php echo $product["shop"]; ?>">
                          <div class="shopHolderInner prodholder">
                            <div class="boxAboutRow row" style="margin: 0">
                                <div class="col-xs-5 boxAboutImgHolder vcenter">
                                    <div class="innerimageholder">
                                        <div>
                                            <img class="boxAboutIcon" src="/assets/images/products/<? echo $product["imageid"]; ?>.png">
                                        </div>
                                    </div>
                                </div><!--
    --><div class="col-xs-7 boxAboutDataHolder vcenter">
                                    <div class="dataholder">
                                        <h4 class="datatitle" style="margin-bottom: 30px;"><?php echo $product["name"]; ?></h4>
                                        <h3 class="datatext"> <?php echo $product["price"]; ?> Ft</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    <? }?>



                  <? if(count($shops)> 0) {?>
                <div class="col-xs-12">
                    <h4>Webshopok:</h4>
                </div>
                <?} foreach ($shops as $shop) { ?>
                    <div class="col-lg-6 col-md-6 col-xs-12 shopHolder" data-id="<?php echo $shop["id"]; ?>">
                        <div class="shopHolderInner">
                            <div class="boxAboutRow row">
                                <div class="col-xs-5 boxAboutImgHolder vcenter">
                                    <div class="innerimageholder">
                                        <div>
                                            <img data-name="<?php echo $shop["name"]; ?>" class="boxAboutIcon <? if($shop["image"] == ""){echo "noimg";}?>" src="<? if($shop["image"] == ""){echo "assets/images/placeholder.png";  }else{echo $shop["image"];}?>">
                                        </div>
                                    </div>
                                </div><!--
    --><div class="col-xs-7 boxAboutDataHolder vcenter">
                                    <div class="dataholder">
                                        <h3 class="datatitle" style="margin-bottom: 30px;"><?php echo $shop["name"]; ?></h3>
                                        <a target="_blank" href="<?php echo $shop['adress']; ?>"><h5 class="datatext"><i class="fa fa-wifi icon"></i><?php echo $shop["adress"]; ?></h5></a>
                                        <h5 class="datatext"><i class="fa fa-phone icon"></i><?php echo $shop["phone"]; ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <? }?>

                    <? } ?>
            </div>
        </div>
    </div>
</body>