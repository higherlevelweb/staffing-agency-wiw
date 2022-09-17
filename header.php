<?php
/**
 * The header for theme
 * @package staffing-agency-wiw
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="site">
        <header id="masthead" class="site-header fixed-top">
            <div id="topbar"><span><a href="/request-staff/"><i class="icofont-ui-calendar"></i> Request Staff</a></span>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu"
                    aria-expanded="false"><i class="icofont-navigation-menu"></i></button>
                <div id='nav-menu-logo'><a href="/"><img src="http://educarestaffing.com/wp-content/themes/staffing-agency-wiw/images/ecs-logo.png" /></a></div>
                <?php
                if ( current_user_can( 'manage_options' ) ) {

                    wp_nav_menu(
                        array(
                            'theme_location' => 'admin-menu',
                            'container_id'         => 'primary-menu',
                        )
                    );

                } else {

                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'container_id'         => 'primary-menu',
                        )
                    );

                }
			?>
            </nav><!-- #site-navigation -->
        </header><!-- #masthead -->
