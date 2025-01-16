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

// Ajout - Styles (Thème - Page Photo Unique - Accueil - Bloc Photo - Lightbox)
function enqueue_custom_styles() {
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/css/theme.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-single-photo-css', get_template_directory_uri() . '/css/single-photo.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-index-css', get_template_directory_uri() . '/css/index.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-photoblock-css', get_template_directory_uri() . '/css/photo-block.css', array(), '1.0', 'all');
    wp_enqueue_style('lightbox-single-photo', get_template_directory_uri() . '/css/lightbox-single-photo.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Ajout - Scripts 
function enqueue_custom_scripts() {
    wp_enqueue_script('header-scripts', get_template_directory_uri() . '/js/header-scripts.js', array('jquery'), '1.1.1', true);
    wp_enqueue_script('modal-scripts-index', get_template_directory_uri() . '/js/modal-scripts-index.js', array('jquery'), '1.0', true);
    wp_enqueue_script('modal-scripts-photo', get_template_directory_uri() . '/js/modal-scripts-photo.js', array('jquery'), '1.0', true);
    wp_enqueue_script('lightbox-single-photo', get_template_directory_uri() . '/js/lightbox-single-photo.js', array('jquery'), '1.0', true);
    wp_enqueue_script('custom-select-script', get_template_directory_uri() . '/js/custom-select.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Ajout de Select2 pour modifier la couleur des filtres selectionnés
function enqueue_select2_jquery() {
    wp_enqueue_style('select2-css', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', false, null);
    wp_enqueue_script('select2-js', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_select2_jquery');


// Ajouter - FontAwesome
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'); // You can change the version URL as needed.
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

// Ajout du fichier infinite-pagination.js 
function enqueue_infinite_pagination_js() {
    wp_enqueue_script('infinite-pagination', get_template_directory_uri() . '/js/infinite-pagination.js', array('jquery'), '', true);
    wp_localize_script('infinite-pagination', 'wp_data', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_infinite_pagination_js');

// Ajout du fichier filtre.js
function enqueue_filtre_js() {
    wp_enqueue_script('filtre', get_template_directory_uri() . '/js/filtre.js', array('jquery'), '', true);
    wp_localize_script('filtre', 'wp_data', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_script', 'enqueue_filtre_js');

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
             // Contenu Article - Même format que dans "photo-block.php"
            ?>
            <div class="custom-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumbnail-wrapper">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                                <!-- Section | Overlay Catalogue -->
                                <div class="thumbnail-overlay">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_eye.png" alt="Icône de l'œil"> <!-- Icône de l'œil | Information Photo -->
                                    <i class="fas fa-expand-arrows-alt fullscreen-icon"></i><!-- Icône de plein écran -->
                                    <?php
                                    // Récupère la référence et la catégorie de l'image associée
                                    $related_titre = get_field('titre');   
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
                                            <p><?php echo esc_html($related_titre); ?></p>
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

// Fonction pour filtrer les photos via AJAX
function filter_photos()
{
    // Vérifiez si l'action est définie
    if (isset($_POST['action']) && $_POST['action'] == 'filter_photos') {
        // Récupérez les filtres et nettoyez-les
        $filter = array_map('sanitize_text_field', $_POST['filter']);

        // Ajoutez des messages de débogage pour voir les valeurs reçues
        error_log('Filter values: ' . print_r($filter, true));

        // Construisez votre requête WP_Query avec les filtres
        $args = array(
            'post_type'      => 'photo',
            'posts_per_page' => -1,
            'orderby'        => 'rand',
            'order'          => 'ASC',
            'tax_query'      => array(
                'relation' => 'AND',
            ),
        );

        // Ajoutez la taxonomie pour la catégorie si elle est spécifiée
        if (!empty($filter['category'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $filter['category'],
            );
        }

        // Ajoutez la taxonomie pour l'année si elle est spécifiée
        if (!empty($filter['years'])) {
            $args['order'] = ($filter['years'] == 'date_desc') ? 'DESC' : 'ASC';
        }

        // Ajoutez la taxonomie pour le format si elle est spécifiée
        if (!empty($filter['format'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'format',
                'field'    => 'slug',
                'terms'    => $filter['format'],
            );
        }

        // Effectuez la requête WP_Query
        $query = new WP_Query($args);

        // Vérifiez si la requête a réussi
        if ($query->have_posts()) {
            // Boucle à travers les résultats de la requête
            while ($query->have_posts()) :
                $query->the_post();
                // Récupérez et affichez les informations de chaque photo
                $photoId      = get_post_thumbnail_id();
                $reference    = get_field('reference');
                $refUppercase = strtoupper($reference);

                // Ajoutez des messages de débogage pour les champs ACF
                error_log('Photo ID: ' . $photoId);
                error_log('Reference: ' . $reference);

                // Affiche le bloc de photo
                get_template_part('template-parts/photo_block');
            endwhile;

            // Réinitialisez les données de requête après la boucle de requête
            wp_reset_query();
        } else {
            // Aucune photo ne correspond aux critères de filtrage
            echo '<p class="critereFiltrage">Aucune photo ne correspond aux critères de filtrage</p>';
        }
    }

    // Assurez-vous que votre code renvoie la sortie souhaitée pour le traitement AJAX
    die();
}


add_action('wp_ajax_filter_photos', 'filter_photos');  // Hook pour les utilisateurs connectés
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');  // Hook pour les utilisateurs non connectés
