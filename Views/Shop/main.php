
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
                    <div class="boxAboutRow row ">
                        <div class="col-xs-6 boxAboutImgHolder">
                            <img class="boxAboutIconTop img-responsive" src="http://via.placeholder.com/160x160">
                        </div>
                        <div class="col-xs-6 boxAboutDataHolder">
                            <div class="">
                                <h3 style="margin-bottom: 30px;"><?php echo $shop["name"]; ?></h3>
                                <a target="_blank" href="<?php echo $shop["adress"]; ?>">
                                    <h4><i class="fa fa-wifi icon"></i><?php echo $shop["adress"]; ?></h4>
                                </a>
                                <h4><i class="fa fa-phone icon"></i><?php echo $shop["phone"]; ?></h4>
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

            <div class="boxAboutRow row">
                    <div class="col-xs-12 slider-container">
                        <div class="slider"><?php foreach($shop["products"] as $product) { ?>
                            <div class="slide"><div class="slide-inner"><div class="product" 
                            style="background-image: url('assets/images/products/<?php print_r($product['imageid']); ?>.jpg');">
                            <div class="price"><h2><?php print_r($product['price']);?> Ft<h2></div></div>
                            </div></div>
                            <?php } ?> 
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-5 col-xs-12">
                <div class="box" style="margin-bottom: 0px;">
                    <div class="boxTitle">
                        <div class="boxTitleTitle">Hasonló linkek</div>
                    </div>
                    <div class="row rightColumn">
                        <?php foreach ($shop["others"] as $other) { ?>
                            <div class="col-xs-12 shopHolder <? if($other['pinned'] != 0){echo "pinned";} ?>" data-id="<?php echo $other['id']; ?>">
                                <div class="boxAboutRow row">
                                    <div class="col-xs-6 boxAboutImgHolder">
                                        <img class="boxAboutIcon img-responsive" src="http://via.placeholder.com/160x160">
                                    </div>
                                    <div class="col-xs-6 boxAboutDataHolder">
                                        <div class="">
                                        <h3 style="margin-bottom: 30px;"><?php echo $other["name"]; ?></h3>
                                        <a href="http://<?php echo $other['adress']; ?>"><h4><i class="fa fa-wifi icon"></i><?php echo $other["adress"]; ?></h4></a>
                                        <h4><i class="fa fa-phone icon"></i><?php echo $other["phone"]; ?></h4>
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
