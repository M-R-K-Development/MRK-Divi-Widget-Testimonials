<?php

class MRK_Divi_Widget_Testimonial_Post_Type_Activate{

    public static function activate(){
        custom_post_type_testimonials();
        flush_rewrite_rules();
    }

}
