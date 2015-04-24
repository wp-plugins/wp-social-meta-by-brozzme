<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27/03/15
 * Time: 13:22
 */

add_action( 'admin_init', 'wp_smb_settings_init' );

function wp_smb_settings_init(  ) {

    register_setting( 'wpsmbGeneralSettings', 'wp_smb_general_settings' );
    register_setting( 'wpsmbOptionsSettings', 'wp_smb_options_settings' );
    register_setting( 'wpsmbFbSettings', 'wp_smb_fb_settings' );
    register_setting( 'wpsmbGplusSettings', 'wp_smb_gplus_settings' );
    register_setting( 'wpsmbTwitterSettings', 'wp_smb_twitter_settings' );

    //general settings
    add_settings_section(
        'wpsmbGeneralSettings_section',
        __( 'General settings for Wp Social Meta by Brozzme', 'wp-social-meta-brozzme' ),
        'wpsmb_general_settings_section_callback',
        'wpsmbGeneralSettings'
    );

            add_settings_field(
                'wpsmb_enable',
                __( 'Enable Social Meta', 'wp-social-meta-brozzme' ),
                'wpsmb_enable_render',
                'wpsmbGeneralSettings',
                'wpsmbGeneralSettings_section'
            );

            add_settings_field(
                'wpsmb_site_name',
                __( 'Site name', 'wp-social-meta-brozzme' ),
                'wpsmb_site_name_render',
                'wpsmbGeneralSettings',
                'wpsmbGeneralSettings_section'
            );
            add_settings_field(
                'wpsmb_default_image',
                __( 'Default image', 'wp-social-meta-brozzme' ),
                'wpsmb_default_image_render',
                'wpsmbGeneralSettings',
                'wpsmbGeneralSettings_section'
            );
            add_settings_field(
                'wpsmb_embed_meta_on_all',
                __( 'Embed meta on the entire website', 'wp-social-meta-brozzme' ),
                'wpsmb_embed_meta_on_all_render',
                'wpsmbGeneralSettings',
                'wpsmbGeneralSettings_section'
            );
            add_settings_field(
                'wpsmb_embed_images_array',
                __( 'Automatic images array', 'wp-social-meta-brozzme' ),
                'wpsmb_embed_images_array_render',
                'wpsmbGeneralSettings',
                'wpsmbGeneralSettings_section'
            );

    //options settings


    add_settings_section(
        'wpsmbOptionsSettings_section',
        __( 'Options settings for Wp Social Meta by Brozzme', 'wp-social-meta-brozzme' ),
        'wpsmb_options_settings_section_callback',
        'wpsmbOptionsSettings'
    );

                add_settings_field(
                    'wpsmb_enable_on_products',
                    __( 'Enable social meta on product', 'wp-social-meta-brozzme' ),
                    'wpsmb_enable_on_products_render',
                    'wpsmbOptionsSettings',
                    'wpsmbOptionsSettings_section'
                );
                add_settings_field(
                    'wpsmb_image_to_show',
                    __( 'First image to show', 'wp-social-meta-brozzme' ),
                    'wpsmb_image_to_show_render',
                    'wpsmbOptionsSettings',
                    'wpsmbOptionsSettings_section'
                );
                add_settings_field(
                    'wpsmb_excerpt_lengh',
                    __( 'Description lengh', 'wp-social-meta-brozzme' ),
                    'wpsmb_excerpt_lengh_render',
                    'wpsmbOptionsSettings',
                    'wpsmbOptionsSettings_section'
                );
                add_settings_field(
                    'wpsmb_base_description',
                    __( 'Default description', 'wp-social-meta-brozzme' ),
                    'wpsmb_base_description_render',
                    'wpsmbOptionsSettings',
                    'wpsmbOptionsSettings_section'
                );
    add_settings_section(
        'wpsmbGplusSettings_section',
        __( 'Settings google+ for Wp Social Meta by Brozzme', 'wp-social-meta-brozzme' ),
        'wpsmb_gplus_settings_section_callback',
        'wpsmbGplusSettings'
    );
                add_settings_field(
                    'wpsmb_enable_gplus',
                    __( 'Enable google+ social meta', 'wp-social-meta-brozzme' ),
                    'wpsmb_enable_gplus_render',
                    'wpsmbGplusSettings',
                    'wpsmbGplusSettings_section'
                );
                add_settings_field(
                    'wpsmb_gplus_user_id',
                    __( 'google+ user id', 'wp-social-meta-brozzme' ),
                    'wpsmb_gplus_user_id_render',
                    'wpsmbGplusSettings',
                    'wpsmbGplusSettings_section'
                );
                add_settings_field(
                    'wpsmb_gplus_rel',
                    __( 'google+ rel type', 'wp-social-meta-brozzme' ),
                    'wpsmb_gplus_rel_render',
                    'wpsmbGplusSettings',
                    'wpsmbGplusSettings_section'
                );

    add_settings_section(
        'wpsmbFbSettings_section',
        __( 'Settings facebook for Wp Social Meta by Brozzme', 'wp-social-meta-brozzme' ),
        'wpsmb_fb_settings_section_callback',
        'wpsmbFbSettings'
    );
                add_settings_field(
                    'wpsmb_enable_fb',
                    __( 'Enable facebook social meta', 'wp-social-meta-brozzme' ),
                    'wpsmb_enable_fb_render',
                    'wpsmbFbSettings',
                    'wpsmbFbSettings_section'
                );
                add_settings_field(
                    'wpsmb_fb_user_id',
                    __( 'facebook user id', 'wp-social-meta-brozzme' ),
                    'wpsmb_fb_user_id_render',
                    'wpsmbFbSettings',
                    'wpsmbFbSettings_section'
                );
                add_settings_field(
                    'wpsmb_fb_app_id',
                    __( 'facebook app id', 'wp-social-meta-brozzme' ),
                    'wpsmb_fb_app_id_render',
                    'wpsmbFbSettings',
                    'wpsmbFbSettings_section'
                );
//                add_settings_field(
//                    'wpsmb_fb_sdk_load',
//                    __( 'loading Facebook Javascript Sdk', 'wp-social-meta-brozzme' ),
//                    'wpsmb_fb_sdk_load_render',
//                    'wpsmbFbSettings',
//                    'wpsmbFbSettings_section'
//                );

    add_settings_section(
        'wpsmbTwitterSettings_section',
        __( 'Settings Twitter for Wp Social Meta by Brozzme', 'wp-social-meta-brozzme' ),
        'wpsmb_twitter_settings_section_callback',
        'wpsmbTwitterSettings'
    );
                add_settings_field(
                    'wpsmb_enable_twitter',
                    __( 'Enable Twitter social meta', 'wp-social-meta-brozzme' ),
                    'wpsmb_enable_twitter_render',
                    'wpsmbTwitterSettings',
                    'wpsmbTwitterSettings_section'
                );
                add_settings_field(
                    'wpsmb_twitter_user_id',
                    __( 'Twitter user id', 'wp-social-meta-brozzme' ),
                    'wpsmb_twitter_user_id_render',
                    'wpsmbTwitterSettings',
                    'wpsmbTwitterSettings_section'
                );
                add_settings_field(
                    'wpsmb_twitter_card_type',
                    __( 'Twitter card type', 'wp-social-meta-brozzme' ),
                    'wpsmb_twitter_card_type_render',
                    'wpsmbTwitterSettings',
                    'wpsmbTwitterSettings_section'
                );

}



function wpsmb_enable_render(  ) {
    $options = get_option( 'wp_smb_general_settings' );

    ?>
    <select name="wp_smb_general_settings[wpsmb_enable]">
        <option value="true" <?php if ( $options['wpsmb_enable'] == 'true' ) echo 'selected="selected"'; ?>><?php _e( 'Yes', 'wp-social-meta-brozzme' );?></option>
        <option value="false" <?php if ( $options['wpsmb_enable'] == 'false' ) echo 'selected="selected"'; ?>><?php _e( 'No', 'wp-social-meta-brozzme' );?></option>
    </select>
<?php

}

function wpsmb_site_name_render(  ) {
    $options = get_option( 'wp_smb_general_settings' );
    ?>
    <input type='text' name='wp_smb_general_settings[wpsmb_site_name]' value='<?php echo $options['wpsmb_site_name']; ?>'>
<?php
}
function wpsmb_default_image_render(  ) {
    $options = get_option( 'wp_smb_general_settings' );
?>
    <input id="wpsmb_default_image" type="text" name='wp_smb_general_settings[wpsmb_default_image]' value='<?php echo $options['wpsmb_default_image']; ?>' size="50" />
    <input class="wpsmb-upload-button button" type="button" value="Upload Image" />
<?php
}

function wpsmb_embed_meta_on_all_render(){
    $options = get_option( 'wp_smb_general_settings' );
    ?>
    <select name="wp_smb_general_settings[wpsmb_embed_meta_on_all]">
        <option value="true" <?php if ( $options['wpsmb_embed_meta_on_all'] == 'true' ) echo 'selected="selected"'; ?>><?php _e( 'Yes', 'wp-social-meta-brozzme' );?></option>
        <option value="false" <?php if ( $options['wpsmb_embed_meta_on_all'] == 'false' ) echo 'selected="selected"'; ?>><?php _e( 'No', 'wp-social-meta-brozzme' );?></option>
    </select>
<?php
}
function wpsmb_embed_images_array_render(  ) {
    $options = get_option( 'wp_smb_general_settings' );
    ?>
    <select name="wp_smb_general_settings[wpsmb_embed_images_array]">
        <option value="true" <?php if ( $options['wpsmb_embed_images_array'] == 'true' ) echo 'selected="selected"'; ?>><?php _e( 'Yes', 'wp-social-meta-brozzme' );?></option>
        <option value="false" <?php if ( $options['wpsmb_embed_images_array'] == 'false' ) echo 'selected="selected"'; ?>><?php _e( 'No', 'wp-social-meta-brozzme' );?></option>
    </select>
<?php
}

function wpsmb_enable_on_products_render(  ) {
    $options = get_option( 'wp_smb_options_settings' );
    ?>
    <select name="wp_smb_options_settings[wpsmb_enable_on_products]">
        <option value="true" <?php if ( $options['wpsmb_enable_on_products'] == 'true' ) echo 'selected="selected"'; ?>><?php _e( 'Yes', 'wp-social-meta-brozzme' );?></option>
        <option value="false" <?php if ( $options['wpsmb_enable_on_products'] == 'false' ) echo 'selected="selected"'; ?>><?php _e( 'No', 'wp-social-meta-brozzme' );?></option>
    </select>
<?php
}
function wpsmb_image_to_show_render(  ) {
    $options = get_option( 'wp_smb_options_settings' );

    ?>
    <select name="wp_smb_options_settings[wpsmb_image_to_show]">
        <option value="featured" <?php if ( $options['wpsmb_image_to_show'] == 'featured' ) echo 'selected="selected"'; ?>><?php _e( 'Featured image', 'wp-social-meta-brozzme' );?></option>
        <option value="first" <?php if ( $options['wpsmb_image_to_show'] == 'first' ) echo 'selected="selected"'; ?>><?php _e( 'First image', 'wp-social-meta-brozzme' );?></option>
    </select>
<?php
}
function wpsmb_excerpt_lengh_render(  ) {
    $options = get_option( 'wp_smb_options_settings' );
    ?>
    <input type='text' name='wp_smb_options_settings[wpsmb_excerpt_lengh]' value='<?php echo $options['wpsmb_excerpt_lengh']; ?>'>
<?php
}
function wpsmb_base_description_render(  ) {
    $options = get_option( 'wp_smb_options_settings' );
    ?>
    <textarea name="wp_smb_options_settings[wpsmb_base_description]" id="wpsmb_base_description" class="small-text" cols="50" rows="5">
<?php echo $options['wpsmb_base_description']; ?>
     </textarea>
    <?php
}


function wpsmb_enable_fb_render(  ) {
    $options = get_option( 'wp_smb_fb_settings' );

    ?>
    <select name="wp_smb_fb_settings[wpsmb_enable_fb]">
        <option value="true" <?php if ( $options['wpsmb_enable_fb'] == 'true' ) echo 'selected="selected"'; ?>><?php _e( 'Yes', 'wp-social-meta-brozzme' );?></option>
        <option value="false" <?php if ( $options['wpsmb_enable_fb'] == 'false' ) echo 'selected="selected"'; ?>><?php _e( 'No', 'wp-social-meta-brozzme' );?></option>
    </select>
<?php

}
function wpsmb_fb_user_id_render(  ) {
    $options = get_option( 'wp_smb_fb_settings' );

    ?>
    <input type='text' name='wp_smb_fb_settings[wpsmb_fb_user_id]' value='<?php echo $options['wpsmb_fb_user_id']; ?>'>
    <p><i><a href="http://graph.facebook.com/">http://graph.facebook.com/</a>yourfbname</i></p>
    <p>In order to use Facebook Domain Insights you must add the app ID to your page. Domain Insights lets you view analytics for traffic to your site from Facebook. Find the app ID in your App Dashboard.</p>
<?php

}
function wpsmb_fb_app_id_render(  ) {
    $options = get_option( 'wp_smb_fb_settings' );

    ?>
    <input type='text' name='wp_smb_fb_settings[wpsmb_fb_app_id]' value='<?php echo $options['wpsmb_fb_app_id']; ?>'>
    <p><i><a href="">Publisher ID</i></p>
<?php

}
function wpsmb_fb_sdk_load_render(  ) {
    $options = get_option( 'wp_smb_fb_settings' );

    ?>
    <select name="wp_smb_fb_settings[wpsmb_fb_sdk_load]">
        <option value="true" <?php if ( $options['wpsmb_fb_sdk_load'] == 'true' ) echo 'selected="selected"'; ?>><?php _e( 'Yes', 'wp-social-meta-brozzme' );?></option>
        <option value="false" <?php if ( $options['wpsmb_fb_sdk_load'] == 'false' ) echo 'selected="selected"'; ?>><?php _e( 'No', 'wp-social-meta-brozzme' );?></option>
    </select>
<?php

}

function wpsmb_enable_gplus_render(  ) {
    $options = get_option( 'wp_smb_gplus_settings' );

    ?>
    <select name="wp_smb_gplus_settings[wpsmb_enable_gplus]">
        <option value="true" <?php if ( $options['wpsmb_enable_gplus'] == 'true' ) echo 'selected="selected"'; ?>><?php _e( 'Yes', 'wp-social-meta-brozzme' );?></option>
        <option value="false" <?php if ( $options['wpsmb_enable_gplus'] == 'false' ) echo 'selected="selected"'; ?>><?php _e( 'No', 'wp-social-meta-brozzme' );?></option>
    </select>
<?php

}
function wpsmb_gplus_user_id_render(  ) {
    $options = get_option( 'wp_smb_gplus_settings' );

    ?>
    <input type='text' name='wp_smb_gplus_settings[wpsmb_gplus_user_id]' value='<?php echo $options['wpsmb_gplus_user_id']; ?>'>
    <p><i><a href="">Publisher ID</i></p>
<?php

}

function wpsmb_gplus_rel_render(){
    $options = get_option( 'wp_smb_gplus_settings' );

    ?>
    <select name="wp_smb_gplus_settings[wpsmb_gplus_rel]">
        <option value="author" <?php if ( $options['wpsmb_gplus_rel'] == 'author' ) echo 'selected="selected"'; ?>><?php _e( 'Author', 'wp-social-meta-brozzme' );?></option>
        <option value="publisher" <?php if ( $options['wpsmb_gplus_rel'] == 'publisher' ) echo 'selected="selected"'; ?>><?php _e( 'Publisher', 'wp-social-meta-brozzme' );?></option>
    </select>
<?php

}
function wpsmb_enable_twitter_render(  ) {
    $options = get_option( 'wp_smb_twitter_settings' );
    ?>
    <select name="wp_smb_twitter_settings[wpsmb_enable_twitter]">
        <option value="true" <?php if ( $options['wpsmb_enable_twitter'] == 'true' ) echo 'selected="selected"'; ?>><?php _e( 'Yes', 'wp-social-meta-brozzme' );?></option>
        <option value="false" <?php if ( $options['wpsmb_enable_twitter'] == 'false' ) echo 'selected="selected"'; ?>><?php _e( 'No', 'wp-social-meta-brozzme' );?></option>
    </select>
<?php
}
function wpsmb_twitter_user_id_render(  ) {
    $options = get_option( 'wp_smb_twitter_settings' );
    ?>
    <input type='text' name='wp_smb_twitter_settings[wpsmb_twitter_user_id]' value='<?php echo $options['wpsmb_twitter_user_id']; ?>'>
<?php

}
function wpsmb_twitter_card_type_render(  ) {
    $options = get_option( 'wp_smb_twitter_settings' );
    ?>
    <select name="wp_smb_twitter_settings[wpsmb_twitter_card_type]">
        <option value="summary" <?php if ( $options['wpsmb_twitter_card_type'] == 'summary' ) echo 'selected="selected"'; ?>><?php _e( 'Summary card', 'wp-social-meta-brozzme' );?></option>
        <option value="summary_large_image" <?php if ( $options['wpsmb_twitter_card_type'] == 'summary_large_image' ) echo 'selected="selected"'; ?>><?php _e( 'Summary card with large image', 'wp-social-meta-brozzme' );?></option>
        <option value="photo" <?php if ( $options['wpsmb_twitter_card_type'] == 'photo' ) echo 'selected="selected"'; ?>><?php _e( 'Photo card', 'wp-social-meta-brozzme' );?></option>
        <option value="gallery" <?php if ( $options['wpsmb_twitter_card_type'] == 'gallery' ) echo 'selected="selected"'; ?>><?php _e( 'Gallery card', 'wp-social-meta-brozzme' );?></option>
        <option value="product" <?php if ( $options['wpsmb_twitter_card_type'] == 'product' ) echo 'selected="selected"'; ?>><?php _e( 'Product card', 'wp-social-meta-brozzme' );?></option>

    </select>
<?php
}

function wpsmb_general_settings_section_callback(  ) {

    echo __( 'General settings', 'wp-social-meta-brozzme' );

}

function wpsmb_options_settings_section_callback(  ) {

    echo __( 'Options settings for ', 'wp-social-meta-brozzme' ).' '.get_bloginfo('name');

}

function wpsmb_gplus_settings_section_callback(  ) {

    echo __( 'Google+ settings for ', 'wp-social-meta-brozzme' ).' '.get_bloginfo('name');

}
function wpsmb_twitter_settings_section_callback(  ) {

    echo __( 'Twitter settings for ', 'wp-social-meta-brozzme' ).' '.get_bloginfo('name');

}

function wpsmb_options_page(  ) {
    ?>
    <div class="wrap">


        <h2>WP Social Meta by Brozzme</h2>
        <?php

        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_settings';
        ?>

        <h2 class="nav-tab-wrapper">
            <a href="?page=wp-smb-options&tab=general_settings" class="nav-tab <?php echo $active_tab == 'general_settings' ? 'nav-tab-active' : ''; ?>">General settings</a>
            <a href="?page=wp-smb-options&tab=options_settings" class="nav-tab <?php echo $active_tab == 'options_settings' ? 'nav-tab-active' : ''; ?>">Options settings</a>
            <a href="?page=wp-smb-options&tab=fb_settings" class="nav-tab <?php echo $active_tab == 'fb_settings' ? 'nav-tab-active' : ''; ?>">Facebook settings</a>

            <a href="?page=wp-smb-options&tab=gplus_settings" class="nav-tab <?php echo $active_tab == 'gplus_settings' ? 'nav-tab-active' : ''; ?>">Google+ settings</a>
            <a href="?page=wp-smb-options&tab=twitter_settings" class="nav-tab <?php echo $active_tab == 'twitter_settings' ? 'nav-tab-active' : ''; ?>">Twitter settings</a>

        </h2>
        <form action='options.php' method='post'>
            <?php
            if( $active_tab == 'options_settings' ) {
                settings_fields('wpsmbOptionsSettings');
                do_settings_sections('wpsmbOptionsSettings');

            }
            elseif( $active_tab == 'fb_settings' ) {
                settings_fields('wpsmbFbSettings');
                do_settings_sections('wpsmbFbSettings');

            }
            elseif( $active_tab == 'gplus_settings' ) {
                settings_fields('wpsmbGplusSettings');
                do_settings_sections('wpsmbGplusSettings');

            }
            elseif( $active_tab == 'twitter_settings' ) {
                settings_fields('wpsmbTwitterSettings');
                do_settings_sections('wpsmbTwitterSettings');

            }
            else {
                settings_fields('wpsmbGeneralSettings');
                do_settings_sections('wpsmbGeneralSettings');
            }
            submit_button();
            ?>

        </form>
    </div>
<?php
//$options = get_option('wp_smb_twitter_settings');
  //  list_hooked_functions('wp_head');
//var_dump($options);
}