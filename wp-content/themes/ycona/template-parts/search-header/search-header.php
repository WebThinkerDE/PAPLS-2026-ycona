<div class="search-header-product">
    <form method="get" class="d-flex ycona-custom-search-form" id="ycona-custom-search-form">
        <div class="input-select-wrapper">
            <input type="text" name="search_term" class="" id="search_term"
                   placeholder="<?php echo __('Where are you travelling?', 'ycona'); ?>"/>
        </div>
        <button type="submit" class="ux-search-submit submit-button" aria-label="Submit">
            <img class="search-icon" alt="search-icon"
                 src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-search-green.svg"/>
        </button>
    </form>
    <div id="search-results"></div>
</div>
