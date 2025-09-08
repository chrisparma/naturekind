<?php
    function display_search() {
        $search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
        if ( '1' === $search_enabled ) :
        
?>
            <form class="search-form my-2 my-lg-0" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="input-group">
                    <input type="text" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Search', 'naturekind' ); ?>" title="<?php esc_attr_e( 'Search', 'naturekind' ); ?>" />
                    <button type="submit" name="submit" class="btn btn-outline-secondary"><?php esc_html_e( 'Search', 'naturekind' ); ?></button>
                </div>
            </form>

<?php

        endif;
    }