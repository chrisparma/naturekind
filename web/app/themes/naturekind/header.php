<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>

<?php
	$navbar_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-light bg-light' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.
?>

<body <?php body_class(esc_attr( $navbar_scheme )); ?>>

<?php wp_body_open(); ?>

<a href="#main" class="visually-hidden-focusable"><?php esc_html_e( 'Skip to main content', 'naturekind' ); ?></a>

<div id="wrapper" class="d-flex flex-column">
	<header id="header">
		<nav class="navbar navbar-expand-md <?php if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' fixed-top'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' fixed-bottom'; endif; if ( is_home() || is_front_page() ) : echo 'home'; endif; ?>">
			<div class="navbar-column d-flex flex-column w-100">	
				<div class="container">
					<div class="left-right-col-wrapper">
						<div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'naturekind' ); ?>">
							<span class="navbar-toggler-icon"></span>
						</div>
					</div>

					<a class="navbar-brand mx-auto" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php
							$header_logo = get_theme_mod( 'header_logo' ); // Get custom meta-value.

							if ( ! empty( $header_logo ) ) :
						?>
							<img src="<?php echo esc_url( $header_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
						<?php
							else :
								echo esc_attr( get_bloginfo( 'name', 'display' ) );
							endif;
						?>
					</a>
					<?php display_woocommerce_icons(); ?>			
				</div><!-- /.container -->
				<div class="container">
					<?php display_menu(); ?>
				</div>
			</div>
		</nav><!-- /#header -->
	</header>

	<!-- <main id="main" class=""<?php if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' style="padding-top: 160px;"'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' style="padding-bottom: 100px;"'; endif; ?>> -->
	
		<?php
			// If Single or Archive (Category, Tag, Author or a Date based page).
			//if ( is_single() || is_archive() ) :
		?>
			<!-- <div class="row">
				<div class="col-md-8 col-sm-12"> -->
		<?php
			//endif;
		?>
