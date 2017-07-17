<?php
ob_start();
$categories = $this->categories; ?>
<body>
    <div class="container">
        <div class="row">
        <div class="col-xs-12">
          <?php
          if (isset($_GET['user_added'])) {
            ?>
            <form class="newerUser form-inline" action="Admin" method="post">
            <? echo "Sikeresen hozzáadtad a felhasználót"; ?>
              <button class="btn btn-default" type="submit">Vissza</button>
            </form>
            <?php
          }
          else {?>
            <form id="newusrform" class="form-inline" action="../Admin_API/addUser" method="post">
              <div class="form-group" style="display:none;">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="" name="new_mail">
              </div>
              <div class="form-group" style="display:none;">
                <label for="pwd">Jelszó:</label>
                <input type="password" class="form-control" id="pwd" placeholder="" name="new_pw">
              </div>
              <div class="form-group" style="display:none;">
                <label for="pwd">Bolt neve:</label>
                <input type="text" class="form-control" id="pwd" placeholder="" name="new_shop_name">
              </div>
                <button id="addnewusr" type="button" class="new-user-btn btn btn-default">Új felhasználó hozzáadása</button>
                <button id="doneusr"  style="display:none;" type="submit" class="new-user-btn btn btn-success">Kész</button>
            </form> <?php
          }?>
          </div>
          <div class="col-xs-12"> <!-- blog -->
            <?php
            if (isset($_GET['blog_added'])) {
              ?>
              <form class="newerUser form-inline" action="Admin" method="post">
              <? echo "Sikeresen hozzáadtad a blogbejegyzést"; ?>
                <button class="btn btn-default" type="submit">Vissza</button>
              </form>
              <?php
            }
            else{ ?>
            <!-- blog section -->
            <button onclick="$('#blogform').show(); $('#addnewpost').hide()" id="addnewpost" type="button" class="new-user-btn blog-btn btn btn-default">Új blogbejegyzés hozzásadása</button>
            <form id="blogform" style="display:none" class="form-horizontal" action="../Admin_API/addBlog" method="post">
              <div class="form-group">
                <label for="blog-title">Bejegyzés címe</label>
                <input type="text" name="blog-title" required>
              </div>
              <div class="form-group">
                <label for="blog-subtitle">Bejegyzés alcíme</label>
                <input type="text" name="blog-subtitle" required>
              </div>
              <div class="form-group">
                <label for="blog-author">Bejegyzés szerzője</label>
                <input type="text" name="blog-author" required>
              </div>
              <div class="form-group">
                <label for="blog-content">Bejegyzés tartalma</label>
                <textarea name="blog-content" rows="10" cols="50"required></textarea>
              </div>
              <button type="submit" class="new-user-btn btn btn-success">Kész</button>

            </form>
            <!-- blog section end -->
              <?php } ?>
          </div>

            <div id="newshop" class="col-xs-12" style="display: none;" data-pinned="0">
                <div class="box">
                    <div class="boxTitle">
                        <div id="newshoptitle" class="boxTitleTitle"></div>
                    </div>
                    <div class="boxContent" style="padding: 20px;">
                        <div class="form-group">
                            <label for="usr">Bolt neve:</label>
                            <input type="text" class="form-control" id="shopname">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Webcím:</label>
                            <input type="text" class="form-control" id="adress">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Telefon:</label>
                            <input type="text" class="form-control" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Facebook oldal url:</label>
                            <input type="text" class="form-control" id="facebook">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Kép url:</label>
                            <input type="text" class="form-control" id="image">
                        </div>
                        <div class="form-group">
                            <label for="comment">Bio:</label>
                            <textarea class="form-control" rows="5" id="bio"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <ul id="labelholder" class="list-group">
                                    <li class="list-group-item active">Címkék</li>
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
                            <div class="col-xs-12" id="uploadcontainer" style="margin-bottom: 20px; display: none;">
                                <label class="control-label">Kép feltöltése</label>
                                <img class="img-responsive" id="preview-img" src="#" alt="" />
                                <input class="file" id="prod-imginput" type="file" accept="image/*">
                                <div class="newLabel">
                                        <input type="text" class="form-control" id="prodprice" placeholder="Termék ára (Ft)">
                                        <button type="button" class="btn btn-success" id="addproduct">Hozzáadás</button>
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
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="newLabel">
                            <button style="display:none;" type="button" class="btn btn-success" id="doneshop">Kész</button>
                            <button style="display:none;" type="button" class="btn btn-success" id="editshop">Kész</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 leftColumn" data-edit="false">
                <div class="box">
                    <div class="boxTitle">
                        <div class="boxTitleTitle">Kategóriák</div>
                        <div class="boxTitleEdit">
                            Szerkesztés
                        </div>
                    </div>
                    <div class="boxContent">
                        <div class="boxRowAdd">
                            <input type="text" class="form-control" id="catname" placeholder="Új kategória neve">
                            <button type="button" class="btn btn-success" id="addcat">Hozzáadás</button>
                        </div>
                        <?php foreach($categories as $catid => $catname) { ?>
                            <div class="boxRow" data-id="<?php echo $catid ?>">
                                <?php echo $catname; ?>
                                <div class="delete-row" style="display: none">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 rightColumn" data-edit="false">
                <div class="box">
                    <div class="boxTitle">
                        <div class="boxTitleTitle">----</div>
                        <div class="boxTitleEdit">
                            Szerkesztés
                        </div>
                    </div>
                    <div class="boxContent">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php ob_end_flush(); ?>
