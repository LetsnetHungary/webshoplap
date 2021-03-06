
<?php $shop = $this->shop;?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-xs-12">
                <div class="box leftColumn" style="padding-bottom: 20px;" data-id="<?php echo $shop["id"]; ?>">
                    <div class="boxTitle">
                        <div class="boxTitleTitle"><?php echo $shop["name"]; ?></div>
                        <div class="boxTitleArrow">
                            <i class="fa fa-arrow-left"></i>
                        </div>
                    </div>
                    <div class="boxAboutRow row hidden-xs">
                        <div class="col-xs-6 boxAboutImgHolder">
                            <img class="boxAboutIconTop img-responsive" src="<? if($shop["image"] == ""){echo "assets/images/placeholder.png";  }else{echo $shop["image"];}?>">
                        </div>
                        <div class="col-xs-6 boxAboutDataHolder">
                            <div class="aboutholder">
                                <h3 class="datatitle" style="margin-bottom: 30px;"><?php echo $shop["name"]; ?> <? if($shop['pinned'] != 0){?><img title="partner" class="pinned-image" src="assets/images/pinned.png"><?} ?></h3>
                                <a target="_blank" href="<?php echo $shop["adress"]; ?>">
                                    <h4 class="datatext"><i class="fa fa-wifi icon"></i><?php echo $shop["adress"]; ?></h4>
                                </a>
                                <h4><i class="fa fa-phone icon"></i><?php echo $shop["phone"]; ?></h4>
                                <iframe src="https://www.facebook.com/plugins/like.php?href=<?if($shop["facebook"] != ""){echo $shop['facebook'];}{echo $shop['adress'];}?>&amp;width=120&amp;layout=button_count&amp;action=like&amp;size=small&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=118443608242792" width="120" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
                            </div>
                        </div>
                    </div>
                    <div style="margin: 0" class="boxAboutRow row hidden-sm hidden-md hidden-lg">
                        <div class="col-xs-12 boxAboutTitleHolder" style="text-align:center;">
                            <h3 class="datatitle" ><?php echo $shop["name"]; ?> <? if($shop['pinned'] != 0){?><img title="partner" class="pinned-image" src="assets/images/pinned.png"><?} ?></h3>
                        </div>
                        <div class="col-xs-12 boxAboutImgHolderSmall" style="text-align:center;">
                            <img style="margin: 0" class="boxAboutIcon img-responsive" src="<? if($shop["image"] == ""){echo "assets/images/placeholder.png";  }else{echo $shop["image"];}?>">
                        </div>
                        <div class="col-xs-12 boxAboutDataHolderSmall">
                            <div class="dataholder-flex">
                                <div class="dataholder">
                                    <a target="_blank" href="<?php echo $shop["adress"]; ?>">
                                    <h4 style="text-align: center;" class="datatext"><i class="fa fa-wifi icon"></i><?php echo $shop["adress"]; ?></h4>
                                </a>
                                </div>
                                <div class="dataholder">
                                    <h4 style="text-align: center;" class="datatext"><i class="fa fa-phone icon"></i><?php echo $shop["phone"]; ?></h4>
                                </div>
                                <div class="dataholder">
                                <iframe src="https://www.facebook.com/plugins/like.php?href=<?if($shop["facebook"] != ""){echo $shop['facebook'];}{echo $shop['adress'];}?>&amp;width=120&amp;layout=button_count&amp;action=like&amp;size=small&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=118443608242792" width="76" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="textHolder">
                        <p>
                            <?php echo $shop["bio"]; ?>
                        </p>
                    </div>
                    <div class="labelHolder"><?php foreach($shop["labels"] as $label) { ?>
                        <a href="Label?name=<?php echo $label["name"]; ?>"><?php echo $label["name"]; ?></a>
                    <?php } ?>
                    </div>
                    <? if(count($shop['products']) > 0) { ?>
            <div class="boxAboutRow row">
                    <div class="col-xs-12 slider-container">
                        <div class="slider"><?php foreach($shop["products"] as $product) { ?>
                            <div class="slide" data-link="<?echo $product['link'];?>"><div class="slide-inner">
                              <div class="product" style="background-image: url('assets/images/products/<?php print_r($product['imageid']); ?>.png');">
                                <div class="price"><h2><?php print_r($product['price']);?> Ft<h2></div>
                              </div>
                            </div></div>
                            <?php } ?>
                        </div>
                    </div>
                  </div>
                  <? } ?>
                  <div data-width="100%" class="fb-comments" data-href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" data-numposts="5"></div>
                </div>
            </div>
            <div class="col-md-5 col-xs-12">
                <div class="box" style="margin-bottom: 0px;">
                    <div class="boxTitle">
                        <div class="boxTitleTitle">Hasonló webshopok</div>
                    </div>
                    <div class="row rightColumn">
                        <?php foreach ($shop["others"] as $other) { ?>
                            <div class="col-xs-12 shopHolder" data-id="<?php echo $other['id']; ?>">
                                <div class="boxAboutRow row">
                                    <div class="col-xs-6 boxAboutImgHolder">
                                        <img class="boxAboutIcon img-responsive" src="<? if($other["image"] == ""){echo "assets/images/placeholder.png"; }else{echo $other["image"];}?>">
                                    </div>
                                    <div class="col-xs-6 boxAboutDataHolder">
                                        <div class="aboutholder">
                                        <h3 class="datatitle" style="margin-bottom: 30px;"><?php echo $other["name"]; ?> <? if($other['pinned'] != 0){?><img title="partner" class="pinned-image" src="assets/images/pinned.png"><?} ?></h3>
                                        <a href="<?php echo $other['adress']; ?>"><h4 class="datatext"><i class="fa fa-wifi icon"></i><?php echo $other["adress"]; ?></h4></a>
                                        <h4 class="datatext"><i class="fa fa-phone icon"></i><?php echo $other["phone"]; ?></h4>
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
        </div>

    </div>
</body>
