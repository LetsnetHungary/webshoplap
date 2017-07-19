
<div class="container">
  <div class="row box" style="margin:0;">
    <div class="col-xs-12 col-sm-6 col-lg-4 left-column">
      <div class="left-div">
        <div class="contact-info">
          <a href="mailto:info@webshoplap.hu"><p>info@webshoplap.hu</p></a>
          <a href="tel:06-30-611-8855"><p>06-30-611-8855</p></a>
        </div>
        <div class="btn-div">

          <div class="btn-group-vertical">

            <button onclick="window.location='/assets/documents/felhasznalasi_feltetelek.pdf'" type="button" class="btn">Felhasználási feltételek</button>
            <button onclick="window.location='/assets/documents/adatvedelmi_szabalyzat.pdf'" type="button" class="btn">Adatvédelmi szabályzat</button>
            <button onclick="window.location='/assets/documents/mediaajanlat.pdf'" type="button" class="btn">Médiaajánlat </button>
          </div>
        </div>
      <div class="impresszumholder hidden-xs" style="font-size: 11px; margin-top: 20px;">
        Üzemeltető neve:  Long Grafikai Szolgáltató kft.<br>
        Üzemeltető képviselője: Vági Nóra <br>
        Cím: 1202 Budapest Vécsey utca 65 <br>
        Tel: +36/30 611-8855 <br>
        E-mail: farkas.zsolt@longkft.hu <br>
        Adószám: 10806034-3-43 <br>
        Kamarai tagság: BKIK <br>
        Tárhely szolgáltató neve, elérhetősége:
        Shirokuma kft. -1092 Budapest Baross utca 4/1
      </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-8">
      <div class="error">
        <p class="error-p">
        <?php
        if (isset($_GET['mail_error'])) {
          echo "Hibás email cím!";
        }
        elseif (isset($_GET['char_error'])) {
          echo "Nem megfelelő karakter!";
        } ?>
        </p>
      </div>
        <form class="message-sender" action="Contact_API/sendMail" method="post">
          <div class="input-group">
            <span class="input-group-addon">név</span>
            <input id="msg" type="text" class="form-control" name="sender">
          </div>
          <div class="input-group">
            <span class="input-group-addon">e-mail cím</span>
            <input id="msg" type="email" class="form-control" name="mail">
          </div>
          <div class="input-group">
            <span class="input-group-addon">tárgy</span>
            <input id="msg" type="text" class="form-control" name="subject">
          </div>
          <div class="form-group">
            <label for="comment"></label>
            <textarea class="form-control" rows="7" id="comment" name="text"></textarea>
          </div>
          <div class="send-button">
            <button type="submit" class="btn btn-primary">Küldés</button>
          </div>
        </form>
        </div>
        
  <div class="col-xs-12 hidden-lg hidden-sm hidden-md">
    <div class="impresszumholder" style="font-size: 11px; margin-top: 20px;">
        Üzemeltető neve:  Long Grafikai Szolgáltató kft.<br>
        Üzemeltető képviselője: Vági Nóra <br>
        Cím: 1202 Budapest Vécsey utca 65 <br>
        Tel: +36/30 611-8855 <br>
        E-mail: farkas.zsolt@longkft.hu <br>
        Adószám: 10806034-3-43 <br>
        Kamarai tagság: BKIK <br>
        Tárhely szolgáltató neve, elérhetősége:
        Shirokuma kft. -1092 Budapest Baross utca 4/1
      </div>
  </div>
  </div>
</div>
