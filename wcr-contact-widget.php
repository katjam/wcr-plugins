<?php
/*
Plugin Name: WCR contact header block
Version: 0.0.0
Description: WCR header with phone, email, socials and address.
 */

add_action( 'widgets_init', 'wcr_contact_widget_init' );

function wcr_contact_widget_init() {
    register_widget( 'wcr_contact_widget' );
}

class wcr_contact_widget extends WP_Widget
{

    public function __construct()
    {
        $widget_details = array(
            'classname' => 'wcr_contact_widget',
            'description' => 'WCR contact widget'
        );

        parent::__construct( 'wcr_contact_widget', 'WCR Contact Widget', $widget_details );

    }

    public function form( $instance ) {
        // Backend Form
        $title = '';
        if( !empty( $instance['title'] ) ) {
            $title = $instance['title'];
        }

        $text = '
        <div class="address">
           Coombe Farm Cottage<br>
           Cheriton Bishop<br>
           Exeter EX6 6JL<br>
        </div>
       <span class="mailto"><a href="mailto:lizzie@westcountryrural.co.uk" class="mailto"><i class="fa fa-envelope"></i></a> <a href="mailto:lizzie@westcountryrural.co.uk">lizzie@westcountryrural.co.uk</a></span>
        <div class="numbers">
           <span><i class="fa fa-phone"></i> 01647 24831</span>
           <span><i class="fa fa-mobile"></i> 07738 162673</span>
       </div>
       <div>
           <a href="https://twitter.com/wcountryrural" title="Follow West Country Rural on Twitter" target="_blank"><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i></a>
           <a href="https://uk.linkedin.com/in/lizzie-burton-9b4860106" title="View Lizzie Burton\'s Linkedin Profile" target="_blank"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i></a>
           <a href="https://www.facebook.com/westcountryrural" title="West Country Rural Facebook page" target="_blank"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></a>
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
