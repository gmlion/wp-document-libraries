<?php
class DocumentLibraries {

    function __construct() {
        add_action('init', array($this, 'add_custom_post_type'));
        add_shortcode('library', array($this, 'library_shortcode'));
        add_shortcode('library_link', array($this, 'library_link_shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'add_style'));
        add_action( 'admin_enqueue_scripts', array($this, 'disable_drafts'));
<<<<<<< HEAD

=======
        
>>>>>>> origin/master
    }

    function add_custom_post_type() {
        $labels = array(
            'name'=>__( 'Libraries', 'document_libraries' ),
            'singular_name'=>__( 'Library', 'document_libraries' ),
            'add_new_item'=>__( 'Add new library', 'document_libraries' ),
            'edit_item'=>__( 'Modify library', 'document_libraries' ),
            'new_item'=>__( 'Add new library', 'document_libraries' ),
            'all_items'=>__( 'All libraries', 'document_libraries' ),
            'view_item'=>__( 'View library', 'document_libraries' ),
            'search_items'=>__( 'Search for library', 'document_libraries' ),
            'not_found'=>__( 'No library found', 'document_libraries' ),
            'menu_name'=>__( 'Libraries', 'document_libraries' )
        );

        $args = array(
            'labels'=>$labels,
            'description'=>__( 'Libraries of documents', 'document_libraries' ),
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
                if (!has_post_thumbnail()) {
                    //FIXME site-specific: remove upper margin if no thumbnail is present
                    $container = '<div class="library-container" style="margin-top: 15px">';
                }
                //the_content();
                $media = get_children(array(
                    'post_parent' => get_the_ID(),
                    'post_type' => 'attachment'
                ));
<<<<<<< HEAD

                foreach($media as $singleAttachment) {
                    ?>
                    <a href="<?php echo $singleAttachment->guid ?>">
                      <div class="library-link-container">
                        <div class="library-link-title">
                          <?php echo $singleAttachment->post_title; ?>
                        </div>
                      <?php
                      if ($singleAttachment->post_excerpt) {
                        echo '<div class="library-link-description">';
                        echo $singleAttachment->post_excerpt;
                        echo '</div>';
                      }
                    ?>
                    </div>
                  </a>

                    <?php

=======
                foreach($media as $singleAttachment) {
                    ?>
                    <a href="<?php echo $singleAttachment->guid ?>"><?php echo $singleAttachment->post_title; ?></a>
                    <?php
                    
>>>>>>> origin/master
                }
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
    // [library_link name="library-name"]
    function library_link_shortcode($atts) {
        $a = shortcode_atts( array(
            'name' => 'empty',
        ), $atts );
        if ($a['name'] == 'empty') {
            return;
        } else {
            $args = array(
                'post_type' => 'libraries',
                'name' => $a['name']
            );
            $query = new WP_Query($args);
            while ($query->have_posts()) {
                $query->the_post();
                $content = '<strong><a href="' . get_permalink() . '">' . get_the_title() . '</a></strong>';
            }
            return $content;
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> origin/master
    function add_style() {
        wp_register_style( 'library-style', plugins_url( 'css/library_style.css', __FILE__ ) );
        wp_enqueue_style('library-style');
    }
<<<<<<< HEAD

=======
    
>>>>>>> origin/master
    function disable_drafts() {
        if ( 'libraries' == get_post_type() )
        wp_dequeue_script( 'autosave' );
    }

}
?>
