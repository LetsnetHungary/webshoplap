<?php
	$db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
	//print_r(CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap")));
	//die();
	print_r(is_null($db));
	$stmt = $db->prepare("SELECT * FROM `categories` WHERE 1");
	$stmt->execute([]);
	$category = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="/assets/css/mainheader.css">
<div id="fb-root"></div>
<link rel="icon" href="/assets/images/favicon.ico">
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.9";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="container">
<section class="row" >
	<div class="col-lg-6 col-md-12" style="display: flex; justify-content: center;">
		<div class="holder">
			<a class="logoImage" href="/Index" style="text-align:left; height:100px; ">

			<img class="logologo" src="/assets/images/logo.png" alt="logo">
		</a>

		</a>
	  </div>
	</div>
	<div class="col-lg-6 col-md-12">
		<form class="keresoForm2" action="../Search" method="get">
            <button type="submit" class="keresoGomb"><i class="glyphicon glyphicon-search"></i></button>
            <input type="text" class="kereso2" placeholder="Keresés" name="search_word" pattern=".{3,}" required title="minimum 3 karakter">
            <div class="cb"></div>
	  </form>
	</div>
</section>

<nav class="navbar menuBar menuBar2" role="navigation">

   <div class="navbar-header menuBar2">
      <button type="button" class="navbar-toggle"
         data-toggle="collapse" data-target="#mainMenu">
         <span class="sr-only">Menu</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>


   </div>

   <div class="collapse navbar-collapse"  id="mainMenu">
      <ul class="nav navbar-nav navNew20170213 menuBar2">
				<li><a href="/Index" class=" menuBar2" role="button" aria-haspopup="true" aria-expanded="false">Főoldal</a></li>
 				<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
               		Kategóriák <span class="caret"></span>
                </a>
                <ul class="dropdown-menu menuBar2" >
									<?php
									for ($i=0; $i < count($category); $i++) { ?>
										<li><a style="color:#FFF;" href="Category?id=<?php print_r($category[$i]['id']); ?>"><?php print_r($category[$i]['name']); ?></a></li>
									<?php }
									?>

                </ul>
        </li>

         <li><a href="/Blog" class=" menuBar2" role="button" aria-haspopup="true" aria-expanded="false">Blog</a></li>
		 <li><a href="/Contact" class="  menuBar2" role="button" aria-haspopup="true" aria-expanded="false">Kapcsolat</a></li>
      </ul>


       <div class=" navbar-right socialIcon">
         		<div class="fb-like" data-href="https://www.facebook.com/webshoplap/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>

       		<a href="https://www.facebook.com/webshoplap/" target="_blank">
            	<i class="fa fa-facebook-official"></i>
            </a>
      		<a href="https://www.instagram.com/webshoplap/"  target="_blank">
            	<i class="fa fa-instagram"></i>
            </a>
       		<a href="https://www.youtube.com/channel/UCPRsu_U29cLsQnLw8XD-ggw"  target="_blank">
            	<i target="_blank" class="fa fa-youtube"></i>
            </a>
       </div>
   </div>

</nav>
</div>
