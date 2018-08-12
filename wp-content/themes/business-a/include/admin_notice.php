<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class BusinessA_notice_bord {

    function __construct(){
        add_action( 'admin_notices', array( &$this,'businessa_review_notice') );
        add_action( 'wp_ajax_businessa_dismiss_review', array(&$this,'businessa_dismiss_review') );
    }

    public function businessa_review_notice(){
        $review = get_option( 'businessa_review_data' );

        $time	= time();
        $load	= false;

        if ( ! $review ) {
            $review = array(
                'time' 		=> $time,
                'dismissed' => false
            );
            add_option('businessa_review_data', $review);
        } else {
            if ( (isset( $review['dismissed'] ) && ! $review['dismissed']) && (isset( $review['time'] ) && (($review['time'] + (DAY_IN_SECONDS * 4)) <= $time)) ) {
                $load = true;
            }
        }
        if ( ! $load ) {
            return;
        }
        ?>
        <div class="notice notice-success is-dismissible notice-box">

            <p style="font-size:16px;">'<?php _e( 'Hi !, We saw you have been using', 'business-a' ); ?> <strong><?php _e( 'Business A Pro Theme', 'business-a' ); ?></strong> <?php _e( 'from a few days and wanted to ask for your help to', 'business-a' ); ?> <strong><?php _e( 'make the theme better', 'business-a' ); ?></strong><?php _e( '.We just need a minute of your time to rate the theme. Thank you!', 'business-a' ); ?></p>
            <p style="font-size:16px;"><strong><?php _e( '~ webdzier', 'business-a' ); ?></strong></p>
            <p style="font-size:17px;">
                <a style="text-decoration: none;color: #fff;background: #ef4238;padding: 7px 10px; border-radius: 4px;" href="<?php echo esc_url('https://wordpress.org/support/theme/business-a/reviews/?filter=5');  ?>" class="businessa-dismiss-review-notice review-out" target="_blank" rel="noopener"><?php _e('Rate the theme','business-a') ?></a>&nbsp; &nbsp;
                <a style="text-decoration: none;color: #fff;background: #27d63c;padding: 7px 10px; border-radius: 4px;" href="#"  class="businessa-dismiss-review-notice rate-later" target="_self" rel="noopener"><?php _e( 'Nope, maybe later', 'business-a' ); ?></a>&nbsp; &nbsp;
                <a style="text-decoration: none;color: #fff;background: #31a3dd;padding: 7px 10px; border-radius: 4px;" href="#" class="businessa-dismiss-review-notice already-rated" target="_self" rel="noopener"><?php _e( 'I already did', 'business-a' ); ?></a>
            </p>
        </div>
        <script type="text/javascript">
            jQuery(function($){
                jQuery(document).on("click",'.businessa-dismiss-review-notice',function(){
                    if ( $(this).hasClass('review-out') ) {
                        var businessa_rate_data_val = "1";
                    }
                    if ( $(this).hasClass('rate-later') ) {
                        var businessa_rate_data_val =  "2";
                        event.preventDefault();
                    }
                    if ( $(this).hasClass('already-rated') ) {
                        var businessa_rate_data_val =  "3";
                        event.preventDefault();
                    }

                    $.post( ajaxurl, {
                        action: 'businessa_dismiss_review',
                        businessa_rate : businessa_rate_data_val
                    });

                    $('.notice-box').hide();
                });
            });
        </script>
        <?php
    }

    public function businessa_dismiss_review(){
        if ( ! $review ) {
            $review = array();
        }
        if($_POST['businessa_rate']=="1"){
            $review['time'] 	 = time();
            $review['dismissed'] = true;

        }
        if($_POST['businessa_rate']=="2"){
            $review['time'] 	 = time();
            $review['dismissed'] = false;

        }
        if($_POST['businessa_rate']=="3"){
            $review['time'] 	 = time();
            $review['dismissed'] = true;

        }
        update_option( 'businessa_review_data', $review );
        die;
    }
}