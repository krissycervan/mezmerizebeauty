<?php

class Stylish_Price_List_Tabs {

    /**
     * Kick-in the class
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    /**
     * Add menu items
     *
     * @return void
     */
    public function admin_menu() {
          $icon_url = SPL_URL . '/assets/images/spl_icon.png';
        /** Top Menu **/
        add_menu_page( __( 'Stylish Price List', 'spl' ), __( 'Stylish Price List', 'spl' ), 'manage_options', 'spl-tabs', array( $this, 'plugin_page' ), $icon_url, 99 );

        add_submenu_page( 'spl-tabs', __( 'All Lists', 'spl' ), __( 'All Lists', 'spl' ), 'manage_options', 'spl-tabs', array( $this, 'plugin_page' ) );

        add_submenu_page( 'spl-tabs', __( 'Add New List', 'spl' ), __( 'Add New List', 'spl' ), 'manage_options', 'spl-tabs-new', array( $this, 'plugin_page_new' ) );
		
    }

    public function plugin_page_new() {
        $template = dirname( __FILE__ ) . '/views/tabs-new.php';
        if ( file_exists( $template ) ) {
            include $template;
        }
    }
	
    /**
     * Handles the plugin page
     *
     * @return void
     */
    public function plugin_page() {
        $action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : 'list';
        $id     = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        switch ($action) {
            case 'view':

                $template = dirname( __FILE__ ) . '/views/tabs-single.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/views/tabs-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/views/tabs-new.php';
                break;

            case 'readonly':
                $template = dirname( __FILE__ ) . '/views/tabs-readonly.php';
                break;
			
            case 'delete':
                $ids=isset( $_REQUEST['ids'] ) ? $_REQUEST['ids'] : null;
                if(!empty($ids)){
                    foreach ($ids as $key => $id) {
                        spl_delete_tabs_by_id($id);
                    }
                }else if(!empty($id)){
                    spl_delete_tabs_by_id($id);
                }
            default:
                $template = dirname( __FILE__ ) . '/views/tabs-list.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include $template;
        }
    }
}

new Stylish_Price_List_Tabs();