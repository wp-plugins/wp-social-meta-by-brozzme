<?php
/*
Plugin Name: wp social meta brozzme
Plugin Script: wp-social-meta-brozzme.php
Plugin URI: http://brozzme.com/wp-social-meta/
Description: Add social meta in header
Version: 0.1
License: GPL
Author: Benoît Faure - Benoti
Author URI: http://brozzme.com
* Domain Path: /languages
* Text Domain: wp-social-meta-brozzme
* GitHub Plugin URI: https://github.com/Benoti/wp-social-meta-brozzme
* GitHub Branch: master
*
* Settings options 1: wp_smb_general_settings
* Settings options 2: wp_smb_options_settings
*
=== RELEASE NOTES ===
2015-03-27 - v1.0 - first version
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Online: http://www.gnu.org/licenses/gpl.txt
*/


//ini_set('display_errors', 1);
defined( 'ABSPATH' ) OR exit;

(@__DIR__ == '__DIR__') && define('__DIR__', realpath(dirname(__FILE__)));

define("WPSMBPATH", __FILE__)  ;

require_once( __DIR__ .'/includes/wpsmb_options.php' );
require_once( __DIR__ .'/includes/wp_smb_functions.php' );

register_activation_hook(   __FILE__, 'wp_smb_plugin_activation' );
register_deactivation_hook( __FILE__, 'wp_smb_plugin_deactivation' );
register_uninstall_hook( __DIR__ .'/uninstall.php', 'wp_smb_plugin_uninstall' );


function wp_smb_plugin_activation(){
    if(!get_option('wp_smb_general_settings')) {
        $options = array(
            'wpsmb_enable'=> 'true', // set to 1 to enable plugin

            'wpsmb_site_name'   => get_bloginfo('name'),
            'wpsmb_default_image'   => '',
            'wpsmb_embed_meta_on_all'=>'true',
            'wpsmb_embed_images_array'  =>'false',

            );

        add_option('wp_smb_general_settings', $options);
    }
    if(!get_option('wp_smb_options_settings')) {
        $options = array(
            'wpsmb_enable_on_products'=> 'true',
            'wpsmb_image_to_show'   => 'featured', // default, first, featured
            'wpsmb_excerpt_lengh'  => 140,
            'wpsmb_base_description'    => ''
             );

        add_option('wp_smb_options_settings', $options);
    }
    if(!get_option('wp_smb_fb_settings')) {
        $options = array(
            'wpsmb_enable_fb'=> 'true',
            'wpsmb_fb_user_id'=> '',
            'wpsmb_fb_app_id'   => '',
           // 'wpsmb_fb_sdk_load' => 'false'

        );

        add_option('wp_smb_fb_settings', $options);
    }
    if(!get_option('wp_smb_gplus_settings')) {
        $options = array(
            'wpsmb_enable_gplus'=> 'true',
            'wpsmb_gplus_user_id'   => '',
            'wpsmb_gplus_rel'      => 'publisher' // author, publisher
        );

        add_option('wp_smb_gplus_settings', $options);
    }
    if(!get_option('wp_smb_twitter_settings')) {
        $options = array(
            'wpsmb_enable_twitter'=> 'true',
            'wpsmb_twitter_user_id'   => '',
            'wpsmb_twitter_card_type'      => 'publisher' // author, publisher
        );

        add_option('wp_smb_twitter_settings', $options);
    }
}

function wp_smb_plugin_deactivation(){
    //$option = get_option('wp_smb_general_settings');

    $options_names = array('wp_smb_general_settings', 'wp_smb_options_settings', 'wp_smb_fb_settings', 'wp_smb_gplus_settings', 'wp_smb_twitter_settings');

    foreach($options_names as $option_name){
        delete_option($option_name);
    }
}

// add menu for configuration

add_action( 'admin_menu', 'wp_smb_add_admin_menu' );

function wp_smb_add_admin_menu(  ) {

    add_options_page('Social meta', __('Social meta', 'wp-social-meta-brozzme'), 'manage_options', 'wp-smb-options', 'wpsmb_options_page');

}

add_action( 'plugins_loaded', 'wp_smb_load_textdomain' );

/**
 * Load plugin textdomain.
 */
function wp_smb_load_textdomain() {
    load_plugin_textdomain( 'wp-social-meta-brozzme', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

// ----------------------------------------------------------------------------
// ADMIN FUNCTIONS
function wpsmb_wpmut_admin_scripts()
{
    if (isset($_GET['page']) && $_GET['page'] == 'wp-smb-options')
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_register_script('default-upload', plugins_url('/js/wpsmb-media_upload.js', __FILE__), array('jquery','media-upload','thickbox'));
        wp_enqueue_script('default-upload');
    }
}

function wpsmb_wpmut_admin_styles()
{
    if (isset($_GET['page']) && $_GET['page'] == 'wp-smb-options')
    {
        wp_enqueue_style('thickbox');
    }
}
add_action('admin_print_scripts', 'wpsmb_wpmut_admin_scripts');
add_action('admin_print_styles', 'wpsmb_wpmut_admin_styles');

// ----------------------------------------------------------------------------
// g11n OPTIONS
// ----------------------------------------------------------------------------
function wpsmb_globalize_options(){
    $option = array();
    $option_names =  array(
        'wp_smb_general_settings', 'wp_smb_options_settings', 'wp_smb_fb_settings', 'wp_smb_gplus_settings', 'wp_smb_twitter_settings'
    );
    foreach($option_names as $option_name){
        $option += get_option($option_name);
    }

    return $option;

}
// ----------------------------------------------------------------------------
// Adding the Open Graph in the Language Attributes
// ----------------------------------------------------------------------------
function wpsmb_add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'wpsmb_add_opengraph_doctype');

// Lets add Open Graph Meta Info
add_action( 'wp_head', 'wpsmb_insert_fb_in_head', 5 );

function wpsmb_insert_fb_in_head() {
    $options = wpsmb_globalize_options();
    global $post;
    global $wp_query;
    global $main_post_id;

    global $wp;
    $url= '';
    $current_url = home_url(add_query_arg(array(),$wp->request)).'/';
    if($options['wpsmb_embed_meta_on_all']=='false')
        if ( !is_singular())
        return;

    $type = wpsmb_return_page_type();

    if($type == 'post'){
        $main_post_id = $wp_query->post->ID;

        $thumbs_array = wpsmb_images_array($main_post_id);

        $title = get_the_title($main_post_id);
        $description = wpsmb_excerpt_max_charlength($main_post_id, $options['wpsmb_excerpt_lengh']);

    }
    elseif($type == 'home'){
        $main_post_id = '';
        $title = get_bloginfo('name');
        $description = get_bloginfo('description');
        $thumbs_array = wpsmb_home_images_array();

    }

    else{

        if($type == 'cpt-archive'){

            $main_post_id = get_query_var('post_type');
            $title = post_type_archive_title( '', false );

            $description = term_description();
            if($description != '' ){
                $description = trim(strip_tags($description));
            }
            $thumbs_array = wpsmb_archives_images_array();

        }
        else{
            $main_post_id = get_query_var('cat');
            $title = single_cat_title( '', false );
            $thumbs_array = wpsmb_archives_images_array();

            $description = term_description();
            if($description != '' ){
                $description = trim(strip_tags($description));
            }

        }

    }


    if($description == ''){
        $description = trim($options['wpsmb_base_description']);
    }

    if($url == ''){
        $url = $current_url;
    }
    if($thumbs_array == ''){

        $default_thumb = $options['wpsmb_default_image']; // url that's all
        $thumb_size = getimagesize($default_thumb); // [0] largeur [1] hauteur

        $thumbs_array[] = array($default_thumb, $thumb_size[0], $thumb_size[1]);

    }

    echo '<meta property="og:title" content="' . $title . '"/>
';
    echo '<meta property="og:description" content="' . $description . '" />
';
    echo '<meta property="og:type" content="'. wp_smb_post_type_checker($wp_query->post->post_type) .'"/>
';
    echo '<meta property="og:url" content="' . $url . '"/>
';
    echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '"/>
';
    echo '<meta property="og:locale" content="'.get_locale().'" />
';


    if($options['wpsmb_enable_fb']=='true') {

            if($options['wpsmb_fb_app_id']!=''){
                echo '<meta property="fb:app_id" content="'.$options['wpsmb_fb_app_id'].'"/>
';
            }
            if($options['wpsmb_fb_user_id']!='' && $options['wpsmb_fb_app_id']==''){
                echo '<meta property="fb:admins" content="'.$options['wpsmb_fb_user_id'].'"/>
';
            }

        if ($options['wpsmb_image_to_show'] == 'featured') {


            if (has_post_thumbnail($main_post_id)) {
                $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($main_post_id), 'medium');
                echo '<!-- featured image -->
';
                echo '<meta property="og:image" content="' . esc_attr($thumbnail_src[0]) . '"/>
';
                echo '<meta property="og:image:width" content="' . esc_attr($thumbnail_src[1]) . '"/>
';
                echo '<meta property="og:image:height" content="' . esc_attr($thumbnail_src[2]) . '"/>
';

            } else {
                //the post does not have featured image, use a default image
                $default_image = $options['wpsmb_default_image'];
                echo '<!-- default image : there is no featured image for this '.$type.' -->
';
                echo '<meta property="og:image" content="' . $default_image . '"/>
';
            }

        }

        if ($options['wpsmb_image_to_show'] == 'first' || $options['wpsmb_embed_images_array']=='true') {
            if (has_post_thumbnail($main_post_id) || $thumbs_array!='') {
                echo '<!-- image(s) in post : '.$type.' -->
';
                $i = 0;

                foreach ($thumbs_array as $thumb_src) {
                    if($thumb_src !=''){


                        echo '<meta property="og:image" content="' . esc_attr($thumb_src[0]) . '"/>
';
                        echo '<meta property="og:image:width" content="' . esc_attr($thumb_src[1]) . '"/>
';
                        echo '<meta property="og:image:height" content="' . esc_attr($thumb_src[2]) . '"/>
';
                        echo "
";
                    if ($options['wpsmb_embed_images_array'] != 'true') {
                        if (++$i > 0) break;
                    }
                    }
                }
            }
            else{
                $default_image = $options['wpsmb_default_image'];
                echo '<!-- default image: no featured image -->
';
                echo '<meta property="og:image" content="' . $default_image . '"/>
';
            }


        }
    }

    if($options['wpsmb_enable_gplus']=='true'){

        if($options['wpsmb_gplus_user_id']!=''){
                echo '<link rel=”'.$options['wpsmb_gplus_rel'].'” href=”https://plus.google.com/'.$options['wpsmb_gplus_user_id'].'“/>
                ';
        }

    }

    if($options['wpsmb_enable_twitter']=='true'){

        echo '<meta name="twitter:card" content="' . $options['wpsmb_twitter_card_type'] . '"/>
            ';

        if($options['wpsmb_twitter_user_id']!=''){
            echo '<meta name="twitter:site" content="' . $options['wpsmb_twitter_user_id'] . '"/>
            ';
            echo '<meta name="twitter:creator" content="' . $options['wpsmb_twitter_user_id'] . '"/>
            ';
        }

       echo '<meta name="twitter:title" content="' . get_the_title($main_post_id) . '" />
             <meta name="twitter:description" content="' . $description . '" />

            ';

        if ($options['wpsmb_image_to_show'] == 'featured') {


            if (!has_post_thumbnail($main_post_id)) { //the post does not have featured image, use a default image
                $default_image = $options['wpsmb_default_image']; //replace this with a default image on your server or an image in your media library
                echo '<!-- default image -->
';
                echo '<meta name="twitter:image" content="' . $default_image . '"/>
';
            } else {
                $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($main_post_id), 'medium');
                echo '<!-- featured image -->
';
                echo '<meta name="twitter:image" content="' . esc_attr($thumbnail_src[0]) . '"/>
';
                echo '<meta name="twitter:image:width" content="' . esc_attr($thumbnail_src[1]) . '"/>
';
                echo '<meta name="twitter:image:height" content="' . esc_attr($thumbnail_src[2]) . '"/>
';
            }

        }
        if($options['wpsmb_image_to_show']== 'first' || $options['wpsmb_embed_images_array']=='true' || $options['wpsmb_twitter_card_type']=='gallery'){


            if(!has_post_thumbnail( $main_post_id ) || $thumbs_array=='') { //the post does not have featured image, use a default image
                $default_image = $options['wpsmb_default_image']; //replace this with a default image on your server or an image in your media library
                echo '<!-- default image -->
';
                echo '<meta name="twitter:image" content="' . $default_image . '"/>
';
            }
            else{
                echo '<!-- twitter-card:'.$options['wpsmb_twitter_card_type'].' -->
';
                if($options['wpsmb_embed_images_array']== 'true'){ $i=0;}
                else{ $i='';}

                foreach($thumbs_array as $thumb_src){
                    echo '<meta name="twitter:image'.$i.'" content="' . esc_attr( $thumb_src[0] ) . '"/>
';
                    echo '<meta name="twitter:image'.$i.':width" content="' . esc_attr( $thumb_src[1] ) . '"/>
';
                    echo '<meta name="twitter:image'.$i.':height" content="' . esc_attr( $thumb_src[2] ) . '"/>
';
                    echo "
";
                    if($options['wpsmb_embed_images_array']!='true' || $options['wpsmb_twitter_card_type']!='gallery') {
                        if (++$i > 0) break;
                    }

                }
            }

        }

    }

    echo "
";

}



// ----------------------------------------------------------------------------
// test
// ----------------------------------------------------------------------------
add_filter( 'wp_head', 'wpsmb_test', 5 );

function wpsmb_test($content){
   // $content = wpsmb_wp_page_data();
    //$content .= list_hooked_functions('wp_head');


   // var_dump( $content );
}

// ----------------------------------------------------------------------------
// clean data
// ----------------------------------------------------------------------------
add_action('init', 'wpsmb_clean_head');

function wpsmb_clean_head(){

    remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version

    //remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
    remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
    remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
    remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
    remove_action('wp_head', 'index_rel_link'); // index link
    remove_action('wp_head', 'wp_shortlink_wp_head'); // index link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
    remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Display relational links for the posts adjacent to the current post.

    add_action('wp_head', 'wpsmb_addPostFeed');
}

function wpsmb_addPostFeed() {
    echo '<link rel="alternate" type="application/rss+xml" title="RSS 2.0 Feed" href="'.get_bloginfo('rss2_url').'" />';
}

// ----------------------------------------------------------------------------
// Page type checker
// ----------------------------------------------------------------------------
function wpsmb_wp_page_data(){
    $options = wpsmb_globalize_options();
    // where we can embed
    // array(single, page, front-page, home, single-cpt, archive-cpt, category, taxonomy, tag);
    // type=>'post', title=>'', description=>'', image=>''
    $output = '';
    $post_type = get_post_type();
    if(is_singular()){

        $output .= get_post_type();

    }
    if(is_home() || is_front_page()){

        $site_title = get_bloginfo('name');
        $site_description = get_bloginfo('description');

        $output .= 'front page / '.$site_title.' / '.$site_description.' / '.$post_type;
        $output .= array($post_type, $site_title, $site_description);

    }
    if(is_category() || is_tax() || is_tag()){
        $category = single_cat_title( '', false );
        // try to retrieve category... description
        $category_description = term_description();
        if($category_description != '' ){
            $category_description = strip_tags($category_description);
        }
        else{
            $category_description = $options['wpsmb_base_description'];
        }

        $images_archive_array = wpsmb_archives_images_array();

        $output .= 'categorie, taxonomie ou tag / '.$category.' / '.$category_description.' / '.$post_type;

        foreach($images_archive_array as $meta){
            $output .= '<meta property="og:image" content="' . esc_attr($meta[0]) . '"/>
';
            $output .= '<meta property="og:image:width" content="' . esc_attr($meta[1]) . '"/>
';
            $output .= '<meta property="og:image:height" content="' . esc_attr($meta[2]) . '"/>';
        }


    }
    if(is_post_type_archive()){
        $category = post_type_archive_title( '', false );

        $category_description = term_description();
        if($category_description != '' ){
        $category_description = strip_tags($category_description);
        }
        else{
            $category_description = $options['wpsmb_base_description'];
        }
        $images_archive_array = wpsmb_archives_images_array();

        $output .= 'post-type archive / '.$category.' / '.$category_description.' / '.$post_type;

        foreach($images_archive_array as $meta){
            $output .= '<meta property="og:image" content="' . esc_attr($meta[0]) . '"/>
';
            $output .= '<meta property="og:image:width" content="' . esc_attr($meta[1]) . '"/>
';
            $output .= '<meta property="og:image:height" content="' . esc_attr($meta[2]) . '"/>';
        }
    }

    return $output;

}

function wpsmb_return_page_type(){

    if(is_singular()){
        $type = 'post';
    }
    if(is_home() || is_front_page()){
        $type = 'home';
    }
    if(is_category() || is_tax() || is_tag()){
        $type = 'archive';
    }
    if(is_post_type_archive()){
        $type = 'cpt-archive';
    }
    return $type;
}