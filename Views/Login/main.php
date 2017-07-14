<main>
    <div class="container">
        <div class="row login">
            <div class="col-sm-6 col-md-4 col-md-offset-4 text-center">
                <?php
                  ob_start();
                  if (isset($_GET['message']) && $_GET['message'] == "server_timeout") {
                  echo "Server timeout!";
                }
                ob_end_flush(); ?>
                <div class="account-wall box">
                <h1 class="text-center login-title">Belépés</h1>
                    <div class="form-signin" id = "loginform">
                      <form class="signing-form" action="Login_API" method="post">

                    <input type="text" class="form-control" name="email" id="emailForm" style = "margin-bottom:10px!important;" placeholder="E-mail cím" required autofocus>
                    <input type="password" name="password" class="form-control" id="passwordForm" placeholder="Jelszó" required>
                    <button class="btn btn-lg btn-primary btn-block" id="loginButton" type="submit" id="loginbutton">
                        RAJT!</button>
                      </form>
                    <a href="#" class="pull-right need-help"> </a><span class="clearfix"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>

</script>
