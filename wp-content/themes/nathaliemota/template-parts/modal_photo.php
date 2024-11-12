<button id="myBtn-photo">Contact</button>

<div id="myModal-photo" class="modal-photo">

    <div class="modal-content-photo">
        <span class="close-photo">X</span>
        <img src="<?php echo esc_url(wp_get_attachment_url(34)); ?>" alt="Contact" />
        <?php echo do_shortcode('[contact-form-7 id="733e82d" title="Contact-Photo"]'); ?>
    </div>

</div>