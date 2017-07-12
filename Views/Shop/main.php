
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
                                <a href="http://<?php echo $shop["adress"]; ?>">
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
                        <a><?php echo $label["name"]; ?></a>
                    <?php } ?>
                    </div>
                    
            <div class="boxAboutRow row">
                    <div class="col-xs-12 slider-container">
                        <div class="slider">
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-5 col-xs-12">
                <div class="box" style="margin-bottom: 0px;">
                    <div class="boxTitle">
                        <div class="boxTitleTitle">Kategória további linkjei</div>
                    </div>
                    <div class="row rightColumn">
                        <?php foreach ($shop["others"] as $other) { ?>
                            <div class="col-xs-12 shopHolder" data-id="<?php echo $other['id']; ?>">
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
