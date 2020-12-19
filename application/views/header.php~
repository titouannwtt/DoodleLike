<!DOCTYPE html>
<html class="not-ie no-js" lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Projet WIM 2018">
	<meta name="author" content="DJADI Rabah & WATTELET Titouan">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
	<?=link_tag('custom/font-awesome.css');?>
	<?=link_tag('custom/custom-bootstrap.css');?>
	<?=link_tag('css/all.css');?>
	<link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>
<div class="couche-principale">
		<div class="bande-de-la-barre-de-navigation">
			<header class="barre-de-navigation barre-de-navigation-de-base barre-de-navigation-top" id="barre-de-navigation">
				<div class="contenu">
					<div class="entete-de-navigation">
						<?php
							$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
							if($login === NULL) { ?>
								<a class="nom-dans-la-barre-de-navigation">Doodle: Sondage en ligne</a>
							<?php } else {  ?>
								<a class="nom-dans-la-barre-de-navigation">Connecté: <?php echo $login; ?></a>
							<?php } ?>
					</div>
				<div class="barre-de-navigation-flexnav">
						<div class="clearfix">
							<button type="button" class="barre-de-navigation-activation">
								<span class="sr-only">Activer la navigation</span>
								<span class="icone-barre-de-navigation"></span>
							</button>		
							<ul data-breakpoint="992" class="flexnav">
								<li><a href="<?php echo base_url(); ?>" <?php if ($url == base_url()) { echo " ><strong>Accueil</strong>";} else { echo " >Accueil"; } ?></a></li>
								<?php if($login === NULL) { ?>
									<li><a href="<?php echo site_url('UserSession/connexion'); ?>" <?php if (strpos($url,"UserSession/connexion")) { echo " ><strong>Connexion</strong>";} else { echo " >Connexion"; } ?></a></li>
									<li><a href="<?php echo site_url('UserSession/inscription'); ?>" <?php if (strpos($url,"UserSession/inscription")) { echo " ><strong>S'inscrire</strong>";} else { echo " >S'inscrire"; } ?></a></li>
								<?php }
								else { ?>
						         	<li><a href="<?php echo site_url("DashBoard/displayDashBoard/".$login); ?>" <?php if (strpos($url,"DashBoard/displayDashBoard")) { echo " ><strong>Tableau de bord</strong>";} else { echo " >Tableau de bord"; } ?></a></li>
									<li><a href="<?php echo site_url('UserSession/logout'); ?>">Deconnexion</a></li>
								<?php } ?> 
							</ul>
						</div>
					</div>
				</div>
			</header>
		</div>
		<div class="entete-de-page">
		</div>
	</div>
	<main class="main-content">
