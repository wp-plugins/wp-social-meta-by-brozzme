<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27/03/15
 * Time: 14:25
 */


function wpsmb_retrieve_post_thumb(){


}

function wpsmb_image_set(){


}

function wpsmb_retrieve_datas(){



}
// compose excerpt description
//wpsmb_excerpt_max_charlength(140);

function wpsmb_excerpt_max_charlength($post_id, $charlength) {
    $output = '';
    $excerpt = wpsmbget_the_excerpt( $post_id );
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            $output .=  mb_substr( $subex, 0, $excut );
        } else {
            $output .=  $subex;
        }
        $output .=  '...';
    } else {
        $output .=  $excerpt;
    }
    return $output;

}
function wpsmbget_the_excerpt( $post_id )
{

    global $post;
    $save_post = $post;
    $post = get_post($post_id);
    setup_postdata($post); // hello
    $output = get_the_excerpt();
    $post = $save_post;
    return $output;
}

function wpsmb_post_first_image( $postID ) {
    $args = array(
        'numberposts' => 1,
        'order' => 'ASC',
        'post_mime_type' => 'image',
        'post_parent' => $postID,
        'post_status' => null,
        'post_type' => 'attachment',
    );

    $attachments = get_children( $args );

    if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
            $image_attributes = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' )  ? wp_get_attachment_image_src( $attachment->ID, 'thumbnail' ) : wp_get_attachment_image_src( $attachment->ID, 'full' );

           // echo '<img src="' . wp_get_attachment_thumb_url( $attachment->ID ) . '" class="current">';
            return wp_get_attachment_thumb_url( $attachment->ID );
        }
    }
}

function wp_smb_post_type_checker($post_type){

    $type_og_type = array(
        'post'=>'article',
        'product'=>'product',
        'store'=>'business.business',
        'page'=>'article',
        'place'=>'place'
        );
    $type = array(
        'post',
        'product',
        'store',
        'page',
        'place'
    );
    if(is_category() || is_tax() || is_tag()){
        $output='article';
    }
    else {
        if (in_array($post_type, $type)) {
            $output = $type_og_type[$post_type];
        } else {

            $output = 'website';

        }
    }
    return $output;
}

//

function wpsmb_images_array($post_id){

    $version = get_bloginfo('version');
    if(isset($post_id)!=''){
        // backward compatibility for get_attached_media function who was introduce in WordPress 3.6
        if ($version < 3.6) {
            $post_details = get_children( array( 'post_parent' => $post_id ) );
        } else {
            $post_details = get_attached_media( 'image', $post_id );
        }

        $images_array = '';
        foreach($post_details as $attachment){
            $image_attributes = wp_get_attachment_image_src( $attachment->ID, 'medium', 'false' );

            if( $image_attributes ) {
                $images_array[$attachment->ID] = array($image_attributes[0], $image_attributes[1], $image_attributes[2]);

            }
        }

    }
   return $images_array;

}

function wpsmb_archives_images_array(){

    global $wp_query;

    $output = '';
    foreach($wp_query->posts as $object){

        $output[$object->ID] = wp_get_attachment_image_src(get_post_thumbnail_id($object->ID), 'medium');

    }

    return $output;

}

function wpsmb_home_images_array(){
    $home_id = get_option('page_on_front');

    global $wp_query;
    $args = array();
    $query = get_post($home_id, ARRAY_A);
    // this code will retrieve featured images from a blog home page not front-page

    $output = '';
    foreach($wp_query->posts as $object){

        $output[$object->ID] = wp_get_attachment_image_src(get_post_thumbnail_id($object->ID), 'medium');

    }
    // fallback for front-page
    if($output[$object->ID]== false){
       // var_dump($query);
        $output = wpsmb_images_array($home_id);
    }
    return $output;

}

// --------------------------------------------------------
// FB SDK INTEGRATION
// NEED A REGISTRED FACEBOOK APP
// NOT USED YET
// Because it needs to edit header.php
// how to do to create before

function wpsmb_fb_sdk_insert(){
    $options = get_option( 'wp_smb_fb_settings' );
    ?>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : <?php echo $options['wpsmb_fb_app_id'];?>, //'974012959284768', //miresparis
                xfbml      : true,
                version    : 'v2.3'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
<?php
}

function wpsmb_fb_share_button($permalink, $layout){
    $layout = 'button_count';
    ?>
    <div class="fb-share-button" data-href="<?php echo $permalink; ?>" data-layout="<?php echo $layout; ?>"></div>
    <?php
}

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
        $output .= "<br />&gt;&gt;&gt;&gt;&gt;<strong>$tag</strong><br />";
        ksort($priority);
        foreach($priority as $priority => $function){
            $output .= $priority;
            foreach($function as $name => $properties) $output .="$name<br />";
        }
    }
    $output .= '</pre>';
    return $output;
}