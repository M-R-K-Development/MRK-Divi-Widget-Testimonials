<?php
/**
 *
 * MRK Divi Widget Testimonials Widget
 *
 */
class MRK_Divi_Widget_Testimonial extends DiviCustomWidget
{

    public function __construct($dir)
    {
        $this->config = array(
            'name' => 'MRK Testimonials Widget',
            'slug' => 'mrk_divi_widget_testimonials',
        );

        $this->addField(
                array(
                    'posts_per_page' => array(
                                'label'           => 'Number of testimonials displayed',
                                'type'            => 'text',
                                'description'     => 'Enter the amount of testimonial to display. Enter -1 to display all',
                                'default'         => 10,
                        ),
                )
        );

        $this->addField(
                array(
                    'display_category_selection' => array(
                        'label'             => 'Select by category',
                        'type'              => 'yes_no_button',
                        'description'       => 'Would you like to filter the posts by category',
                        'affects'           => array(
                                    '#et_pb_include_categories',
                                ),
                        ),
                )
        );

        $this->addField(array(
                 'include_categories' => array(
                    'label'           => esc_html__( 'Include from only these categories', 'et_builder' ),
                    'renderer'        => 'et_builder_include_custom_categories_option',
                    'render_options'  => array('term_name' => 'testimonial_category'),
                    'option_category' => 'basic_option',
                    'description'     => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
                    'depends_show_if' => 'on',
                ),
      ));

        $this->addField(
            array(
                'open_link_in_new_window' => array(
                    'label'             => 'Open link in a new window',
                    'type'              => 'yes_no_button',
                    'description'       => 'Open link in a new window.',
                    'default'           => 'off',
                    ),
            )
        );

        $this->addField(
            array(
                'background_color' => array(
                'label'           => __('Background Color', 'et_builder'),
                'type'            => 'color',
                'option_category' => 'basic_option',
                'description'     => __('Background Color', 'et_builder'),
                'default'         => '#f5f5f5',
                ),
            )
        );

        $this->addField(
            array(
            'text_alignment' => array(
                'label'           => esc_html__( 'Text alignment', 'et_builder' ),
                'type'            => 'select',
                'option_category' => 'configuration',
                'options'         => array(
                    'left'   => esc_html__( 'Left', 'et_builder' ),
                    'center' => esc_html__( 'Center', 'et_builder' ),
                    'right'  => esc_html__( 'Right', 'et_builder' ),
                ),
                'description'     => esc_html__( 'Here you can define the alignemnt of Text', 'et_builder' ),
                'default'         => 'left',
            ), )
        );

        $this->addField(array(
            'background_layout' => array(
                'label'           => esc_html__( 'Text Color', 'et_builder' ),
                'type'            => 'select',
                'option_category' => 'color_option',
                'options'         => array(
                    'light' => esc_html__( 'Dark', 'et_builder' ),
                    'dark'  => esc_html__( 'Light', 'et_builder' ),
                ),
                'default'     => 'dark',
                'description' => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
            ),

         ));

        $this->addField(
            array(
            'image_alignment' => array(
                'label'           => esc_html__( 'Portrait Image alignment', 'et_builder' ),
                'type'            => 'select',
                'option_category' => 'configuration',
                'options'         => array(
                    'left'   => esc_html__( 'Left', 'et_builder' ),
                    'center' => esc_html__( 'Center', 'et_builder' ),
                    'right'  => esc_html__( 'Right', 'et_builder' ),
                ),
                'description'     => esc_html__( 'Here you can define the alignment of Portrait Image', 'et_builder' ),
                'default'         => 'left',
            ), )
        );

        $this->addField(
                array(
                    'admin_label' => array(
                    'label'       => __('Admin Label', 'et_builder'),
                    'type'        => 'text',
                    'description' => __('This will change the label of the module in the builder for easy identification.', 'et_builder'),
                    ),
                )
            );

        parent::__construct($dir);
    }
}

new MRK_Divi_Widget_Testimonial($dir);
