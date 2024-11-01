<?php
/*
Plugin Name: Youtube Thumbnail Player
Plugin URI: http://nexxuz.com/youtube-thumbnail-player-plugin-wordpress.html
Description: Sexy thumbnail and video player youtube
Author: jodacame
Version: 0.5
Author URI: http://Nexxuz.com


*/

/* Archivo de Configuracion */
include('config.php');



/* {dashboard} */


/* FUNCION ESCRIBE CSS */ 
function  youtube_thumbnail_player_wpf_css() {
  echo ("<link rel = 'stylesheet'  href='".CSS_FILE_youtube_thumbnail_player_wpf."' type='text/css' media='all' />"); 
  
}

function  youtube_thumbnail_player_wpf_jsAdmin() {
    //echo ("<script type='text/javascript' src='".WP_PLUGIN_URL.'/'.PLUGIN_FOLDER_youtube_thumbnail_player_wpf."/js/scriptAdmin.js'  /></script>"); 

  
}
function  youtube_thumbnail_player_wpf_js() {
  
//  echo ("<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js'></script>"); 
 echo ("<script src='".WP_PLUGIN_URL.'/'.PLUGIN_FOLDER_youtube_thumbnail_player_wpf."/js/jquery.cycle.lite.js'></script>"); 
echo ("<script type='text/javascript' src='".WP_PLUGIN_URL.'/'.PLUGIN_FOLDER_youtube_thumbnail_player_wpf."/js/script.js'  /></script>"); 
  
  
}

/* {widget} */


/* OTRAS FUNCIONES */

/* FUNCION  GENERA LINK PARA DONACIONES */
function youtube_thumbnail_player_wpf_link_donaciones(){
	echo '<span style="width:100%;text-align:center;display:block"><a target="_Blank" href="http://nexxuz.com/donate.php"><img src="'.IMAGES_FOLDER.'/donate.png" border="0" align="top" style="padding-right:2px"> Donate</a></span><br>';
}
	
function youtube_thumbnail_player_wpf_logo(){
	echo'<div id="logo_jodacame">
	<span class="titulo_plugin">'.TITLE_PLUGIN_youtube_thumbnail_player_wpf.'</span>
	<span class="creditos">POWERED BY <a href="http://nexxuz.com">JODACAME</a></span>
	</div>';
}
function youtube_thumbnail_player_wpf_icono_menu($icono){
return '<img src="'.IMAGES_FOLDER_youtube_thumbnail_player_wpf.'/'.$icono.'.png" valing="absmiddle" border="0"> ';
}
function youtube_thumbnail_player_wpf_titulo($titulo,$a=null,$b=null,$c=null){
	echo '<h2 id="h2_titulo">'. __( $titulo).' '. __( $a).' '. __( $b).' '. __( $c).'</h2>';
}



function youtube_thumbnail_player_wpf_add_settings_link($links, $file) {
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
	if ($file == $this_plugin){
		$settings_link = '<a href="http://nexxuz.com/donate.php">'.__('Donate').'</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
 }
 include(INCLUDES_FOLDER_youtube_thumbnail_player_wpf.'/core/register.php');
 
 
function mi_inicio() {
	if(!is_admin()) {
		wp_deregister_script('jquery');

		//wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', false, '1.5', true);
                //Con este código se cargaría en el pie, pero usando el API de Google
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', false, '1.3.2', false);

		wp_enqueue_script('jquery');
	}
}
add_action('init', 'mi_inicio');

add_filter('mce_external_plugins', "tinyplugin_register");
add_filter('mce_buttons', 'tinyplugin_add_button', 0);

function tinyplugin_add_button($buttons)
{
	    array_push($buttons, "separator", "ytubebtn");
	   
	    return $buttons;
}

function tinyplugin_register($plugin_array)
{
    $url = trim(get_bloginfo('url'), "/")."/wp-content/plugins/youtube-thumbnail-player/js/scriptAdmin.js";

    $plugin_array['ytubebtn'] = $url;
	    return $plugin_array;
	}
