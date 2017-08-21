<?php ob_start(); $categories=$this->categories; $blogs=$this->blogs;?>

<body>
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js">
    </script>
 
<div class="container">
    <div class="mainmenuholder">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="tile" data-menu="users">
                    <div class="tilerow row">
                        <div class="col-xs-4">
                            <div class="tileimageholder">
                                <img src="/assets/images/icons/user.png" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="tiletextholder">
                                <p class="tiletext">Felhasználók kezelése</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="tile" data-menu="shops">
                    <div class="tilerow row">
                        <div class="col-xs-4">
                            <div class="tileimageholder">
                                <img src="/assets/images/icons/shopping-cart.png" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="tiletextholder">
                                <p class="tiletext">Webshopok kezelése</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="tile" data-menu="blogs">
                    <div class="tilerow row">
                        <div class="col-xs-4">
                            <div class="tileimageholder">
                                <img src="/assets/images/icons/blog.png" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="tiletextholder">
                                <p class="tiletext">Blog kezelése</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="tile" data-menu="partners">
                    <div class="tilerow row">
                        <div class="col-xs-4">
                            <div class="tileimageholder">
                                <img src="/assets/images/icons/partnership.png" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="tiletextholder">
                                <p class="tiletext">Partnerek kezelése</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div id="logout" class="tile">
                    <div class="tilerow row">
                        <div class="col-xs-4">
                            <div class="tileimageholder">
                                <img src="/assets/images/icons/logout.png" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="tiletextholder">
                                <p class="tiletext">Kijelentkezés</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="submenuholder" id="users">
        <div class="row">
            <div class="col-xs-12">
                <button style="margin-bottom: 10px" type="button" class="btn back-btn">Vissza a főoldalra</button>
                <h2 class="submenutitle">Új felhasználó hozzáadása:</h2>
                <div class="row">
                    <form>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="usr_email">Email cím:</label>
                            <input type="email" class="form-control" id="usr_email">
                        </div>
                        <div class="form-group">
                            <label for="usr_password">Jelszó:</label>
                            <input type="password" class="form-control" id="usr_password">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="email">Hozzátartozó bolt:</label>
                            <div class="list-group">
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                        <input class="form-control search-input" type="text" placeholder="Keresés..">
                                    </div>
                                </li>
                                <div class="list-holder" id="usr_shop-list-holder">
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="add-button-holder">
                    <button id="usr_add-button" style="width:300px; margin-bottom: 20px;" type="button" class="btn btn-success">Hozzáadás</button>
                </div>
            </div>
            <div class="col-xs-12">
                <h2 class="submenutitle">Meglévő felhasználók kezelése:</h2>
                <di class="row">
                    <div class="col-xs-12">
                        <div class="list-group">
                            <li class="list-group-item">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                    <input class="form-control search-input" type="text" placeholder="Keresés..">
                                </div>
                            </li>
                            <div class="list-holder" id="usr_list-holder">
                                
                            </div>
                        </div>
                    </div>
                </di>
            </div>
        </div>
    </div>
    <div class="submenuholder" id="blogs">
        <div class="row">
            <div class="col-xs-12">
                <button style="margin-bottom: 10px" type="button" class="btn back-btn">Vissza a főoldalra</button>
                <h2 class="submenutitle">Új bejegyzés hozzáadása:</h2>
                <form data-id="0" id="blogform" class="">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="blog-title">Bejegyzés címe
                                </label>
                                <input id="blogtitle" type="text" class="form-control" name="blog-title" required>
                            </div>
                            <div class="form-group">
                                <label for="blog-subtitle">Bejegyzés alcíme
                                </label>
                                <input id="blogsubtitle" type="text" class="form-control" name="blog-subtitle" required>
                            </div>
                            <div class="form-group">
                                <label for="blog-author">Bejegyzés szerzője
                                </label>
                                <input id="blogauthor" type="text" class="form-control" name="blog-author" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="uploadholder" id="blogimgholder">
                                <img class="img-responsive" id="preview-img-blog" src="#" alt="" />
                                <input class="file" id="blog-imginput" type="file" accept="image/*">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div id="textareaholder" class="form-group">
                                <label for="blog-content">Bejegyzés tartalma
                                </label>
                                <textarea  id="blogcontent" name="blog-content" rows="10" cols="50" required></textarea>
                            </div>
                            
                                <input id="blogid" type="text" style="display:none;" name="id">
                            
                        </div>
                    </div>
                </form>
                
                <div class="add-button-holder">
                    <button id="blog_add-button" style="width:300px; margin-bottom: 20px;" type="button" class="btn btn-success">Kész</button>
                    <button id="blog_delete-button" style="width:300px; margin-bottom: 20px;" type="button" class="btn btn-error">Törlés</button>
                </div>
            </div>
            <div class="col-xs-12">
                <h2 class="submenutitle">Meglévő bejegyzések kezelése:</h2>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="list-group">
                            <li class="list-group-item">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                    <input class="form-control search-input" type="text" placeholder="Keresés..">
                                </div>
                            </li>
                            <div class="list-holder" id="blog_list-holder">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="submenuholder" id="partners">
        <div class="row">
            <div class="col-xs-12">
                <button style="margin-bottom: 10px" type="button" class="btn back-btn">Vissza a főoldalra</button>
                <h2 class="submenutitle">Új partner hozzáadása:</h2>
                <form>
                    <div class="form-group">
                        <label for="parnter_name">Partner neve:</label>
                        <input type="text" class="form-control" id="partner_name">
                    </div>
                    <div class="form-group">
                        <label for="partner_link">Partner linkje:</label>
                        <input type="text" class="form-control" id="partner_link">
                    </div>
                    <div class="form-group">
                        <label for="partner_image">Kép linkje:</label>
                        <input type="text" class="form-control" id="partner_image">
                    </div>
                </form>
                <div class="add-button-holder">
                    <button id="partner_add-button" style="width:300px; margin-bottom: 20px;" type="button" class="btn btn-success">Hozzáadás</button>
                </div>
            </div>
            <div class="col-xs-12">
                <h2 class="submenutitle">Meglévő partnerek kezelése:</h2>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="list-group">
                            <li class="list-group-item">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                    <input class="form-control search-input" type="text" placeholder="Keresés..">
                                </div>
                            </li>
                            <div class="list-holder" id="partner_list-holder">
                                <li class="list-group-item blog-list-holder">
                                    <p>ez a neve a partnernek</p>
                                    <button style="width:30%" type="button" class="btn btn-danger">Törlés</button>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="submenuholder" id="shops">
        <div class="row">
            <div class="col-xs-12">
                <button style="margin-bottom: 10px" type="button" class="btn back-btn">Vissza a főoldalra</button>
                <h2 class="submenutitle">Új webshop hozzáadása:</h2>
                <form>
                    <div class="checkbox">
                        <label><input id="shop_partner" type="checkbox" value="">Partner</label>
                    </div>
                    <div class="form-group">
                        <label for="shop_name">Bolt neve:</label>
                        <input type="text" class="form-control" id="shop_name">
                    </div>
                    <div class="form-group">
                        <label for="shop_link">Webcím:</label>
                        <input type="text" class="form-control" id="shop_link">
                    </div>
                    <div class="form-group">
                        <label for="shop_phone">Telefon:</label>
                        <input type="text" class="form-control" id="shop_phone">
                    </div>
                    <div class="form-group">
                        <label for="shop_facebook">Facebook oldal url:</label>
                        <input type="text" class="form-control" id="shop_facebook">
                    </div>
                    <div class="form-group">
                        <label for="shop_image">Kép url:</label>
                        <input type="text" class="form-control" id="shop_image">
                    </div>
                    <div class="form-group">
                        <label for="shop_bio">Bio:</label>
                        <textarea class="form-control" rows="5" id="shop_bio"></textarea>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <ul id="label_holder" class="list-group">
                            <li class="list-group-item active">Címkék</li>
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
                        <ul id="cat_holder" class="list-group">
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
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="add-button-holder">
                    <button id="shop_add-button" style="width:300px; margin-bottom: 20px;" type="button" class="btn btn-success">Hozzáadás</button>
                </div>
            </div>
            <div class="col-xs-12">
                <h2 class="submenutitle">Meglévő webshopok kezelése:</h2>
                <di class="row">
                    <div class="col-xs-12">
                        <div class="list-group">
                            <li class="list-group-item">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                    <input class="form-control search-input" type="text" placeholder="Keresés..">
                                </div>
                            </li>
                            <div class="list-holder" id="shop_list-holder">
                                
                            </div>
                        </div>
                    </div>
                </di>
            </div>
            </div>

        </div>
    </div>
</div>
 
</body>
<?php ob_end_flush(); ?>