<?php
class Stylish_Price_List_Settings {
    public function __construct() { 
        add_action( 'admin_init', array($this,'admin_init') );
        add_action( 'admin_menu', array($this,'admin_menu'), 90 );
    }
    
    function admin_init()
    {

    }
    
    function checkbox($name, $options=array(),$current_value_arr=array())
    {
        ob_start();
?>
    <div class="checkbox">
    <?php foreach ($options as $value => $label): ?>
        <?php 
            $checked='';
            if(in_array($value,$current_value_arr) != false){//find the value
                $checked=' checked="checked"';
            }
         ?>
            <label>
                <input name="<?php echo $name . '[]'; ?>" type="checkbox" value="<?php echo $value; ?>" <?php echo $checked; ?>>
                <?php echo $label; ?>
            </label>
    <?php endforeach ?>
    </div>
<?php
        $html=ob_get_clean();
        return $html;
    }

    function select($name, $options=array(),$current_value='')
    {
        ob_start();
?>
<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="form-control">
    <?php foreach ($options as $value => $label): ?>
        <?php 
            $selected='';
            if($current_value==$value){
                $selected=' selected="selected"';
            }
         ?>
        <option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $label; ?></option>
    <?php endforeach ?>
</select>
<?php
        $html=ob_get_clean();
        return $html;
    }
    
    function option_page()
    {
?>
    <?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
    <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
    <?php } ?>
    <div class="wrap"><?php screen_icon(); ?>
    <h2>Stylish Price List Settings</h2>
    <form action="options.php" method="post" id=stylishpl-admin-options-form"> 
    <?php settings_fields('stylishpl_options'); ?>

    <p><input type="submit" name="submit" value="Save Settings" class="button button-primary" /></p>
    </form>
    </div>
<?php
    }

    function admin_menu()
    {
    add_management_page('Stylish Price List','Stylish Price List', 'manage_options', 'stylish_price_list_settings', array($this,'option_page'));
        // add_submenu_page( 'stylish_price_list', __( 'Settings', 'stylishpl' ), __( 'Settings', 'stylishpl' ), 'manage_options', 'stylish_price_list_settings', array( $this, 'option_page' ) );
    }
}
$stylish_price_list_settings = new Stylish_Price_List_Settings();
