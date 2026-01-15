<div class="search-header-product-mobile">
    <form method="get" class="d-flex ycona-custom-search-form-mobile"
          id="ycona-custom-search-form-mobile">
        <div class="input-select-wrapper-mobile">
            <input type="text" name="search_term-mobile" id="search_term-mobile"
                   placeholder="<?php echo __('Search for products', 'ycona'); ?>"/>
        </div>
        <button type="submit" class="ux-search-submit submit-button-mobile" aria-label="Submit">
            <img class="search-icon" alt="search-icon"
                 src="<?php echo get_template_directory_uri(); ?>/assets/icons/icon-search.svg"/>
        </button>
    </form>
    <div id="search-results-mobile"></div>
</div>