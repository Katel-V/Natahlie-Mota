<!-- PAGE D'ACCUEIL -->

<?php get_header(); ?>

<!-- Section Hero Image -->
<div class="hero">
    <?php
    //  Sélection d'une photo aléatoire de la même catégorie
    $args_related_photos = array(
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'orderby' => 'rand', // Tri des résultats de manière aléatoire
    );

    $related_photos_query = new WP_Query($args_related_photos);

    // Boucle Parcourir les résultats de la requête
    while ($related_photos_query->have_posts()) :
        $related_photos_query->the_post();
        $post_permalink = get_permalink(); // Lien permanent de la publication actuelle
    ?>
    <a href="<?php echo esc_url($post_permalink); ?>">
        <div class="hero-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/titre-accueil.png" alt="Titre Accueil">
        </div>
    </a>
    <?php endwhile; ?>

    <?php wp_reset_postdata(); // Réinitialiser données de publication à leur état d'origine ?>
</div>

<!-- SECTION FILTRES -->

<section class="filtre">
    <?php
    // Affichage des taxonomies
    $taxonomy = [
    'categorie' => 'CATÉGORIES',
    'format' => 'FORMATS',
    'annees' => 'TRIER PAR',
    ];

    // Début du conteneur #filtrePhoto
    echo "<div id='filtrePhoto'>";

    // SECTION GAUCHE
    
    echo "<div class='left-section'>";

    foreach ($taxonomy as $taxonomy_slug => $label) {
        // Exclure 'annees' de la section gauche
        if ($taxonomy_slug !== 'annees') {
            // Récupérer les termes de la taxonomie
            $terms = get_terms($taxonomy_slug);

         // Vérifier si des termes existent et qu'il n'y a pas d'erreur WordPress
         if ($terms && !is_wp_error($terms)) {
             // Ajouter une classe CSS spécifique pour chaque select
             $select_class = 'custom-select ' . $taxonomy_slug . '-select';

             // Début du conteneur pour la taxonomie
             echo "<div class='taxonomy-container'>";
             // Afficher le select avec l'ID et la classe appropriés
             echo "<select id='$taxonomy_slug' class='$select_class'>";
             // Option par défaut avec le label de la taxonomie
             echo "<option value=''>$label</option>";

             // Afficher chaque terme comme une option
             foreach ($terms as $term) {
                 echo "<option value='$term->slug'>$term->name</option>";
             }

             // Fin du select et du conteneur pour la taxonomie
             echo "</select>";
                echo "</div>";
            }
        }
    }

    // Fin de la section gauche
    echo "</div>";

    // SECTION DROITE

    echo "<div class='right-section'>";
    // Classe CSS spécifique pour la taxonomie 'annees'
    $select_class_annees = 'custom-select annees-select';
    // Début du conteneur pour la taxonomie 'annees'
    echo "<div class='taxonomy-container'>";
    // Afficher le select avec l'ID et la classe appropriés
    echo "<select id='annees' class='$select_class_annees'>";
    // Option par défaut avec le label de la taxonomie 'annees'
    echo "<option value=''>{$taxonomy['annees']}</option>";
    // Options spécifiques pour 'annees'
    echo "<option value='date_asc'>A partir des plus récentes</option>";
    echo "<option value='date_desc'>A partir des plus anciennes</option>";
    // Fin du select et du conteneur pour la taxonomie 'annees'
    echo "</select>";
    echo "</div>";

    // Fin de la section droite
    echo "</div>";

    // Fin du conteneur #filtrePhoto
    echo "</div>";
    ?>

</section>

<!-- Section Bloc de photos -->
<div id="photo-container">
    <?php include get_template_directory() . '/template-parts/photo_block.php'; ?>
</div>


<?php get_footer();


