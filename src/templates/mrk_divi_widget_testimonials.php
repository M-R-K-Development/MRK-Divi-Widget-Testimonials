<?php
        $post_type = 'testimonial';
        $taxonomy  = 'testimonial_category';

        // POST listing
        $args = array(
                'post_type'      => $post_type,
                'posts_per_page' => $posts_per_page,
                'orderby'        => 'post_date',
                'order'          => 'DESC',
                'offset'         => (int) $attr['posts_offset'],
        );

        if ($attr['display_category_selection'] == 'on') {
            if ( !is_null($attr['include_categories']) || $attr['include_categories'] ) {
                $included_terms         = explode( ',', $attr['include_categories'] );

                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'id',
                        'terms'    => $included_terms,
                        'operator' => 'IN',
                    ),
                );
            }
        }

        global $wp_query;
        $temp_query = $wp_query;
        $wp_query   = new WP_Query($args);
$output             = '';
$output             .= '[et_pb_slider admin_label="Testimonial Slider" show_arrows="off" show_pagination="on" auto="on" auto_speed="5000" auto_ignore_hover="off" parallax="off" parallax_method="off" remove_inner_shadow="on" background_position="default" background_size="default" hide_content_on_mobile="off" hide_cta_on_mobile="off" show_image_video_mobile="off" custom_button="off" button_letter_spacing="0" button_use_icon="default" button_icon_placement="right" button_on_hover="on" button_letter_spacing_hover="0" module_class="testimonial-slider mrk-testimonial-slider"]';

$i = 0;
while ($wp_query->have_posts()) {
    $wp_query->the_post();
    $output .= sprintf('[et_pb_slide background_position="default" background_size="default" background_color="%s" use_bg_overlay="off" use_text_overlay="off" alignment="center" background_layout="%s" allow_player_pause="off" text_border_radius="3" header_font_select="default" header_font="||||" body_font_select="default" body_font="||||" custom_button="off" button_font_select="default" button_font="||||" button_use_icon="default" button_icon_placement="right" button_on_hover="on" admin_title=""]', $background_color, $background_layout);

    $portrait_image = get_field('portrait_image');

    if (!$portrait_image) {
        $portrait_image['url'] = 'http://716eafb8bac0aa7b6feb-309c6f0fa0ca6ac25ad827f1e047dcb0.r4.cf1.rackcdn.com/avatar.png';
    }

    $output .= sprintf('<div class="et_pb_testimonial_portrait mrk_portrait_%s" style="background-image: url(\'%s\');"></div>', $image_alignment, $portrait_image['url']);
    $output .= sprintf('<p style="text-align: %s;">"%s"</p>', $text_alignment, get_the_content());

    if (!empty(get_field('author_or_company_url'))) {
        $target = '';

        if ($open_link_in_new_window == 'on') {
            $target = 'target="blank"';
        }

        $output .= sprintf('<p style="text-align: right;">- <a href="%s" %s>%s, %s</a></p>', get_field('author_or_company_url'), $target, get_field('author'),  get_field('company_name'));
    } else {
        $output .= sprintf('<p style="text-align: right;">- %s, %s</p>', get_field('author'), get_field('company_name'));
    }

    $output .= '[/et_pb_slide]';
}
$wp_query = $temp_query;

$output .= '[/et_pb_slider]';

echo do_shortcode($output );
