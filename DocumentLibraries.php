<?php
class DocumentLibraries {
    
    function __construct() {
        add_action('init', array($this, 'add_custom_post_type'));
        add_shortcode('library', array($this, 'library_shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'add_style'));
    }
    
    function add_custom_post_type() {
        $labels = array(
            'name'=>__('Libraries'),
            'singular_name'=>__('Library'),
            'add_new_item'=>__('Add new library'),
            'edit_item'=>__('Modify library'),
            'new_item'=>__('Add new library'),
            'all_items'=>__('All libraries'),
            'view_item'=>__('View library'),
            'search_items'=>__('Search for library'),
            'not_found'=>__('No library found'),
            'menu_name'=>__('Libraries')
        );

        $args = array(
            'labels'=>$labels,
            'description'=>__('Libraries of documents'),
            'public'=>true,
            'exclude_from_search'=>true,
            'has_archive'=>false,
            'show_ui'=>true,
            'publicly_queryable'=>true,
            'menu_icon'=>plugins_url( 'images/admin-icon.png', __FILE__ )
        );
        register_post_type('libraries', $args);
        //add_post_type_support('riservati', 'thumbnail');
    }
    // [library name="library-name"]
    function library_shortcode($atts) {
        $a = shortcode_atts( array(
            'name' => 'empty',
        ), $atts );
        if ($a['name'] == 'empty') {
            return;
        } else {
            $container = '<div class="library-container">';
            $args = array(
                'post_type' => 'libraries',
                'name' => $a['name']
            );
            ob_start();
            $query = new WP_Query($args);
            while ($query->have_posts()) {
                $query->the_post();
                the_content();
            }
            wp_reset_query();
            wp_reset_postdata();
            $content = ob_get_contents();
            ob_end_clean();
            //$content = do_shortcode($content); /*Shortcodes should not be present in the library*/
            $container .= $content;
            $container .= '</div>';            
            return $container;
        }
        
    }
    
    function add_style() {
        wp_register_style( 'library-style', plugins_url( 'css/library_style.css', __FILE__ ) );
        wp_enqueue_style('library-style');
    }
    
}
?>