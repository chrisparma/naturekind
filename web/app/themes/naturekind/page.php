<?php

    get_header();
?>

<main id="main" class="container max-container py-5" <?php if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' style="padding-top: 160px;"'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' style="padding-bottom: 100px;"'; endif; ?>>

    <?php the_content(); ?>
    
</main>
<?php
    get_footer();
?>
