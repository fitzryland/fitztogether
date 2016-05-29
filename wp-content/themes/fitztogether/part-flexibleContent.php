<?php
$flexible_content = get_field('post_content');
if ( is_array($flexible_content) ) :
  foreach ($flexible_content as $block_key => $block) :
    // echo '<pre>';
    // print_r($block);
    // echo '</pre>';
    switch ($block['acf_fc_layout']) :
      case 'text_area':
        echo $block['text_content'];
        break;

      case 'media_object':
        $post_image_class = 'post_image';

        $image_alignment = strtolower($block['alignment']);
        $image_alignment = str_replace( ' ', '_', $image_alignment );
        $post_image_class .= ' post_image__' . $image_alignment;

        $image_size = strtolower($block['size']);
        $image_size = str_replace( 'extra ', 'x-', $image_size );
        $post_image_class .= ' post_image__' . $image_size;

        $img_set_args = array();
        $img_args = array(
          'image' => $block['image'],
          'class' => $post_image_class,
          'size' => $image_size,
          'imgSetArgs' => $img_set_args
        );

        $img_wrap_class = 'post_image_wrap';
        if ( $block['size'] == 'Extra Large' ) :
          $img_wrap_class = ' post_image_wrap__large';
        endif;

        echo '<div class="' . $img_wrap_class . '">';
          echo acf_image( $img_args );
        echo '</div>';

        break;

      case 'html_part':

        $file_slug = $block['file_name'];
        get_template_part( 'part', $file_slug );

        break;


      case 'video':
        ?>
        <div class="video_wrap">
          <?php echo wp_oembed_get( $block['video_url'] ); ?>
        </div>
        <?php

        break;

      default:
        # code...
        break;
    endswitch;
  endforeach;
endif;
?>