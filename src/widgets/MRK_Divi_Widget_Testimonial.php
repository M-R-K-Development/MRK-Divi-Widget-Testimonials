<?php
/**
 *
 * MRK Divi Widget Testimonials Widget
 *
 */
class MRK_Divi_Widget_Testimonial extends ET_Builder_Module
{
    public $name = 'MRK Testimonials Widget';
    public $slug = 'mrk_divi_widget_testimonials';
    public $fields;

    public function __construct()
    {
        $this->setup();
        parent::__construct();
    }

    public function setup()
    {
        $this->_init_fields();
    }

    private function _init_fields()
    {
        $this->fields = array();

        $this->fields['posts_per_page'] = array(
                                'label'           => 'Number of testimonials displayed',
                                'type'            => 'text',
                                'description'     => 'Enter the amount of testimonial to display. Enter -1 to display all',
                                'default'         => 10,
        );

        $this->fields['display_category_selection'] = array(
                        'label'                           => 'Select by category',
                        'type'                            => 'yes_no_button',
                                                'options' => array(
                            'off' => __( "No", 'et_builder' ),
                            'on'  => __( 'Yes', 'et_builder' ),
                        ),

                        'description'       => 'Would you like to filter the posts by category',
                        'affects'           => array(
                                    '#et_pb_include_categories',
                                ),
        );

        $this->fields['include_categories'] = array(
                    'label'           => esc_html__( 'Include from only these categories', 'et_builder' ),
                    'renderer'        => 'et_builder_include_testimonial_categories_option',
                    'render_options'  => array('term_name' => 'testimonial_category'),
                    'option_category' => 'basic_option',
                    'description'     => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
                    'depends_show_if' => 'on',
      );

        $this->fields['open_link_in_new_window'] = array(
                    'label'                           => 'Open link in a new window',
                    'type'                            => 'yes_no_button',
                                            'options' => array(
                            'off' => __( "No", 'et_builder' ),
                            'on'  => __( 'Yes', 'et_builder' ),
                        ),

                    'description'       => 'Open link in a new window.',
                    'default'           => 'off',
        );

        $this->fields['background_color'] = array(
                'label'           => __('Background Color', 'et_builder'),
                'type'            => 'color',
                'option_category' => 'basic_option',
                'description'     => __('Background Color', 'et_builder'),
                'default'         => '#f5f5f5',
        );

        $this->fields['text_alignment'] = array(
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
        );

        $this->fields['background_layout'] = array(
                'label'           => esc_html__( 'Text Color', 'et_builder' ),
                'type'            => 'select',
                'option_category' => 'color_option',
                'options'         => array(
                    'light' => esc_html__( 'Dark', 'et_builder' ),
                    'dark'  => esc_html__( 'Light', 'et_builder' ),
                ),
                'default'     => 'dark',
                'description' => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
            );

        $this->fields['image_alignment'] = array(
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
        );

        $this->fields['admin_label'] = array(
                    'label'       => __('Admin Label', 'et_builder'),
                    'type'        => 'text',
                    'description' => __('This will change the label of the module in the builder for easy identification.', 'et_builder'),
            );
    }

    public function init()
    {
        $this->whitelisted_fields = array_keys($this->fields);

        /*
         * Prefix the slug with et_pb
         */
        if (strpos($this->slug, 'et_pb_') !== 0) {
            $this->slug = 'et_pb_'.$this->slug;
        }

        $defaults = array();

        foreach ($this->fields as $field => $options) {
            if (isset($options['default'])) {
                $defaults[$field] = $options['default'];
            }
        }

        $this->field_defaults = $defaults;
    }

    /**
     * Get Fields
     *
     * @return [type] [description]
     */
    public function get_fields()
    {
        return $this->fields;
    }

    public function shortcode_callback($atts, $content = null, $function_name)
    {
        extract($atts);
        ob_start();
        require MRK_TESTIMONIAL_DIVI_WIDGET_DIR . '/src/templates/mrk_divi_widget_testimonials.php';

        return ob_get_clean();
    }
}

new MRK_Divi_Widget_Testimonial();
