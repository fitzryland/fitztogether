var WPJM = function(){

    var WPJM_PARENT_ID = '#wp-admin-bar-wp-jump-menu',
        CACHE_KEY = 'wpjm_entries',
        self = this;

    this.wpjm_get_opts = function() {
        return jQuery(WPJM_PARENT_ID).data('opts');
    };

    this.wpjm_render = function(html) {
        var opts = self.wpjm_get_opts();
        var $parent = jQuery(WPJM_PARENT_ID);
        $parent.find('.loader').hide();
        $parent.append(html);
        var $el = jQuery('#wp-pdd').on('change', function () {
            if (this.value === '__reload__') {
                self.wpjm_refresh();
            } else {
                window.location = this.value;
            }
        });
        
        var $clearCacheOpt = jQuery('<option value="__reload__">' + opts.reloadText + '</option>');
        $el.find('option:last').parent().append($clearCacheOpt);

        if (opts.useChosen) {
            $el.customChosen({position: opts.position, search_contains: true});
            if(opts.currentPageID) {
                var $option = $el.find('[data-post-id='+opts.currentPageID+']');
                $el.find('[data-post-id='+opts.currentPageID+']').prop( "selected", true );
                $el.trigger('chosen:updated');
            }
        }
    };

    this.wpjm_load = function() {

        var wpjm_opts_cache = self.wpjm_get_opts();

        if (wpjm_opts_cache != undefined) {
            // remove old stuff if it's there
            jQuery(WPJM_PARENT_ID).children('*:not(script):not(.ab-item, .loader)').remove();
            // load new
            jQuery.get(self.wpjm_get_opts().baseUrl + '?action=wpjm_menu', function (html) {
                self.wpjm_render(html);
            });
        }

    };

    this.wpjm_refresh = function() {
        // remove old stuff if it's there
        jQuery(WPJM_PARENT_ID).children('*:not(script):not(.ab-item, .loader)').remove();
        // load new
        jQuery.get(self.wpjm_get_opts().baseUrl + '?action=wpjm_menu&refresh=true', function (html) {
            self.wpjm_render(html);
        });
    }

    this.wpjm_init_html = function (opts) {
        var $parent = jQuery(WPJM_PARENT_ID);
        $parent.data('opts', opts);

        self.wpjm_load();

        $parent.find('.ab-item').click(self.wpjm_refresh);
    };

    return this;

};

var wpjm = new WPJM;

jQuery(document).ready(function() {

        wpjm.wpjm_init_html({
            baseUrl: wpjm_opt.baseUrl,
            useChosen: wpjm_opt.useChosen,
            position: wpjm_opt.position,
            reloadText: wpjm_opt.reloadText,
            currentPageID: wpjm_opt.currentPageID
        });

});
