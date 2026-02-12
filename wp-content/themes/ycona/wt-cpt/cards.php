<?php
/* Custom Post Type - Cards */

function show_cards_custom_fields() {

    $js_src = includes_url('js/tinymce/') . 'tinymce.min.js';
    $css_src = includes_url('css/') . 'editor.css';

    wp_register_style('tinymce_css', $css_src);
    wp_enqueue_style('tinymce_css');

    global $post;

    $meta = get_post_meta($post->ID,'cards_fields',true);
    $c = 0;

    ?>

    <script src="<?php echo $js_src; ?>" type="text/javascript"></script>
    <div>

        <input type="hidden" name="cardsMetaNonce" value="<?php echo wp_create_nonce( "saveCardsFields" ); ?>">

        <div class="cardsSettings">
            <h3>Cards</h3>
        </div>

        <div id="wt-wrapper-cards" class="wt-wrapper-cpt">

            <?php

            if ( is_array($meta) && count( $meta ) > 0 )
            {
                foreach( $meta["cards"] as $card )
                {
                    $card_title         = $card["card_title"] ?? '';
                    $description        = $card["description"] ?? '';
                    $link_url           = $card["link_url"] ?? '';
                    $link_text          = $card["link_text"] ?? '';
                    $imgSrc             = $card["image"] ?? '';
                    $imgId              = $card["imageId"] ?? '';

                    echo '<div class="card-item cpt-element" data-count="'.$c.'">

            <div class="sortButtons">
                <button type="button" class="btn btn-sm btn-primary float-right mr-1 sort-down">
                    <span class="dashicons dashicons-arrow-down-alt2"></span>
                </button>
                <button type="button" class="btn btn-sm btn-primary float-right mr-1 sort-up">
                    <span class="dashicons dashicons-arrow-up-alt2"></span>
                </button>
            </div>
            
            <div id="box-wrapper-'.$c.'" class="cards-box cpt-box">
                
                <div class="click-area">
                    <h3>Card #'.($c+1).'</h3>
                </div>
                
                <div class="content-area">
                    <dl>
                        <dt></dt>
                        <dd>
                            <hr>
                        </dd>
                        
                        <dt>'.__('Image','ycona').'</dt>
                        <dd>
                            <input type="hidden" name="cards_fields[cards]['.$c.'][image]" class="meta-image" value="'.$imgSrc.'">
                            <input type="hidden" name="cards_fields[cards]['.$c.'][imageId]" class="meta-image-id" value="'.$imgId.'">
                            <input type="button" data-id="'.$c.'" class="button image-upload" value="'.__('Browse','ycona').'">
                            <input type="button" class="button image-upload-remove" data-id="'.$c.'" value="'.__('Remove','ycona').'">
                        </dd>
                        
                        <dt>'.__('Image Preview','ycona').'</dt>
                        <dd>
                            <div class="image-preview"><img src="'.$imgSrc.'" alt=""></div>
                        </dd>
                        
                        <dd>
                            <hr>
                        </dd>
                        
                        <dt>'.__('Card Title','ycona').'</dt>
                        <dd>
                            <input type="text" name="cards_fields[cards]['.$c.'][card_title]" placeholder="'.__('Write here','ycona').'..." class="regular-text" value="'.$card_title.'">
                        </dd>

                        <div class="elements-hexagon-style">
                            <dt>' . __('Description', 'ycona') . '</dt>
                            ' . getWpEditor($description, "cards_fields_description_$c", "cards_fields[cards][" . $c . "][description]") . '
                        </div>
                        
                        <dt>'.__('Link URL','ycona').'</dt>
                        <dd>
                            <input type="text" name="cards_fields[cards]['.$c.'][link_url]" placeholder="https://..." class="regular-text" value="'.$link_url.'">
                        </dd>
                        
                        <dt>'.__('Link Text','ycona').'</dt>
                        <dd>
                            <input type="text" name="cards_fields[cards]['.$c.'][link_text]" placeholder="'.__('Write here','ycona').'..." class="regular-text" value="'.$link_text.'">
                        </dd>
                        
                        <div class="cpt-remove">
                            <button type="button" class="remove">'.__('Remove Card', 'ycona').'</button>
                        </div>
                    </dl>
                </div>
            </div>
        </div>';
                    $c = $c+1;
                }
            }

            ?>
        </div>
        <button type="button" class="add"><?php _e('Add Card','ycona'); ?></button>
    </div>

    <script>

        jQuery(document).ready(function() {

            jQuery("#wt-wrapper-cards + .add").click(function() {
                var $addBtn = jQuery(this);
                var $wrapper = $addBtn.prev(".wt-wrapper-cpt");
                $addBtn.hide();

                let count = getExistingElements(".card-item");

                var cardHTML = `<div class="card-item cpt-element" data-count="${count}">

                        <div class="sortButtons">
                        <button type="button" class="btn btn-sm btn-primary float-right mr-1 sort-down">
                            <span class="dashicons dashicons-arrow-down-alt2"></span>
                        </button>
                        <button type="button" class="btn btn-sm btn-primary float-right mr-1 sort-up">
                            <span class="dashicons dashicons-arrow-up-alt2"></span>
                        </button>
                    </div>

                    <div id="box-wrapper-${count}" class="cards-box cpt-box">

                        <div class="click-area">
                            <h3>Card #${count}</h3>
                        </div>

                        <div class="content-area link">
                            <dl>
                                <dt></dt>
                                <dd>
                                    <hr>
                                </dd>

                                <dt><?php _e('Image','ycona'); ?></dt>
                                <dd>
                                    <input type="hidden" name="cards_fields[cards][${count}][image]" class="meta-image" value="">
                                    <input type="hidden" name="cards_fields[cards][${count}][imageId]" class="meta-image-id" value="">
                                    <input type="button" data-id="${count}" class="button image-upload" value="<?php _e('Browse','ycona'); ?>">
                                    <input type="button" data-id="${count}" class="button image-upload-remove" value="<?php _e('Remove','ycona'); ?>">
                                </dd>

                                <dt><?php _e('Image Preview','ycona'); ?></dt>
                                <dd>
                                    <div class="image-preview"><img src="" alt=""></div>
                                </dd>
                                
                                <dd>
                                    <hr>
                                </dd>

                                <dt><?php _e('Card Title','ycona'); ?></dt>
                                <dd>
                                    <input type="text" name="cards_fields[cards][${count}][card_title]" placeholder="<?php _e('Write here','ycona'); ?>..." class="regular-text" value="">
                                </dd>

                               <div class="elements-hexagon-style">
                                      <dt><?php _e('Description', 'ycona'); ?></dt>
                                      <span id="box-row2-${count}-cards_fields_${count}_description"></span>
                               </div>

                                <dt><?php _e('Link URL','ycona'); ?></dt>
                                <dd>
                                    <input type="text" name="cards_fields[cards][${count}][link_url]" placeholder="https://..." class="regular-text" value="">
                                </dd>

                                <dt><?php _e('Link Text','ycona'); ?></dt>
                                <dd>
                                    <input type="text" name="cards_fields[cards][${count}][link_text]" placeholder="<?php _e('Write here','ycona'); ?>..." class="regular-text" value="">
                                </dd>

                                <div class="cpt-remove">
                                    <button type="button" class="remove"><?php _e('Remove Card', 'ycona'); ?></button>
                                </div>

                            </dl>
                        </div>
                    </div>

                </div>`;
	            
	            $wrapper.append(cardHTML);
	            
	            let target = "<?php echo admin_url('admin-ajax.php'); ?>";
	            
	            let createWpEditor = function(editor_id, editor_name, $addBtn) {
		            let data_text = {
			            'action': 'wt_get_text_editor',
			            'text_editor_id': editor_id,
			            'textarea_name': editor_name
		            }
		            
		            jQuery.post(target, data_text)
		                .done(function (response) {
			                let cont = "#box-row2-" + count + "-" + editor_id;
			                jQuery(cont).append(response);
			                if (typeof tinymce !== "undefined") tinymce.execCommand('mceAddEditor', false, editor_id);
			                if (typeof quicktags !== "undefined") quicktags({id: editor_id});
		                })
		                .always(function() {
		                    $addBtn.show();
		                });
	            }
	            
	            // Description Editor
	            let description_id = "cards_fields_" + count + "_description";
	            let description_name = "cards_fields[cards][" + count + "][description]";
	            
	            createWpEditor(description_id, description_name, $addBtn);
				
                setButtons();
                resetSort();
            });

            setButtons();
        });
    </script>
<?php }
/* END - Custom Post Type - Cards */
