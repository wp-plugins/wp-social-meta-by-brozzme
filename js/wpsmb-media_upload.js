/*
 Using WordPress Media Uploader System with plugin settings
 Author: Benoti
 Author URI: http://brozzme.com
 */
jQuery(document).ready(function() {

    jQuery('.wpsmb-upload-button').click(function() {
        formfield = jQuery('#wpsmb_default_image').attr('name');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });

    window.send_to_editor = function(html) {
        imgurl = jQuery('img',html).attr('src');
        jQuery('#wpsmb_default_image').val(imgurl);
        tb_remove();
    }

});
