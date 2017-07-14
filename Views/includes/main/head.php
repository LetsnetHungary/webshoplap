<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/assets/css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<? if($this->SEO) {?>
		<meta charset = "<?php echo $this->SEO->seo->charset; ?>">
		<title><?php echo $this->SEO->seo->title; ?></title>
		<meta property="og:url"                content="<?php echo "www.index.hu"?>" />
		<meta property="og:type"               content="article" />
		<meta property="og:title"              content="<?php echo $blog_post[$i]['blog_title'] ?>" />
		<meta property="og:description"        content="How much does culture influence creative thinking?" />
		<meta property="og:image"              content="../favicon.ico" />

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
	</head>
	<body>

	<? }else {
?>
		<title>Letsnet</title>
	</head>
	<body>
<?	} ?>
