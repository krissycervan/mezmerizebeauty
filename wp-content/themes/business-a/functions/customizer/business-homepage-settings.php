<?php 

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all categories in your wordpress site
 */
 class business_a_category_dropdown_custom_control extends WP_Customize_Control
 {
    private $cats = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->cats = get_categories($options);

        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->cats))
            {
                ?>
                    <label>
                      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
                           <?php
                                foreach ( $this->cats as $cat )
                                {
                                    printf('<option value="%s" %s>%s</option>', esc_attr( $cat->term_id ), selected( $this->value(), esc_attr( $cat->term_id ), false), esc_attr( $cat->name ) );
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
       }
 }
 
function business_a_slider_sanitize( $value ) {
    if ( ! in_array( $value, array( 'Uncategorized','category' ) ) )    
    return $value;
}
	
function business_a_homepage_settings_fucntion( $wp_customize ){

	/* FRONT PAGE */
	$wp_customize->add_panel( 'frontpage', array(
		'priority'       => 35,
		'capability'     => 'edit_theme_options',
		'title'      => __('FrontPage Sections', 'business-a' ),
	) );
	
	/* Woocommerce info section */
		$wp_customize->add_section( 'woocommerce_section' , array(
			'title'      => __('Woocommerce Recommended Plugin', 'business-a' ),
			'panel'  => 'frontpage',
		) );
			
			$wp_customize->add_setting(
				'businessa_woo_info', array(
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				new Business_a_Woocommerce_Info(
					$wp_customize, 'businessa_woo_info', array(
						'label' => esc_html__( 'Instructions', 'business-a' ),
						'section' => 'woocommerce_section',
						'capability' => 'install_plugins',
					)
				)
			);
	
	
		/* Slider Settings */
		$wp_customize->add_section( 'slider_section' , array(
			'title'      => __('Big Slider Section', 'business-a' ),
			'panel'  => 'frontpage',
			'description'=> 'Show your slider in your front page. First you setup your front page. <a target="_blank" href="'.admin_url('options-reading.php').'">Click Here!</a><p>Create a post ( <a target="_blank" href="'.admin_url('post-new.php').'">link</a> ) and assign it a category. and Choose a category from given below category setting.</p>',
		) );
	
			// slider enable
			$wp_customize->add_setting( 'business_option[slider_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[slider_enable]' , array(
			'label' => __('Enable Slider','business-a' ),
			'section' => 'slider_section',
			'type'=>'checkbox',
			) );
			
			// slider animation type
			$wp_customize->add_setting( 'business_option[slider_animation_type]' , array(
			'default'    => 'slide',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[slider_animation_type]' , array(
			'label' => __('Slider Effects','business-a' ),
			'section' => 'slider_section',
			'type'=>'select',
			'choices'=>array(
				'slide'=>'Slide',
				'fade'=>'Fade',
			),
			) );
			
			// slider speed
			$wp_customize->add_setting( 'business_option[slider_speed]' , array(
			'default'    => 3000,
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[slider_speed]' , array(
			'label' => __('Slider animation speed','business-a' ),
			'section' => 'slider_section',
			'type'=>'select',
			'choices'=>array(
				500 => 500,
				1000 => 1000,
				2000 => 2000,
				3000 => 3000,
				4000 => 4000,
				5000 => 5000,
				6000 => 6000,
				7000 => 7000,
				8000 => 8000,
				9000 => 9000,
				10000 => 10000,
			),
			) );
		
			// slider cat
			$wp_customize->add_setting('business_option[slider_cat]',array(
			'default' => 1,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'business_a_slider_sanitize',
			'type'=>'option',
			) );
			
			$wp_customize->add_control( new business_a_category_dropdown_custom_control( $wp_customize, 'business_option[slider_cat]', array(
			'label'   => __('Category','business-a' ),
			'section' => 'slider_section',
			'settings'   =>  'business_option[slider_cat]',
			) ) );
			
			
		/* Service Settings */
		$wp_customize->add_section( 'service_section' , array(
			'title'      => __('Service', 'business-a' ),
			'panel'  => 'frontpage',
			'description'=> 'Show your services in your front page. First you setup your front page. <a target="_blank" href="'.esc_url( admin_url('options-reading.php') ).'">Click Here!</a>',
		) );
			
			// service section enable/disable
			$wp_customize->add_setting( 'business_option[service_section_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[service_section_enable]' , array(
			'label' => __('Enable Service Section','business-a' ),
			'section' => 'service_section',
			'type'=>'checkbox',
			) );
		
			// service section title
			$wp_customize->add_setting( 'business_option[service_section_title]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[service_section_title]' , array(
			'label' => __('Service Section Title','business-a' ),
			'section' => 'service_section',
			'type'=>'text',
			) );
			
			// service section description
			$wp_customize->add_setting( 'business_option[service_section_description]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[service_section_description]' , array(
			'label' => __('Service Section Description','business-a' ),
			'section' => 'service_section',
			'type'=>'text',
			) );
			
			// service section background color
			$wp_customize->add_setting( 'business_option[service_section_backgorund_color]' , array(
			'default'    => '#ffffff',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_option[service_section_backgorund_color]' , array(
			'label' => __('Section Background Color','business-a' ),
			'section' => 'service_section',
			'settings'=>'business_option[service_section_backgorund_color]'
			) ) );
			
			// service section image
			$wp_customize->add_setting( 'business_option[service_section_image]' , array(
			'default' => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
			'type'=>'option'
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_option[service_section_image]' ,
			array(
			'label'          => __( 'Service Section Image', 'business-a' ),
			'description'=> __('Upload your background image minimum size ( 1600 x 900 ).','business-a'),
			'section'        => 'service_section',
		    ) )	);
			
			$wp_customize->add_setting( 'business_option[service_section_image_repeat]', array(
				'default'        => 'repeat',
				'sanitize_callback' => 'sanitize_text_field',
				'type'=>'option'
			) );
			$wp_customize->add_control(
				'business_option[service_section_image_repeat]', 
				array(
					'label'    => __( 'Background Repeat', 'business-a' ),
					'section'  => 'service_section',
					'settings' => 'business_option[service_section_image_repeat]',
					'type'     => 'select',
					'choices'  => array(
						'no-repeat'  => __('No Repeat','business-a'),
						'repeat'     => __('Tile','business-a'),
						'repeat-x'   => __('Tile Horizontally','business-a'),
						'repeat-y'   => __('Tile Vertically','business-a'),
					),
				)
			);

    if ( class_exists( 'Businessa_Repeater' ) ) {
        $wp_customize->add_setting(  'service_section_contents', array(
                'sanitize_callback' => 'businessa_repeater_sanitize',
                'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(   new Businessa_Repeater(  $wp_customize, 'service_section_contents', array(
                    'label'                                => esc_html__( 'Service Content', 'business-a' ),
                    'section'                              => 'service_section',
                    'add_field_label'                      => esc_html__( 'Add new Service', 'business-a' ),
                    'item_name'                            => esc_html__( 'Service', 'business-a' ),
                    'max_item' => 3,
                    'customizer_repeater_icon_control'  => true,
                    'customizer_repeater_title_control' => true,
                    'customizer_repeater_text_control'  => true,
                    'customizer_repeater_link_control'  => true,
                    'customizer_repeater_color_control' => false,
                )
            )
        );
    }
			
	if ( class_exists( 'woocommerce' ) ){

		/* shop Settings */
		$wp_customize->add_section( 'shop_sections' , array(
			'title'      => __('Shop', 'business-a' ),
			'panel'  => 'frontpage'
		) );

			// shop section enable/disable
			$wp_customize->add_setting( 'business_option[shop_section_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[shop_section_enable]' , array(
			'label' => __('Enable Shop Section','business-a' ),
			'section' => 'shop_sections',
			'type'=>'checkbox',
			) );
		
			// shop section title
			$wp_customize->add_setting( 'business_option[shop_section_title]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[shop_section_title]' , array(
			'label' => __('Section Title','business-a' ),
			'section' => 'shop_sections',
			'type'=>'text',
			) );
			
			// shop section description
			$wp_customize->add_setting( 'business_option[shop_section_description]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[shop_section_description]' , array(
			'label' => __('Section Subtitle','business-a' ),
			'section' => 'shop_sections',
			'type'=>'text',
			) );
			
			// shop no of show
			$wp_customize->add_setting( 'business_option[shop_no_of_show]' , array(
			'default'    => 4,
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[shop_no_of_show]' , array(
			'label' => __('Products No Of Show','business-a' ),
			'section' => 'shop_sections',
			'type'=>'number',
			) );
		
			// shop section background color
			$wp_customize->add_setting( 'business_option[shop_section_backgorund_color]' , array(
			'default'    => '#ffffff',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_option[shop_section_backgorund_color]' , array(
			'label' => __('Section Background Color','business-a' ),
			'section' => 'shop_sections',
			'settings'=>'business_option[shop_section_backgorund_color]'
			) ) );
			
			// Shop section image
			$wp_customize->add_setting( 'business_option[shop_section_image]' , array(
			'default' => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
			'type'=>'option'
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_option[shop_section_image]' ,
			array(
			'label'          => __( 'Shop Section Image', 'business-a' ),
			'section'        => 'shop_sections',
		    ) )	);
			
			$wp_customize->add_setting( 'business_option[shop_section_image_repeat]', array(
				'default'        => 'repeat',
				'sanitize_callback' => 'sanitize_text_field',
				'type'=>'option'
			) );
			$wp_customize->add_control(
				'business_option[shop_section_image_repeat]', 
				array(
					'label'    => __( 'Background Repeat', 'business-a' ),
					'section'  => 'shop_sections',
					'settings' => 'business_option[shop_section_image_repeat]',
					'type'     => 'select',
					'choices'  => array(
						'no-repeat'  => __('No Repeat','business-a'),
						'repeat'     => __('Tile','business-a'),
						'repeat-x'   => __('Tile Horizontally','business-a'),
						'repeat-y'   => __('Tile Vertically','business-a'),
					),
				)
			);
			
	}
	
	
		/* News Settings */
		$wp_customize->add_section( 'news_section' , array(
			'title'      => __('Blog', 'business-a' ),
			'panel'  => 'frontpage',
			'description'=> 'Show your latest news in your front page. First you setup your front page. <a target="_blank" href="'.esc_url( admin_url('options-reading.php') ).'">Click Here!</a> <p>If you want to access latest blogs in FrontPage. Please create a post and add a category in this post. And then select this category given below News Category setting.</p>',
		) );

			// news section enable/disable
			$wp_customize->add_setting( 'business_option[news_section_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[news_section_enable]' , array(
			'label' => __('Enable News Section','business-a' ),
			'section' => 'news_section',
			'type'=>'checkbox',
			) );
		
			// news section title
			$wp_customize->add_setting( 'business_option[news_section_title]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[news_section_title]' , array(
			'label' => __('News Section Title','business-a' ),
			'section' => 'news_section',
			'type'=>'text',
			) );
			
			// news section description
			$wp_customize->add_setting( 'business_option[news_section_description]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[news_section_description]' , array(
			'label' => __('News Section Description','business-a' ),
			'section' => 'news_section',
			'type'=>'text',
			) );
			
			// news no of show
			$wp_customize->add_setting( 'business_option[news_no_of_show]' , array(
			'default'    => 4,
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[news_no_of_show]' , array(
			'label' => __('News No Of Show','business-a' ),
			'section' => 'news_section',
			'type'=>'number',
			) );
			
			// news category show
			$wp_customize->add_setting( 'business_option[news_category_show]' , array(
			'default'    => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[news_category_show]' , array(
			'label' => __('News Category Show','business-a' ),
			'section' => 'news_section',
			'type'=>'select',
			'choices'=> business_a_get_post_category(),
			) );
		
			// news section background color
			$wp_customize->add_setting( 'business_option[news_section_backgorund_color]' , array(
			'default'    => '#3c3c3c',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_option[news_section_backgorund_color]' , array(
			'label' => __('Section Background Color','business-a' ),
			'section' => 'news_section',
			'settings'=>'business_option[news_section_backgorund_color]'
			) ) );
			
			// News section image
			$wp_customize->add_setting( 'business_option[news_section_image]' , array(
			'default' => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
			'type'=>'option'
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_option[news_section_image]' ,
			array(
			'label'          => __( 'News Section Image', 'business-a' ),
			'description'=> __('Upload your background image minimum size ( 1600 x 900 ).','business-a'),
			'section'        => 'news_section',
		    ) )	);
			
			$wp_customize->add_setting( 'business_option[news_section_image_repeat]', array(
				'default'        => 'repeat',
				'sanitize_callback' => 'sanitize_text_field',
				'type'=>'option'
			) );
			$wp_customize->add_control(
				'business_option[news_section_image_repeat]', 
				array(
					'label'    => __( 'Background Repeat', 'business-a' ),
					'section'  => 'news_section',
					'settings' => 'business_option[news_section_image_repeat]',
					'type'     => 'select',
					'choices'  => array(
						'no-repeat'  => __('No Repeat','business-a'),
						'repeat'     => __('Tile','business-a'),
						'repeat-x'   => __('Tile Horizontally','business-a'),
						'repeat-y'   => __('Tile Vertically','business-a'),
					),
				)
			);


    /* Team Settings */
    $wp_customize->add_section( 'team_section' , array(
        'title'      => __('Team', 'business-a'),
        'panel'  => 'frontpage'
    ) );
            $wp_customize->add_setting( 'business_option[team_section_enable]' , array(
                'default'    => true,
                'sanitize_callback' => 'sanitize_text_field',
                'type'=>'option'
            ));
            $wp_customize->add_control('business_option[team_section_enable]' , array(
                'label' => __('Enable Team Section','business-a'),
                'section' => 'team_section',
                'type'=>'checkbox',
            ) );

            $wp_customize->add_setting( 'business_option[team_section_title]' , array(
                'default'    => '',
                'sanitize_callback' => 'sanitize_text_field',
                'type'=>'option'
            ));
            $wp_customize->add_control('business_option[team_section_title]' , array(
                'label' => __('Section Title','business-a'),
                'section' => 'team_section',
                'type'=>'text',
            ) );
            $wp_customize->add_setting( 'business_option[team_section_description]' , array(
                'default'    => '',
                'sanitize_callback' => 'sanitize_text_field',
                'type'=>'option'
            ));
            $wp_customize->add_control('business_option[team_section_description]' , array(
                'label' => __('Section Subtitle','business-a'),
                'section' => 'team_section',
                'type'=>'textarea',
            ) );

            $wp_customize->add_setting( 'business_option[team_section_backgorund_color]' , array(
                'default'    => '#ffffff',
                'sanitize_callback' => 'sanitize_text_field',
                'type'=>'option'
            ));
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_option[team_section_backgorund_color]' , array(
                'label' => __('Background Color','business-a'),
                'section' => 'team_section',
                'settings'=>'business_option[team_section_backgorund_color]'
            ) ) );

            $wp_customize->add_setting( 'business_option[team_section_image]' , array(
                'default' => '',
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
                'type'=>'option'
            ) );
            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_option[team_section_image]' ,
                array(
                    'label'          => __( 'Background Image', 'business-a' ),
                    'section'        => 'team_section',
                ) )	);

        $wp_customize->add_setting( 'business_option[team_section_image_repeat]', array(
            'default'        => 'repeat',
            'sanitize_callback' => 'sanitize_text_field',
            'type'=>'option'
        ) );
        $wp_customize->add_control(
            'business_option[team_section_image_repeat]',
            array(
                'label'    => __( 'Background Repeat', 'business-a' ),
                'section'  => 'team_section',
                'settings' => 'business_option[team_section_image_repeat]',
                'type'     => 'select',
                'choices'  => array(
                    'no-repeat'  => __('No Repeat','business-a'),
                    'repeat'     => __('Tile','business-a'),
                    'repeat-x'   => __('Tile Horizontally','business-a'),
                    'repeat-y'   => __('Tile Vertically','business-a'),
                ),
            )
        );

        if ( class_exists( 'Businessa_Repeater' ) ) {
            $wp_customize->add_setting(  'team_section_contents', array(
                    'sanitize_callback' => 'businessa_repeater_sanitize',
                    'transport'         => 'postMessage',
                )
            );
            $wp_customize->add_control(   new Businessa_Repeater(  $wp_customize, 'team_section_contents', array(
                        'label'                                => esc_html__( 'Team Content', 'business-a' ),
                        'section'                              => 'team_section',
                        'add_field_label'                      => esc_html__( 'Add new Team Member', 'business-a' ),
                        'item_name'                            => esc_html__( 'Team Member', 'business-a' ),
                        'max_item' => 3,
                        'customizer_repeater_image_control'    => true,
                        'customizer_repeater_title_control'    => true,
                        'customizer_repeater_subtitle_control' => true,
                        'customizer_repeater_text_control'     => true,
                        'customizer_repeater_link_control'     => true,
                        'customizer_repeater_repeater_control' => false,
                    )
                )
            );
        }

        /* Testimonial Settings */
        $wp_customize->add_section( 'testimonial_section' , array(
            'title'      => __('Testimonial', 'business-a'),
            'panel'  => 'frontpage'
        ) );

            $wp_customize->add_setting( 'business_option[testimonial_section_enable]' , array(
                'default'    => true,
                'sanitize_callback' => 'sanitize_text_field',
                'type'=>'option'
            ));
            $wp_customize->add_control('business_option[testimonial_section_enable]' , array(
                'label' => __('Enable Testimonial Section','business-a'),
                'section' => 'testimonial_section',
                'type'=>'checkbox',
            ) );

            $wp_customize->add_setting( 'business_option[testimonial_section_title]' , array(
                'default'    => '',
                'sanitize_callback' => 'sanitize_text_field',
                'type'=>'option'
            ));
            $wp_customize->add_control('business_option[testimonial_section_title]' , array(
                'label' => __('Section Title','business-a'),
                'section' => 'testimonial_section',
                'type'=>'text',
            ) );
            $wp_customize->add_setting( 'business_option[testimonial_section_description]' , array(
                'default'    => '',
                'sanitize_callback' => 'sanitize_text_field',
                'type'=>'option'
            ));
            $wp_customize->add_control('business_option[testimonial_section_description]' , array(
                'label' => __('Section Subtitle','business-a'),
                'section' => 'testimonial_section',
                'type'=>'textarea',
            ) );
            $wp_customize->add_setting( 'business_option[testimonial_section_backgorund_color]' , array(
                'default'    => '#ffffff',
                'sanitize_callback' => 'sanitize_text_field',
                'type'=>'option'
            ));
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_option[testimonial_section_backgorund_color]' , array(
                'label' => __('Background Color','business-a'),
                'section' => 'testimonial_section',
                'settings'=>'business_option[testimonial_section_backgorund_color]'
            ) ) );
            $wp_customize->add_setting( 'business_option[testimonial_section_image]' , array(
                'default' => '',
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
                'type'=>'option'
            ) );
            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_option[testimonial_section_image]' ,
                array(
                    'label'          => __( 'Background Image', 'business-a' ),
                    'section'        => 'testimonial_section',
                ) )	);
            $wp_customize->add_setting( 'business_option[testimonial_section_image_repeat]', array(
                'default'        => 'repeat',
                'sanitize_callback' => 'sanitize_text_field',
                'type'=>'option'
            ) );
            $wp_customize->add_control(
                'business_option[testimonial_section_image_repeat]',
                array(
                    'label'    => __( 'Background Repeat', 'business-a' ),
                    'section'  => 'testimonial_section',
                    'settings' => 'business_option[testimonial_section_image_repeat]',
                    'type'     => 'select',
                    'choices'  => array(
                        'no-repeat'  => __('No Repeat','business-a'),
                        'repeat'     => __('Tile','business-a'),
                        'repeat-x'   => __('Tile Horizontally','business-a'),
                        'repeat-y'   => __('Tile Vertically','business-a'),
                    ),
                )
            );

            if ( class_exists( 'Businessa_Repeater' ) ) {
                $wp_customize->add_setting(  'testimonial_section_contents', array(
                        'sanitize_callback' => 'businessa_repeater_sanitize',
                        'transport'         => 'postMessage',
                    )
                );
                $wp_customize->add_control(   new Businessa_Repeater(  $wp_customize, 'testimonial_section_contents', array(
                            'label'                                => esc_html__( 'Testimonial Content', 'business-a' ),
                            'section'                              => 'testimonial_section',
                            'add_field_label'                      => esc_html__( 'Add new Testimonial', 'business-a' ),
                            'item_name'                            => esc_html__( 'Testimonial', 'business-a' ),
                            'max_item' => 3,
                            'customizer_repeater_image_control'    => true,
                            'customizer_repeater_title_control'    => true,
                            'customizer_repeater_subtitle_control' => true,
                            'customizer_repeater_text_control'     => true,
                            'customizer_repeater_link_control'     => true,
                            'customizer_repeater_repeater_control' => false,
                        )
                    )
                );
            }

		/* Contact Settings */
		$wp_customize->add_section( 'contact_section' , array(
			'title'      => __('Contact', 'business-a' ),
			'panel'  => 'frontpage',
			'description'=> 'Show your contact information in your front page. First you setup your front page. <a target="_blank" href="'.esc_url( admin_url('options-reading.php') ).'">Click Here!</a><p>To add your contact form. Please install Contact Form 7 plugin. And copy contact form shortcode and add this shorcode given below Contact Form 7 Shortcode settings.</p>',
		) );
			
			// Contact section enable/disable
			$wp_customize->add_setting( 'business_option[contact_section_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[contact_section_enable]' , array(
			'label' => __('Enable Contact Section', 'business-a'),
			'section' => 'contact_section',
			'type'=>'checkbox',
			) );
		
			// Contact section title
			$wp_customize->add_setting( 'business_option[contact_section_title]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[contact_section_title]' , array(
			'label' => __('Contact Section Title', 'business-a'),
			'section' => 'contact_section',
			'type'=>'text',
			) );
			
			// Contact section description
			$wp_customize->add_setting( 'business_option[contact_section_description]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[contact_section_description]' , array(
			'label' => __('Contact Section Description', 'business-a'),
			'section' => 'contact_section',
			'type'=>'text',
			) );
			
			/* Contact Form & info section */			
			$wp_customize->add_setting(
				'businessa_contactform_info', array(
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				new Business_a_Contactform_Info(
					$wp_customize, 'businessa_contactform_info', array(
						'label' => esc_html__( 'Instructions', 'business-a' ),
						'section' => 'contact_section',
						'capability' => 'install_plugins',
					)
				)
			);
			
			$wp_customize->add_setting( 'business_option[contact_contactform_shortcode]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));
			$wp_customize->add_control('business_option[contact_contactform_shortcode]' , array(
			'label' => __('Contact Form 7 Shortcode:', 'business-a'),
			'section' => 'contact_section',
			'type'=>'textarea',
			) );
}
add_action( 'customize_register', 'business_a_homepage_settings_fucntion' );

function business_a_get_post_category(){
	$cats = get_categories();
	$arr = array();
	foreach($cats as $cat){
		$arr[$cat->term_id] = $cat->name;
	}
	return $arr;
}


/**
 * Sanitize repeater control.
 */
function businessa_repeater_sanitize( $input ) {
    $input_decoded = json_decode( $input,true );

    if ( ! empty( $input_decoded ) ) {
        foreach ( $input_decoded as $boxk => $box ) {
            foreach ( $box as $key => $value ) {

                $input_decoded[ $boxk ][ $key ] = wp_kses_post( force_balance_tags( $value ) );

            }
        }
        return json_encode( $input_decoded );
    }
    return $input;
}