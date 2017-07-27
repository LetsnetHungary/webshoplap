<?php
ob_start();
$shop = $this->shop;
$categories = $this->categories; ?>

<body>
    <div class="container">
        <div class="row">
            <div id="newshop" class="col-xs-12" data-id="<? echo $shop['id']; ?>" data-pinned="<? echo $shop['pinned']; ?>">
                <div class="box">
                    <div class="boxTitle">
                        <div id="newshoptitle" class="boxTitleTitle">Bolt szerkesztése</div>
                    </div>
                    <div class="boxContent" style="padding: 20px;">
                        <div class="form-group">
                            <label for="usr">Bolt neve:</label>
                            <input type="text" class="form-control" id="shopname" value="<? print_r($shop['name']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Webcím:</label>
                            <input type="text" class="form-control" id="adress" value="<? print_r($shop['adress']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Telefon:</label>
                            <input type="text" class="form-control" id="phone" value="<? print_r($shop['phone']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Facebook oldal url:</label>
                            <input type="text" class="form-control" id="facebook" value="<? print_r($shop['facebook']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Kép url:</label>
                            <input type="text" class="form-control" id="image" value="<? print_r($shop['image']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="comment">Bio:</label>
                            <textarea class="form-control" rows="5" id="bio"><? print_r($shop['bio']); ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <ul id="labelholder" class="list-group">
                                    <li class="list-group-item active">Címkék</li>
                                    <? foreach($shop['labels'] as $label) { ?>
                                        <li class="list-group-item"><div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div><? echo $label["name"]; ?></li>
                                    <? } ?>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-6" style="margin-bottom: 20px;">
                                <div class="newLabel">
                                    <input type="text" class="form-control" id="labelname" placeholder="Új címke neve">
                                    <button type="button" class="btn btn-success" id="addlabel">Hozzáadás</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <ul id="categoryholder" class="list-group">
                                    <li class="list-group-item active">Kategóriák</li>
                                    <? foreach(explode('; ',$shop['category']) as $cat) { ?>
                                        <li data-id="<? echo $cat; ?>" class="list-group-item"><div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div><? print_r($categories[$cat]); ?></li>
                                    <? } ?>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-6" style="margin-bottom: 20px;">
                                <div class="newCategory form-inline">
                                    <select id="catselect" class="form-control">
                                            <? foreach($categories as $id => $name) { ?>
                                                <option value="<? echo $id; ?>"><? echo $name; ?></option>
                                            <? } ?>
                                    </select>
                                    <button type="button" class="btn btn-success form-control" id="addCat">Hozzáadás</button>
                                </div>
                            </div>
                            
                            <div class="col-xs-12" id="uploadcontainer" style="display: none;">
                                <div class="row">
                                    <div class="col-xs-12" style="text-align:center">
                                        <label class="control-label">Kép feltöltése</label>
                                        <p>(Csak átlátszó hátterű kép)</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="uploadholder">
                                            <img class="img-responsive" id="preview-img" src="#" alt="" />
                                            <input class="file" id="prod-imginput" type="file" accept="image/*">
                                        </div>
                                     </div>
                                     <div class="col-xs-12 col-sm-6">   
                                        <div class="uploadholder">
                                                <input type="text" class="form-control" id="prodname" placeholder="Termék neve">
                                                <input type="text" class="form-control" id="prodlink" placeholder="Termék linkje">  
                                                <input type="text" class="form-control" id="prodprice" placeholder="Termék ára (Ft)">
                                                <button type="button" class="btn btn-success" id="addproduct">Hozzáadás</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <ul id="prodholder" class="list-group">
                                    <li class="list-group-item active">
                                        <div class="add-row">
                                            <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
                                        </div>
                                    Termékek</li>
                                    <li class="list-group-item">
                                        <ul class="row noselect" id="productsHolder">
                                            <? foreach($shop['products'] as $product) { ?>
                                            <li data-old="true" data-id="<? echo $product['id']; ?>" class="col-xs-6 col-sm-4 col-md-3"><div class="delete-product">
                                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                            </div><div class="slide-inner"><div class="product"> <img class='image-responsive' src = "assets/images/products/<? echo $product['imageid']; ?>.jpg">
                                            <div class="price"><h2><? echo $product['price']; ?> Ft<h2></div></div>
                                            </div></li>
                                            <?}?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="newLabel">
                            <button type="button" class="btn btn-success" id="editshop2">Kész</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php ob_end_flush(); ?>
