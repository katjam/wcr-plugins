<?php
/*
Plugin Name: WCR address block
Version: 0.0.0
Description: WCR address.
 */

add_action( 'widgets_init', 'wcr_address_widget_init' );

function wcr_address_widget_init() {
    register_widget( 'wcr_address_widget' );
}

class wcr_address_widget extends WP_Widget
{

    public function __construct()
    {
        $widget_details = array(
            'classname' => 'wcr_address_widget',
            'description' => 'WCR address widget'
        );

        parent::__construct( 'wcr_address_widget', 'WCR address Widget', $widget_details );

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
