<?php
/**
 * Product custom tabs – add custom named tabs to single product (long description area).
 * Tabs are editable per product; Reviews tab is forced to the end.
 *
 * @package dtf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Meta key for custom tabs (array of [ 'title' => '', 'content' => '' ]).
 */
const WT_PRODUCT_CUSTOM_TABS_META = '_wt_product_custom_tabs';

/**
 * Register meta box for custom product tabs.
 */
function wt_product_custom_tabs_meta_box() {
	add_meta_box(
		'wt_product_custom_tabs',
		__( 'Custom product tabs', 'dtf' ),
		'wt_product_custom_tabs_meta_box_html',
		'product',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'wt_product_custom_tabs_meta_box' );

/**
 * Meta box HTML: repeatable title + WYSIWYG content; add/remove rows.
 */
function wt_product_custom_tabs_meta_box_html( $post ) {
	// Ensure editor styles and scripts are available (same as accordion CPT).
	wp_enqueue_editor();
	wp_enqueue_media();
	wp_enqueue_style( 'editor-buttons' );
	$css_src = includes_url( 'css/' ) . 'editor.css';
	wp_register_style( 'tinymce_css', $css_src );
	wp_enqueue_style( 'tinymce_css' );

	$tabs = get_post_meta( $post->ID, WT_PRODUCT_CUSTOM_TABS_META, true );
	if ( ! is_array( $tabs ) ) {
		$tabs = array();
	}
	wp_nonce_field( 'wt_save_product_custom_tabs', 'wt_product_custom_tabs_nonce' );
	?>
	<p class="description"><?php esc_html_e( 'Add extra tabs to the single product page (below the main description). You can name each tab and write any content. Reviews will always appear last.', 'dtf' ); ?></p>
	<div id="wt-product-custom-tabs-wrapper" class="wt-wrapper-cpt">
		<?php
		foreach ( $tabs as $i => $tab ) {
			$title   = isset( $tab['title'] ) ? $tab['title'] : '';
			$content = isset( $tab['content'] ) ? $tab['content'] : '';
			$editor_id = 'wt_product_custom_tabs_' . $i . '_content';
			$editor_name = 'wt_product_custom_tabs[' . $i . '][content]';
			?>
			<div class="wt-product-tab-row cpt-element" data-index="<?php echo (int) $i; ?>">
				<div class="sort-buttons">
					<button type="button" class="btn btn-sm btn-primary float-right mr-1 sort-down"><span class="dashicons dashicons-arrow-down-alt2"></span></button>
					<button type="button" class="btn btn-sm btn-primary float-right mr-1 sort-up"><span class="dashicons dashicons-arrow-up-alt2"></span></button>
				</div>
				<div class="accordion-box cpt-box">
					<div class="click-area"><h4><?php echo esc_html( sprintf( __( 'Tab #%d', 'dtf' ), $i + 1 ) ); ?></h4></div>
					<div class="content-area">
						<p>
							<label><?php esc_html_e( 'Tab title', 'dtf' ); ?></label><br>
							<input type="text" name="wt_product_custom_tabs[<?php echo (int) $i; ?>][title]" value="<?php echo esc_attr( $title ); ?>" class="widefat" placeholder="<?php esc_attr_e( 'e.g. Shipping', 'dtf' ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Content', 'dtf' ); ?></label><br>
							<?php echo get_wp_editor( $content, $editor_id, $editor_name ); ?>
						</p>
						<p class="cpt-remove">
							<button type="button" class="remove" data-type="cpt-element"><?php esc_html_e( 'Remove tab', 'dtf' ); ?></button>
						</p>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<button type="button" class="button" id="wt-add-product-tab"><?php esc_html_e( 'Add tab', 'dtf' ); ?></button>

	<script>
	jQuery(function($) {
		var $wrapper = $('#wt-product-custom-tabs-wrapper');
		var $add_btn = $('#wt-add-product-tab');
		var index = $wrapper.find('.wt-product-tab-row').length;
		var ajaxUrl = '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>';

		function createWpEditor(editorId, editorName, contentBoxId, done) {
			$.post(ajaxUrl, {
				action: 'wt_get_text_editor',
				text_editor_id: editorId,
				textarea_name: editorName
			})
				.done(function(response) {
					$('#' + contentBoxId).append(response);
					if (typeof tinymce !== 'undefined') tinymce.execCommand('mceAddEditor', false, editorId);
					if (typeof quicktags !== 'undefined') quicktags({id: editorId});
				})
				.always(function() {
					if (done) done();
				});
		}

		$add_btn.on('click', function() {
			var contentBoxId = 'wt-product-tab-content-box-' + index;
			var editorId = 'wt_product_custom_tabs_' + index + '_content';
			var editorName = 'wt_product_custom_tabs[' + index + '][content]';

			var html = '<div class="wt-product-tab-row cpt-element" data-index="' + index + '">' +
				'<div class="sort-buttons">' +
				'<button type="button" class="btn btn-sm btn-primary float-right mr-1 sort-down"><span class="dashicons dashicons-arrow-down-alt2"></span></button>' +
				'<button type="button" class="btn btn-sm btn-primary float-right mr-1 sort-up"><span class="dashicons dashicons-arrow-up-alt2"></span></button>' +
				'</div>' +
				'<div class="accordion-box cpt-box">' +
				'<div class="click-area"><h4><?php echo esc_js( __( 'Tab #', 'dtf' ) ); ?>' + (index + 1) + '</h4></div>' +
				'<div class="content-area">' +
				'<p><label><?php echo esc_js( __( 'Tab title', 'dtf' ) ); ?></label><br>' +
				'<input type="text" name="wt_product_custom_tabs[' + index + '][title]" value="" class="widefat" placeholder="<?php echo esc_js( __( 'e.g. Shipping', 'dtf' ) ); ?>"></p>' +
				'<p><label><?php echo esc_js( __( 'Content', 'dtf' ) ); ?></label><br>' +
				'<span id="' + contentBoxId + '"></span></p>' +
				'<p class="cpt-remove"><button type="button" class="remove" data-type="cpt-element"><?php echo esc_js( __( 'Remove tab', 'dtf' ) ); ?></button></p>' +
				'</div></div></div>';
			$wrapper.append(html);
			$add_btn.prop('disabled', true);
			createWpEditor(editorId, editorName, contentBoxId, function() {
				$add_btn.prop('disabled', false);
			});
			index++;
		});

		$wrapper.on('click', '.remove', function() {
			var $row = $(this).closest('.wt-product-tab-row');
			var edId = $row.find('textarea.wp-editor-area').attr('id');
			if (edId && typeof tinymce !== 'undefined' && tinymce.get(edId)) {
				tinymce.get(edId).remove();
			}
			$row.remove();
		});

		$wrapper.on('click', '.sort-up', function() {
			var $row = $(this).closest('.wt-product-tab-row');
			var $prev = $row.prev('.wt-product-tab-row');
			if ($prev.length) $prev.before($row);
		});
		$wrapper.on('click', '.sort-down', function() {
			var $row = $(this).closest('.wt-product-tab-row');
			var $next = $row.next('.wt-product-tab-row');
			if ($next.length) $next.after($row);
		});
	});
	</script>
	<?php
}

/**
 * Save custom tabs meta (only on product save).
 */
function wt_save_product_custom_tabs( $post_id ) {
	if ( ! isset( $_POST['wt_product_custom_tabs_nonce'] ) || ! wp_verify_nonce( $_POST['wt_product_custom_tabs_nonce'], 'wt_save_product_custom_tabs' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$post = get_post( $post_id );
	if ( ! $post || $post->post_type !== 'product' ) {
		return;
	}

	$raw = isset( $_POST['wt_product_custom_tabs'] ) && is_array( $_POST['wt_product_custom_tabs'] ) ? $_POST['wt_product_custom_tabs'] : array();
	$tabs = array();
	foreach ( $raw as $row ) {
		$title   = isset( $row['title'] ) ? sanitize_text_field( $row['title'] ) : '';
		$content = isset( $row['content'] ) ? wp_kses_post( $row['content'] ) : '';
		if ( $title !== '' || $content !== '' ) {
			$tabs[] = array( 'title' => $title, 'content' => $content );
		}
	}
	update_post_meta( $post_id, WT_PRODUCT_CUSTOM_TABS_META, $tabs );
}
add_action( 'save_post_product', 'wt_save_product_custom_tabs' );

/**
 * Add custom tabs to WooCommerce product tabs and ensure Reviews is last.
 *
 * @param array $tabs WooCommerce product tabs.
 * @return array
 */
function wt_woocommerce_product_tabs( $tabs ) {
	global $product;
	if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
		return $tabs;
	}

	$custom = get_post_meta( $product->get_id(), WT_PRODUCT_CUSTOM_TABS_META, true );
	if ( ! is_array( $custom ) || empty( $custom ) ) {
		$custom = array();
	}

	// Force Reviews to always be last (high priority).
	if ( isset( $tabs['reviews'] ) ) {
		$tabs['reviews']['priority'] = 999;
	}

	// Insert custom tabs before Reviews (e.g. 21, 22, 23...).
	$priority = 21;
	foreach ( $custom as $i => $tab ) {
		$title   = isset( $tab['title'] ) ? $tab['title'] : sprintf( __( 'Tab %d', 'dtf' ), $i + 1 );
		$content = isset( $tab['content'] ) ? $tab['content'] : '';
		$key     = 'wt_custom_tab_' . $i;
		$tabs[ $key ] = array(
			'title'    => $title,
			'priority' => $priority,
			'callback' => function() use ( $content ) {
				if ( $content !== '' ) {
					echo '<div class="wt-product-custom-tab-content">' . wp_kses_post( $content ) . '</div>';
				}
			},
		);
		$priority++;
	}

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'wt_woocommerce_product_tabs', 20 );
