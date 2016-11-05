<?php
/*
Plugin Name: WCR Featured widget
Version: 0.0.0
Description: WCR Featured teaser for categories Sale and Property
 */

add_action( 'widgets_init', 'wcr_featured_widget_init' );

function wcr_featured_widget_init() {
    register_widget( 'wcr_featured_widget' );
}

class wcr_featured_widget extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'widget_featured_single_post',
            'description' => __( 'Display Featured Post', 'spacious' ) );
        $control_ops = array( 'width' => 200, 'height' =>250 );
        parent::__construct( false, $name='WCR Featured Post', $widget_ops, $control_ops);
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'cat_id' => '', 'title' => '', 'disable_feature_image' => 0, 'image_position' => 'above' ) );
        $title = esc_attr( $instance[ 'title' ] );
        $cat_id = absint( $instance[ 'cat_id' ] );
        $disable_feature_image = $instance['disable_feature_image'] ? 'checked="checked"' : '';
        $image_position = $instance[ 'image_position' ];
_e( 'Displays the title of the Post if title input is empty.', 'wcr_theme' );
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'spacious' ); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p><?php _e( 'Choose a category to feature the lastest post.', 'wcr_theme' );
?></p>

        <p>
            <label for="<?php echo $this->get_field_id( 'cat_id' ); ?>"><?php _e( 'Category', 'wcr_theme' ); ?>:</label>
            <?php wp_dropdown_categories( array('name' => $this->get_field_name( 'cat_id' ),'selected' => $instance[ 'cat_id' ])); ?>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php echo $disable_feature_image; ?> id="<?php echo $this->get_field_id('disable_feature_image'); ?>" name="<?php echo $this->get_field_name('disable_feature_image'); ?>" /> <label for="<?php echo $this->get_field_id('disable_feature_image'); ?>"><?php _e( 'Remove Featured image', 'spacious' ); ?></label>
        </p>

        <?php if( $image_position == 'above' ) { ?>
        <p>
            <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" style="" checked /><?php _e( 'Show Image Before Title', 'spacious' );?><br />
            <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" style="" /><?php _e( 'Show Image After Title', 'spacious' );?><br />
        </p>
        <?php } else { ?>
        <p>
            <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" style="" /><?php _e( 'Show Image Before Title', 'spacious' );?><br />
            <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" style="" checked /><?php _e( 'Show Image After Title', 'spacious' );?><br />
        </p>
        <?php } ?>

<?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
        $instance[ 'cat_id' ] = absint( $new_instance[ 'cat_id' ] );
        $instance[ 'disable_feature_image' ] = isset( $new_instance[ 'disable_feature_image' ] ) ? 1 : 0;
        $instance[ 'image_position' ] = $new_instance[ 'image_position' ];

        return $instance;
    }

    function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );
        global $post;
        $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $cat_id = isset( $instance[ 'cat_id' ] ) ? $instance[ 'cat_id' ] : '';
        $disable_feature_image = !empty( $instance[ 'disable_feature_image' ] ) ? 'true' : 'false';
        $image_position = isset( $instance[ 'image_position' ] ) ? $instance[ 'image_position' ] : 'above' ;
        if( $cat_id ) {

            $the_query = new WP_Query( array( 'cat' => $cat_id ) );
            while( $the_query->have_posts() ):$the_query->the_post();
            $page_name = get_the_title();

            $output = $before_widget;
            if( $image_position == "below" ) {
                if( $title ): $output .= $before_title.$title.$after_title;
                else: $output .= $before_title.$page_name.$after_title;
endif;
            }
            if( has_post_thumbnail() && $disable_feature_image != "true" ) {
                $output.= '<div class="service-image">'.get_the_post_thumbnail( $post->ID, 'featured', array( 'title' => esc_attr( $page_name ), 'alt' => esc_attr( $page_name ) ) ).'</div>';
            }

            if( $image_position == "above" ) {
                if( $title ): $output .= $before_title.'<a href="' . get_permalink() . '" title="'.$title.'">'. $title .'</a>'.$after_title;
                else: $output .= $before_title.'<a href="' . get_permalink() . '" title="'.$page_name.'">'. $page_name .'</a>'.$after_title;
endif;
            }
            $output .= '<p>'.get_the_excerpt().'</p>';
            $output .= '<a class="call-to-action-button" href="'. get_permalink() .'">'.$page_name.'</a>';
            $output .= $after_widget;
endwhile;
// Reset Post Data
wp_reset_postdata();
echo $output;
        }

    }
}
?>