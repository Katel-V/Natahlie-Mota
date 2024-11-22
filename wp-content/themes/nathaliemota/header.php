<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="photographe événementiel, photographe event, nathalie mota, photo numérique, photo argentique, photo format hd"/>
	<meta name="description" content="Nathalie Mota - Site personnel pour la vente de mes photos en impression HD.">

	<title>Nathalie Mota - Photographe Freelance</title>

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/theme.css">  <!-- Relie le fichier css -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,500;1,400;1,500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;,">
	<!--<link rel="profile" href="https://gmpg.org/xfn/11">-->

    <?php wp_head(); ?>  <!-- Ajoute scripts et styles de WordPress à l'en-tête --> 

</head>

<body>
    <header>  <!-- Section d'en-tête --> 
        <div class="header-logo">  <!-- div du logo -->
            <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            ?>
            <a href="<?php echo home_url(); ?>">
                <img src="http://nathalie-mota.local/wp-content/uploads/2024/11/Logo.webp" alt="Logo">
            </a>
        </div>

        <!--Menu mobile -->
        <div class="mobile-menu-button" id="open-fullscreen-menu-button">  
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <!-- Menu de navigation -->
        <nav class="header-menu">  
            <?php
            // Affiche | Menu de navigation en utilisant un emplacement de thème nommé 'main-menu'
            wp_nav_menu([
                'theme_location' => 'main-menu',
                'container'      => false
            ]);
            ?>
             <?php include get_template_directory() . '/template-parts/modal.php'; ?>  <!-- Inclut un fichier externe de modal de contact -->
        </nav>
    </header>
</body>
</html>