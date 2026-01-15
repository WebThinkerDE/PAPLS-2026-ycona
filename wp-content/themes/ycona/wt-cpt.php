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
	
