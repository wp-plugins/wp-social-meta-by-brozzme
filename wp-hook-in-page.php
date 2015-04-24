<?php
/**
 * Created by PhpStorm.
 * User: Benoti
 * Date: 29/03/15
 * Time: 13:00
 *
 */


function list_hooked_functions($tag=false){

    global $wp_filter;

    $output ='';
    if ($tag) {
        $hook[$tag]=$wp_filter[$tag];
        if (!is_array($hook[$tag])) {
            trigger_error("Nothing found for '$tag' hook", E_USER_WARNING);
            return;
        }
    }
    else {
        $hook=$wp_filter;
        ksort($hook);
    }
    $output .= '<pre>';
    foreach($hook as $tag => $priority){
        $output .= "<br />&gt;&gt;&gt;&gt;&gt; <strong>$tag</strong><br />";
        ksort($priority);
        foreach($priority as $priority => $function){
            $output .= $priority .' ';
            foreach($function as $name => $properties) $output .= "$name<br />";
        }
    }
    $output .= '</pre>';
    return $output;
}

add_action( 'the_content', 'wphip_test', 5 );

function wphip_test($content){
    // you can choose to review all hook use in a page
    $content .= list_hooked_functions();
    // or just a particular hook
    // $content .= list_hooked_functions('wp_head');
    // $content .= list_hooked_functions('the_content');
    // $content .= list_hooked_functions('plugins_loaded');
    // $content .= list_hooked_functions('save_post');
    // $content .= list_hooked_functions('template_redirect');
    // $content .= list_hooked_functions('widgets_init');

    return $content;
}

// But you can use it in any page (front-end or admin)
// Just insert
// list_hooked_functions();
// anywhere in the body