<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Business_a_Contactform_Info extends WP_Customize_Control {
	
	public function enqueue() {
		Business_a_Plugin_Install_Helper::instance()->enqueue_scripts();
	}

	public function render_content() {
		if ( defined( 'WPCF7_PLUGIN' ) ) {
			printf(
				esc_html__( 'You should be able to see the contact form in contact section on your front-page. You can configure settings from %s, in your WordPress dashboard.', 'business-a' ),
				sprintf( '<b>%s</b>', esc_html__( 'Contact > Add New', 'business-a' ) )
			);
		} else {
			printf(
				esc_html__( 'To access contact form in contact section in front page, you need to install the %s plugin.','business-a' ),
				esc_html( 'contact form 7' )
			);
			echo $this->create_plugin_install_button('contact-form-7');
		}
	}
	public function create_plugin_install_button( $slug ) {
		return Business_a_Plugin_Install_Helper::instance()->get_button_html( $slug );
	}
}
