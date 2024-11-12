<?php

// Enregistrement - Menu Principal
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );

// Enregistrement - Menu pied de page
function register_footer_menu() {
    register_nav_menu( 'footer-menu', __( 'Menu du pied de page', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_footer_menu' );

// Ajout - Styles 
function enqueue_custom_styles() {
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/css/theme.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-single_photo-css', get_template_directory_uri() . '/css/single_photo.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-index-css', get_template_directory_uri() . '/css/index.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-photoblock-css', get_template_directory_uri() . '/css/photo_block.css', array(), '1.0', 'all');
    wp_enqueue_style('lightbox-single_photo', get_template_directory_uri() . '/css/lightbox-single_photo.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Ajout - Scripts 
function enqueue_custom_scripts() {
    //wp_enqueue_script('header-scripts', get_template_directory_uri() . '/js/header-scripts.js', array('jquery'), '1.1.1', true);
    wp_enqueue_script('modal-scripts', get_template_directory_uri() . '/js/modal-scripts.js', array('jquery'), '1.0', true);
    wp_enqueue_script('modal_photo-scripts', get_template_directory_uri() . '/js/modal_photo-scripts.js', array('jquery'), '1.0', true);
    wp_enqueue_script('lightbox-single_photo', get_template_directory_uri() . '/js/lightbox-single_photo.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Ajout du fichier JavaScript (Pagination infinie - Bloc Photo)
function enqueue_infinite_pagination_js() {
    wp_enqueue_script('infinite-pagination', get_template_directory_uri() . '/js/infinite-pagination.js', array('jquery'), '', true);
    wp_localize_script('infinite-pagination', 'wp_data', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_infinite_pagination_js');

// Créer une fonction pour charger des articles - Photo

function load_more_posts() {
    $page = $_GET['page']; // Récupère le numéro de page à charger à partir de la requête GET

    $args_custom_posts = array(
        'post_type' => 'photo', // Type de publication personnalisée à charger
        'posts_per_page' => 12, // Nombre de publications à afficher par page
    );

    // Vérification des paramètres de catégorie et de format dans la requête GET
    if( 
        $_GET['category'] != NULL && 
        $_GET['category'] != 'ALL' &&
        $_GET['format'] != NULL &&
        $_GET['format'] != 'ALL'
    ){
        // Si à la fois la catégorie et le format sont spécifiés, nous créons une requête complexe (opérateur logique "ET")
        $args_custom_posts['tax_query'] = array(
            'relation' => 'AND', // Opérateur logique "ET" pour s'assurer que les deux requêtes sont satisfaites
            array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $_GET['category']
            ),
            array(
                'taxonomy' => 'format',
                'field'    => 'slug',
                'terms'    => $_GET['format']
            )
        );
    }else{
        // Si seule la catégorie est spécifiée
        if( 
            $_GET['category'] != NULL && 
            $_GET['category'] != 'ALL'
        ){
            // Crée une requête pour filtrer par catégorie
            $args_custom_posts['tax_query'] = array(
                array(
                    'taxonomy' => 'categorie',
                    'field'    => 'slug',
                    'terms'    => $_GET['category']
                )
            );
        }
        // Si seul le format est spécifié
        if(
            $_GET['format'] != NULL &&
            $_GET['format'] != 'ALL' 
        ){
            // Crée une requête pour filtrer par format
            $args_custom_posts['tax_query'] = array(
                array(
                    'taxonomy' => 'format',
                    'field'    => 'slug',
                    'terms'    => $_GET['format']
                )
            );
        }
    }
    $args_custom_posts['orderby'] = 'date'; // Trie les publications par date
    $args_custom_posts['order'] = $_GET['dateSort'] != 'ALL' ? $_GET['dateSort'] : 'DESC'; // Ordonne par ordre descendant si le tri par date est spécifié
    $args_custom_posts['paged'] = $page; // Gère la pagination en fonction du numéro de page

    $custom_posts_query = new WP_Query($args_custom_posts); // Effectue une requête WordPress pour obtenir les publications personnalisées

    if ($custom_posts_query->have_posts()) {
        while ($custom_posts_query->have_posts()) :
            $custom_posts_query->the_post();
             // Contenu | Article - Même format que dans "photo_block.php"
            ?>
            <div class="custom-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumbnail-wrapper">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                                <!-- Section | Overlay Catalogue -->
                                <div class="thumbnail-overlay">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_eye.webp" alt="Icône de l'œil"> <!-- Icône de l'œil | Information Photo -->
                                    <i class="fas fa-expand-arrows-alt fullscreen-icon"></i><!-- Icône de plein écran -->
                                    <?php
                                    // Récupère la référence et la catégorie de l'image associée
                                    $related_reference_photo = get_field('reference_photo');
                                    $related_categories = get_the_terms(get_the_ID(), 'categorie');
                                    $related_category_names = array();

                                    if ($related_categories) {
                                        foreach ($related_categories as $category) {
                                            $related_category_names[] = esc_html($category->name);
                                        }
                                    }
                                    ?>
                                    <div class="photo-info">
                                        <div class="photo-info-left">
                                            <p><?php echo esc_html($related_reference_photo); ?></p>
                                        </div>
                                        <div class="photo-info-right">
                                            <p><?php echo implode(', ', $related_category_names); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </a>
            </div>
        <?php
            // Fin de la structure du contenu de l'article
        endwhile;
        wp_reset_postdata(); // Réinitialise les données des publications personnalisées
    } else {
        // Aucun autre article à charger
    }
    die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts'); // Associe la fonction 'load_more_posts' à l'action AJAX 'wp_ajax_load_more_posts'
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts'); // Associe la fonction 'load_more_posts' à l'action AJAX 'wp_ajax_nopriv_load_more_posts'



?>

