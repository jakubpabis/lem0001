<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108874065-2"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-108874065-2');
	</script>
	<link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri(); ?>/assets/img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri(); ?>/assets/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri(); ?>/assets/img/favicon-16x16.png">
	<link rel="manifest" href="<?= get_template_directory_uri(); ?>/assets/img/site.webmanifest">
	<link rel="mask-icon" href="<?= get_template_directory_uri(); ?>/assets/img/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/assets/img/favicon.ico">
	<meta name="msapplication-TileColor" content="#000000">
	<meta name="msapplication-config" content="<?= get_template_directory_uri(); ?>/assets/img/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
	<link href="https://fonts.googleapis.com/css?family=Barlow:400,500,600,700|Roboto:400,400i,500,500i,700&subset=latin-ext" rel="stylesheet" media="none" onload="if(media!='all')media='all'"> 
	<noscript>
		<link href="https://fonts.googleapis.com/css?family=Barlow:400,500,600,700|Roboto:400,400i,500,500i,700&subset=latin-ext" rel="stylesheet"> 
	</noscript>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous" media="none" onload="if(media!='all')media='all'">
	<noscript>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	</noscript>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" media="none" onload="if(media!='all')media='all'">
	<noscript>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</noscript>
	<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets/css/main.min.css?v=2.39">
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<?php get_template_part( 'partials/navigation', 'none' ); ?>
		<?php wc_print_notices(); ?>