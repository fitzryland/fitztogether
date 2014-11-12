<?php
/**
 * Code to create a new Custom Post Type
 * Contextual help may be needed at some point
 * @todo factor out the key variables so that the CPT can be primarily defined at top of this file
 */

 add_action('init', 'tech_init');
  function tech_init() {
    $labels = array(
      'name' => 'Tech Library',
      'singular_name' => 'Resource',
      'add_new' => 'Add New',
      'add_new_item' => __('Add New Technical Library Entry'),
      'edit_item' => __('Edit Technical Library Entry'),
      'new_item' => __('New Technical Library Entry'),
      'view_item' => __('View Technical Library Entry'),
      'search_items' => __('Search Technical Library'),
      'not_found' =>  __('No resources found'),
      'not_found_in_trash' => __('No resources found in Trash'),
    );

    $taxonomy = 'tech-library';
    $args = array(
      'label' => 'Technical Library',
      'labels' => $labels,
      'description' => 'A entry in the Technical Library',
      'public' => true, //most admin display flows from this by default
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'menu_position' => 20,
      'hierarchical' => true,
      'taxonomies' => array($taxonomy),
      'supports' => array('title','editor','author','thumbnail','excerpt','custom-fields','revisions','page-attributes'),
      'has_archive' => false,
  //    'rewrite' => '' //default rewrite rules should be fine
    );

    /**
     * Register the post type
     * Documentation http://codex.wordpress.org/Function_Reference/register_post_type
     */
    register_post_type('tech', $args);

   // Add new taxonomy, make it hierarchical (like categories)
    $taxonomy_labels = array(
      'name' => _x( 'Tech Library Category', 'taxonomy general name' ),
      'singular_name' => _x( 'Tech Library Category', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Tech Library Categories' ),
      'all_items' => __( 'All Tech Library Categories' ),
      'parent_item' => __( 'Parent Tech Library Category' ),
      'parent_item_colon' => __( 'Parent Tech Library Category:' ),
      'edit_item' => __( 'Edit Tech Library Category' ),
      'update_item' => __( 'Update Tech Library Category' ),
      'add_new_item' => __( 'Add New Tech Library Category' ),
      'new_item_name' => __( 'New Tech Library Category Name' ),
      'menu_name' => __( 'Tech Library Category' ),
    );

    $taxonomy_args = array(
      'hierarchical' => true,
      'labels' => $taxonomy_labels,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => 'tech-library' )
      );


    /**
     * Register the taxonomy
     * Documentation http://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    register_taxonomy($taxonomy, array('tech'), $taxonomy_args);
  }


    /**
     * Create the custom columns
     * Documentation
     *
     * filter name "manage_edit-video_columns" is built off of post_type name
     * uncomment filter if you want to use
     */
    //add_filter('manage_edit-video_columns','my_video_columns');
    function my_video_columns($columns) {
      $columns = array(
        'cb' => '<input type="checkbox" />', //this appears to be required
        'title' => 'Video Title',
        'description' => 'Description',
        'length' => 'Length',
        'speakers' => 'Speakers',
        'comments' => 'Comments'
      );
      return $columns;
    }

    /**
     * Add content to your custom columns
     * Documentation
     *
     * uncomment action if you want to use
     */
    //add_action('manage_posts_custom_column', 'my_custom_columns');
    function my_custom_columns($column) {
      global $post;
      if ('ID' == $column) echo $post->ID;
      elseif ('description' == $column) echo $post->post_content;
      elseif ('length' == $column) echo '63:50'; //output $post meta info instead of string
      elseif ('speakers' == $column) echo 'Synotac';
    }
?>
