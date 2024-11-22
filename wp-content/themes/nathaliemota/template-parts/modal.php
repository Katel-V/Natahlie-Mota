<!-- Bouton Contact Modale - Header -->
<button id="open-modal-button-header">CONTACT</button>

<!-- Modale - Header -->
<div id="myModal" class="modal">
    <!-- Modal Content -->
    <div class="modal-content">
        <span class="close">X</span>
        <img src="<?php echo get_template_directory_uri() . '/assets/images/Contact-header.webp'; ?>" alt="Contact" />
        <?php echo do_shortcode('[contact-form-7 id="c408e1f" title="Contact"]'); ?>
    </div>
</div>