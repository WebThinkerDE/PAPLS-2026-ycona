<?php

	/* Add Custom Post Type - Accordion */
	function add_custom_post_type_accordion() {
		
		$labels = array(
			'name' => _x( 'Accordion', 'Post Type General Name', 'ycona' ),
			'singular_name' => _x( 'Accordion', 'Post Type Singular Name', 'ycona' ),
			'menu_name' => __( 'Accordion', 'ycona' ),
			'name_admin_bar' => __( 'Accordion', 'ycona' ),
			'archives' => __( 'Accordion Archives', 'ycona' ),
			'attributes' => __( 'Accordion Attributes', 'ycona' ),
			'parent_item_colon' => __( 'Parent Accordion:', 'ycona' ),
			'all_items' => __( 'All Accordions ', 'ycona' ),
			'add_new_item' => __( 'Add New Accordion', 'ycona' ),
			'add_new' => __( 'Add New', 'ycona' ),
			'new_item' => __( 'New Accordion', 'ycona' ),
			'edit_item' => __( 'Edit Accordion', 'ycona' ),
			'update_item' => __( 'Update Accordion', 'ycona' ),
			'view_item' => __( 'View Accordion', 'ycona' ),
			'view_items' => __( 'View Accordions', 'ycona' ),
			'search_items' => __( 'Search Accordion', 'ycona' ),
			'not_found' => __( 'Not found', 'ycona' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'ycona' ),
			'featured_image' => __( 'Accordion Image', 'ycona' ),
			'set_featured_image' => __( 'Set Accordion image', 'ycona' ),
			'remove_featured_image' => __( 'Remove Accordion image', 'ycona' ),
			'use_featured_image' => __( 'Use as Accordion image', 'ycona' ),
			'insert_into_item' => __( 'Insert into Accordion', 'ycona' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Accordion', 'ycona' ),
			'items_list' => __( 'Accordions list', 'ycona' ),
			'items_list_navigation' => __( 'Accordions list navigation', 'ycona' ),
			'filter_items_list' => __( 'Filter Accordion list', 'ycona' ),
		);
		
		$args = array(
			'label' => __( 'Accordion', 'ycona' ),
			'description' => __( 'Accordion', 'ycona' ),
			'labels' => $labels,
			'supports' => array( 'title' ),
			'public' => true,
			'show_in_rest' => true,
			'show_ui' => true,
			'menu_position' => 21,
			'menu_icon' => 'dashicons-menu',
			'has_archive' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_in_nav_menus' => false,
		);
		
		register_post_type( 'Accordion', $args );
	}
	add_action("init", "add_custom_post_type_accordion");
	
	// add HTML for Accordion CPT
	function add_accordion_meta_box() {
		
		$text = __( 'Accordion information', 'ycona' );
		
		add_meta_box(
			'accordion_fields_meta_box',
			$text,
			'show_accordion_custom_fields',
			'Accordion'
		);
	}
	add_action( 'add_meta_boxes', 'add_accordion_meta_box' );
	
	function save_custom_post_accordion_metas( $post_id ) {
		
		$metaNonce    = "accordionMetaNonce";
		$saveFields   = "saveAccordionFields";
		$fields       = "accordion_fields";
		
		return save_custom_post_metas($post_id, $metaNonce, $saveFields, $fields);
	}
	add_action( 'save_post', 'save_custom_post_accordion_metas' );
	/* END - Add Custom Post Type - Accordion */
	
	function add_custom_post_type_testimonials() {
		$labels = array(
			'name' => _x( 'Testimonials', 'Post Type General Name', "ycona" ),
			'singular_name' => _x( 'Testimonials', 'Post Type Singular Name', "ycona" ),
			'menu_name' => __( 'Testimonials', "ycona" ),
			'name_admin_bar' => __( 'Testimonials', "ycona" ),
			'archives' => __( 'Testimonials Archives', "ycona" ),
			'attributes' => __( 'Testimonials Attributes', "ycona" ),
			'parent_item_colon' => __( 'Parent Testimonials:', "ycona" ),
			'all_items' => __( 'All Testimonials', "ycona" ),
			'add_new_item' => __( 'Add New Testimonials', "ycona" ),
			'add_new' => __( 'Add New', "ycona" ),
			'new_item' => __( 'New Testimonials', "ycona" ),
			'edit_item' => __( 'Edit Testimonials', "ycona" ),
			'update_item' => __( 'Update Testimonials', "ycona" ),
			'view_item' => __( 'View Testimonials', "ycona" ),
			'view_items' => __( 'View Testimonials', "ycona" ),
			'search_items' => __( 'Search Testimonials', "ycona" ),
			'not_found' => __( 'Not found', "ycona" ),
			'not_found_in_trash' => __( 'Not found in Trash', "ycona" ),
			'insert_into_item' => __( 'Insert into Testimonials', "ycona" ),
			'uploaded_to_this_item' => __( 'Uploaded to this Testimonials', "ycona" ),
			'items_list' => __( 'Testimonials list', "ycona" ),
			'items_list_navigation' => __( 'Testimonials list navigation', "ycona" ),
			'filter_items_list' => __( 'Filter Testimonials list', "ycona" ),
		);
		
		$args = array(
			'label' => __( 'Testimonials', "ycona" ),
			'description' => __( 'Testimonials', "ycona" ),
			'labels' => $labels,
			'supports' => array( 'title' ),
			'public' => true,
			'show_in_rest' => true,
			'show_ui' => true,
			'menu_position' => 39,
			'menu_icon' => 'dashicons-images-alt2',
			'has_archive' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_in_nav_menus' => false,
		);
		
		register_post_type( 'Testimonials', $args );
	}
	add_action("init", "add_custom_post_type_testimonials");
	
	// add HTML for Testimonials CPT
	function add_testimonials_meta_box() {
		
		$text = __( 'Testimonials information', "ycona" );
		
		add_meta_box(
			'testimonials_fields_meta_box',
			$text,
			'show_testimonials_custom_fields',
			'Testimonials'
		);
	}
	add_action( 'add_meta_boxes', 'add_testimonials_meta_box' );
	
	// saves metas for CPT Testimonials
	function save_custom_post_testimonials_metas( $post_id ) {
		
		$metaNonce    = "testimonialsMetaNonce";
		$saveFields   = "testimonialsFields";
		$fields       = "testimonials_fields";
		
		return save_custom_post_metas($post_id, $metaNonce, $saveFields, $fields);
	}
	add_action( 'save_post', 'save_custom_post_testimonials_metas' );
	/* END - Add Custom Post Type - Testimonials */

	/* Add Custom Post Type - Cards */
	function add_custom_post_type_cards() {
		
		$labels = array(
			'name' => _x( 'Cards', 'Post Type General Name', 'ycona' ),
			'singular_name' => _x( 'Card', 'Post Type Singular Name', 'ycona' ),
			'menu_name' => __( 'Cards', 'ycona' ),
			'name_admin_bar' => __( 'Cards', 'ycona' ),
			'archives' => __( 'Cards Archives', 'ycona' ),
			'attributes' => __( 'Cards Attributes', 'ycona' ),
			'parent_item_colon' => __( 'Parent Card:', 'ycona' ),
			'all_items' => __( 'All Cards', 'ycona' ),
			'add_new_item' => __( 'Add New Card', 'ycona' ),
			'add_new' => __( 'Add New', 'ycona' ),
			'new_item' => __( 'New Card', 'ycona' ),
			'edit_item' => __( 'Edit Card', 'ycona' ),
			'update_item' => __( 'Update Card', 'ycona' ),
			'view_item' => __( 'View Card', 'ycona' ),
			'view_items' => __( 'View Cards', 'ycona' ),
			'search_items' => __( 'Search Cards', 'ycona' ),
			'not_found' => __( 'Not found', 'ycona' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'ycona' ),
			'featured_image' => __( 'Card Image', 'ycona' ),
			'set_featured_image' => __( 'Set Card image', 'ycona' ),
			'remove_featured_image' => __( 'Remove Card image', 'ycona' ),
			'use_featured_image' => __( 'Use as Card image', 'ycona' ),
			'insert_into_item' => __( 'Insert into Card', 'ycona' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Card', 'ycona' ),
			'items_list' => __( 'Cards list', 'ycona' ),
			'items_list_navigation' => __( 'Cards list navigation', 'ycona' ),
			'filter_items_list' => __( 'Filter Cards list', 'ycona' ),
		);
		
		$args = array(
			'label' => __( 'Cards', 'ycona' ),
			'description' => __( 'Cards', 'ycona' ),
			'labels' => $labels,
			'supports' => array( 'title' ),
			'public' => true,
			'show_in_rest' => true,
			'show_ui' => true,
			'menu_position' => 40,
			'menu_icon' => 'dashicons-index-card',
			'has_archive' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_in_nav_menus' => false,
		);
		
		register_post_type( 'Cards', $args );
	}
	add_action("init", "add_custom_post_type_cards");
	
	// add HTML for Cards CPT
	function add_cards_meta_box() {
		
		$text = __( 'Cards information', 'ycona' );
		
		add_meta_box(
			'cards_fields_meta_box',
			$text,
			'show_cards_custom_fields',
			'Cards'
		);
	}
	add_action( 'add_meta_boxes', 'add_cards_meta_box' );
	
	// saves metas for CPT Cards
	function save_custom_post_cards_metas( $post_id ) {
		
		$metaNonce    = "cardsMetaNonce";
		$saveFields   = "saveCardsFields";
		$fields       = "cards_fields";
		
		return save_custom_post_metas($post_id, $metaNonce, $saveFields, $fields);
	}
	add_action( 'save_post', 'save_custom_post_cards_metas' );
	/* END - Add Custom Post Type - Cards */
	
