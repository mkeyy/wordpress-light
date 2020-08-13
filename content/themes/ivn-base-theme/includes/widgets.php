<?php
/**
 * ...
 *
 * @package IVN Base Theme
 * @since   1.0
 */
?>
<?php

/**
 * @since  1.0
 * @link   http://codex.wordpress.org/Function_Reference/add_action
 * @link   http://codex.wordpress.org/Function_Reference/add_filter
 *
 * @return void
 */
function ivn_custom_widgets_setup() {
	add_action( 'widgets_init', 'ivn_register_custom_widgets' );
}

add_action( 'after_setup_theme', 'ivn_custom_widgets_setup' );

/**
 * IVN_Widget
 */
class IVN_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'ivn-widget',
			'IVN Widget',
			array(
				'description' => __( 'A IVN Widget description.', 'ivn-theme' ),
			)
		);
	}

	public function widget( $Arguments, $Instance ) {
		extract( $Arguments );

		$WidgetTitle = apply_filters( 'widget_title', $Instance['title'] );

		echo $before_widget;

		if ( !empty( $WidgetTitle ) ) {
			echo $before_title . $WidgetTitle . $after_title;
		}

		echo $after_widget;
	}

	public function update( $NewInstance, $OldInstance ) {
		$Instance = array();
		$Instance['title'] = strip_tags( $NewInstance['title'] );

		return $Instance;
	}

	public function form( $Instance ) {
		$WidgetTitle = isset( $Instance['title'] ) ? $Instance['title'] : __( 'New Title', 'ivn-theme' );

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ivn-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $WidgetTitle ); ?>" />
		</p>
	<?php
	}
}

/**
 * @since  1.0
 * @link   http://codex.wordpress.org/Function_Reference/register_widget
 *
 * @return void
 */
function ivn_register_custom_widgets() {
	register_widget( 'IVN_Widget' );
}