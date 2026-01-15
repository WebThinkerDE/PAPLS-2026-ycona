<?php
	/**
	 * Copyright (c) 2025 by Granit Nebiu
	 *
	 * All rights are reserved. Reproduction or transmission in whole or in part, in
	 * any form or by any means, electronic, mechanical or otherwise, is prohibited
	 * without the prior written consent of the copyright owner.
	 *
	 * Functions and definitions
	 *
	 * @package WordPress
	 * @subpackage ycona
	 * @author Granit Nebiu
	 * @since 1.0
	 */
	
	
	get_header(); ?>
<div id="primary" class="content-area container">
    <main id="main" class="site-main container" role="main">
        <section class="error-404 not-found">
            <div class="error-404-container container d-flex flex-column gap-5 align-items-center justify-content-center">
                <img
                        class="image-404"
                        src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/404.png' ); ?>"
                        alt="<?php esc_attr_e( 'Page 404', 'ycona' ); ?>"
                />
                <div class="not-found-badge">
					<?php esc_html_e( 'Page not found', 'ycona' ); ?>
                </div>

                <p class="text-center">
					<?php esc_html_e( "This page isn't available.", 'ycona' ); ?><br/>
					<?php esc_html_e( "The link you followed may be broken, or the page may have been removed.", 'ycona' ); ?>
                </p>

                <a
                        class="btn-full btn-full-primary"
                        href="<?php echo esc_url( home_url( '/' ) ); ?>"
                        title="<?php esc_attr_e( "Back to homepage", 'ycona' ); ?>"
                >
					<?php esc_html_e( "Back to homepage", 'ycona' ); ?>
                </a>
            </div>

        </section>
    </main>
</div>

<?php get_footer(); ?>
