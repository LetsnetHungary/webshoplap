<?php ob_start(); $categories=$this->categories; $shop=$this->shop;?>

<body>
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js">
    </script>
 
<div class="container">
    <div class="submenuholder" id="shops" data-edit="<?echo $shop['id'];?>">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="submenutitle">Webshop szerkesztése hozzáadása:</h2>
                <form>
                    <div class="form-group">
                        <label for="shop_name">Bolt neve:</label>
                        <input type="text" class="form-control" id="shop_name" value="<?echo $shop['name'];?>">
                    </div>
                    <div class="form-group">
                        <label for="shop_link">Webcím:</label>
                        <input type="text" class="form-control" id="shop_link" value="<?echo $shop['adress'];?>">
                    </div>
                    <div class="form-group">
                        <label for="shop_phone">Telefon:</label>
                        <input type="text" class="form-control" id="shop_phone" value="<?echo $shop['phone'];?>">
                    </div>
                    <div class="form-group">
                        <label for="shop_facebook">Facebook oldal url:</label>
                        <input type="text" class="form-control" id="shop_facebook" value="<?echo $shop['facebook'];?>">
                    </div>
                    <div class="form-group">
                        <label for="shop_image">Kép url:</label>
                        <input type="text" class="form-control" id="shop_image" value="<?echo $shop['image'];?>">
                    </div>
                    <div class="form-group">
                        <label for="shop_bio">Bio:</label>
                        <textarea class="form-control" rows="5" id="shop_bio"><?echo $shop['bio'];?></textarea>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <ul id="label_holder" class="list-group">
                            <li class="list-group-item active">Címkék</li>
                            <?foreach ($shop['labels'] as $lab) {
                            ?>
                            <li class="list-group-item">
                                <?echo $lab['name'];?>
                                <div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>
                            </li>
                            <?}?>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6" style="margin-bottom: 20px;">
                        <div class="newlabel form-inline">
                            <input type="text" class="form-control" id="label_name" placeholder="Új címke neve">
                            <button type="button" class="btn btn-success" id="label_add">Hozzáadás</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <ul id="cat_holder" class="list-group" data-categories="<?echo $shop['category'];?>">
                            <li class="list-group-item active">Kategóriák</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6" style="margin-bottom: 20px;">
                        <div class="newCategory form-inline">
                            <select id="cat_select" class="form-control">
                            </select>
                            <button type="button" class="btn btn-success form-control" id="cat_add">Hozzáadás</button>
                        </div>
                    </div>
                    <div class="col-xs-12" id="prod_upload-holder" style="display: none;">
                        <div class="row">
                            <div class="col-xs-12" style="text-align:center">
                                <label class="control-label">Kép feltöltése</label>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="uploadholder">
                                    <img class="img-responsive" id="prod_preview-img" src="#" alt="" />
                                    <input class="file" id="prod_imginput" type="file" accept="image/*">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="uploadholder">
                                    <input type="text" class="form-control" id="prod_name" placeholder="Termék neve">
                                    <input type="text" class="form-control" id="prod_link" placeholder="Termék linkje">
                                    <input type="text" class="form-control" id="prod_price" placeholder="Termék ára (Ft)">
                                    <button type="button" class="btn btn-success" id="prod_add">Hozzáadás</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <ul id="prod_wrapper" class="list-group">
                            <li class="list-group-item active">
                                <div class="add-row">
                                    <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
                                </div>
                                Termékek
                            </li>
                            <li class="list-group-item">
                                <ul class="row noselect" id="prod_holder">
                                    <?foreach($shop['products'] as $prod) {?>
                                        <li data-old="true" data-id="<?echo $prod['id'];?>" class="col-xs-6 col-sm-4 col-md-3">
                                            <div class="delete-product">
                                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                            </div>
                                            <div class="slide-inner">
                                                <div class="product"> <img class='image-responsive' src="assets/images/products/<?echo $prod['imageid'];?>.png">
                                                    <div class="price">
                                                        <h2><?echo $prod['price'];?>Ft</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?}?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="add-button-holder">
                    <button id="shop_add-button" style="width:300px; margin-bottom: 20px;" type="button" class="btn btn-success">Hozzáadás</button>
                </div>
            </div>
            
            </div>
        </div>
    </div>
</div>
 
</body>
<?php ob_end_flush(); ?>