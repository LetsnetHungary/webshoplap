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
                <button id="addnewusr" type="button" class="new-user-btn btn btn-default">Új felhasználó</button>
                <button id="doneusr"  style="display:none;" type="submit" class="new-user-btn btn btn-success">Kész</button>

            </form> <?php
          }?>
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
                            <label for="comment">Bio:</label>
                            <textarea class="form-control" rows="5" id="bio"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <ul id="labelholder" class="list-group">
                                    <li class="list-group-item active">Címkék</li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="newLabel">
                                    <input type="text" class="form-control" id="labelname" placeholder="Új címke neve">
                                    <button type="button" class="btn btn-success" id="addlabel">Hozzáadás</button>
                                </div>
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
                        <?php foreach($categories as $cat) { ?>
                            <div class="boxRow" data-id="<?php echo $cat['id'] ?>">
                                <?php echo $cat["name"]; ?>
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
