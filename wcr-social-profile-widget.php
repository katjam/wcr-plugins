<?php
/*
Plugin Name: WCR social profiles block
Version: 0.0.0
Description: WCR social profile buttons.
*/

add_action( 'widgets_init', 'wcr_social_profile_widget_init' );

function wcr_social_profile_widget_init() {
    register_widget( 'wcr_social_profile_widget' );
}

class wcr_social_profile_widget extends WP_Widget
{

    public function __construct()
    {
        $widget_details = array(
            'classname' => 'wcr_social_profile_widget',
            'description' => 'WCR Social Profile widget'
        );

        parent::__construct( 'wcr_social_profile_widget', 'WCR Social Profile Widget', $widget_details );

    }

    public function form( $instance ) {
        // Backend Form
        $title = '';
        if( !empty( $instance['title'] ) ) {
            $title = $instance['title'];
        }

        $text = '
        <div>
           <a href="https://twitter.com/wcountryrural" title="Follow West Country Rural on Twitter" target="_blank"><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a>
           <a href="https://uk.linkedin.com/in/lizzie-burton-9b4860106" title="View Lizzie Burton\'s Linkedin Profile" target="_blank"><i class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i></a>
           <a href="https://www.facebook.com/westcountryrural" title="West Country Rural Facebook page" target="_blank"><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a>
       </div>
        ';
        if( !empty( $instance['text'] ) ) {
            $text = $instance['text'];
        }

        ?>

        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'text' ); ?>"><?php _e( 'Text:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" ><?php echo esc_attr( $text ); ?></textarea>
        </p>

        <div class='mfc-text'>

        </div>

        <?php

        echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    public function widget( $args, $instance ) {
        // Frontend display HTML
        echo $instance['text'];
    }

}
