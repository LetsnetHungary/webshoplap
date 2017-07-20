<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/assets/css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta property="og:url"           content="http://www.your-domain.com/your-page.html" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="Your Website Title" />
		<meta property="og:description"   content="Your description" />
		<meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />
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

foreach($this->SEO->seo->og as $og => $data)
{
?>
		<meta property="og:<?php echo $og; ?>" content = "<?php echo $data; ?>"/>
<?php
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

<script type="text/javascript" src = "/assets/js/main.js"></script>
	</head>
	<body>

	<? }else {
?>
		<title>Letsnet</title>
	</head>
	<body>
<?	} ?>
