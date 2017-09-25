<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/assets/css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--
		 -->
	<? if($this->SEO) {?>
		<meta charset = "<?php echo $this->SEO->seo->charset; ?>">
		<title><?php echo $this->SEO->seo->title; ?></title>

<?php
if($this->SEO->seo->meta != null)
{
foreach($this->SEO->seo->meta as $meta => $data)
{
?>
		<meta name="<?php echo $meta; ?>" content = "<?php echo $data; ?>">
<?php
}
if($this->vName == "Category") {
	$db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
	$stmt = $db->prepare("SELECT description FROM categories WHERE fuckid = :fuckid"); 
	$stmt->execute([":fuckid" => explode("/", $_GET["url"])[0]] );
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if($result) { ?>
		<meta name="description" content = "<? echo $result[0]['description']; ?>">
	<?}
}

}

if($this->SEO->seo->og) {
	if(isset($this->SEO->seo->og->dynamic) && $this->SEO->seo->og->dynamic == "blog") {
		if(isset($_GET["post_id"])) {
			$db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
			$stmt = $db->prepare("SELECT * FROM blog WHERE blog_id = :blog_id");
			$stmt->execute([
				":blog_id" => $_GET["post_id"]
			]);
			$ogtags = $stmt->fetchAll(PDO::FETCH_ASSOC);

			?>

			<meta property="og:url" content="http://www.webshoplap.hu<? echo $_SERVER['REQUEST_URI']; ?>" />
			<meta property="og:type" content="article" />
			<meta property="og:title" content="<? echo $ogtags[0]['blog_title']; ?>" />
			<meta property="og:description" content="<? $nszuveg = strip_tags($ogtags[0]['blog_content'], "<*>"); echo $nszuveg; ?>" />
			<meta property="og:image" content="http://www.webshoplap.hu/assets/images/blogs/<? echo $ogtags[0]['blog_id']; ?>.png" />
			<meta property="og:image:type" content="image/png" />
			<meta property="og:image:width" content="400" />
			<meta property="og:image:height" content="300" />

			<?
		}
	}
	else if(isset($this->SEO->seo->og->dynamic) && $this->SEO->seo->og->dynamic == "category") { ?>

			<meta property="og:url" content="http://www.webshoplap.hu<? echo $_SERVER['REQUEST_URI']; ?>" />
			<meta property="og:type" content="article" />
			<meta property="og:title" content="<?php echo $this->SEO->seo->title; ?>" />
			<meta property="og:description" content="<? echo $result[0]['description']; ?>" />
			<meta id="og_image" property="og:image" content="http://webshoplap.hu/assets/images/facebook_logo.png"/>
	<?
	}
	else {
		?>
		<meta id="og_url" property="og:url" content="http://www.webshoplap.hu<? echo $_SERVER['REQUEST_URI']; ?>" />
		<meta id="og_type" property="og:type" content="website" />
		<meta id="og_title" property="og:title" content="<?php echo $this->SEO->seo->title; ?>" />
		<meta id="og_description" property="og:description" content="Magyarország összes webshopja. Valós vásárlók által írt vélemények és értékelések, hogy garantaláltan a számodra legmegfelelőbb oldalt válaszd." />
		<meta id="og_image" property="og:image" content="http://webshoplap.hu/assets/images/facebook_logo.png" />
		<?
	}
}
?>

<?php
if($this->SEO->css != null)
{
foreach($this->SEO->css as $cssdata)
{
?>
		<link type="text/css" rel="stylesheet" href = "<?php echo $cssdata ?>">
<?php
}
}
?>

<?php
if($this->SEO->fonts != null)
{
foreach($this->SEO->fonts as $fontdata)
{
?>
		<link rel="stylesheet" href = "<?php echo $fontdata ?>">
<?php
}
}
?>

<?php
if($this->SEO->js != null)
{
foreach($this->SEO->js as $jsdata)
{
?>
      <script type="text/javascript" src = "<?php echo $jsdata ?>"></script>
<?php
}
}
?>

<script type="text/javascript" src="/assets/js/main.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75887562-1', 'auto');
  ga('send', 'pageview');

</script>

	</head>
	<body>

	<? }else {
?>
		<title>Webshoplap</title>
	</head>
	<body>
<?	} ?>
