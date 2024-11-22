<button id="myBtn-photo">Contact</button>

<div id="myModal-photo" class="modal-photo">

    <div class="modal-content-photo">
        <span class="close-photo">X</span>
        <img src="<?php echo get_template_directory_uri() .'/assets/images/Contact-header.webp'; ?>" alt="Contact" />
        <?php echo do_shortcode('[contact-form-7 id="c408e1f" title="Contact"]'); ?>
    </div>

</div>