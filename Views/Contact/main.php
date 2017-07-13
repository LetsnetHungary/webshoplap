
<div class="container">
  <div class="row box" style="margin:0;">
    <div class="col-xs-12 col-sm-6 col-lg-4 left-column">
      <div class="left-div">
        <div class="contact-info">
          <p>info@webshoplap.hu</p>
          <p>06-30-611-8855</p>
        </div>
        <div class="btn-div">

          <div class="btn-group-vertical">
            <button type="button" class="btn">Felhasználási feltételek</button>
            <button type="button" class="btn">Adatvédelmi szabályzat</button>
            <button type="button" class="btn">Médiaajánlat </button>
          </div>
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
  </div>
</div>
