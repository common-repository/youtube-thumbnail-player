<?php	

	
	/* FUNCION AGREGA CSS EN EL HEAD DEL ADMIN (ESTO SE PUEDE CAMBIAR) */
	add_action('admin_head', NAME_PLUGIN_VAR_youtube_thumbnail_player_wpf.'_css');
	add_action('admin_head', NAME_PLUGIN_VAR_youtube_thumbnail_player_wpf.'_jsAdmin');
	add_action('wp_head', NAME_PLUGIN_VAR_youtube_thumbnail_player_wpf.'_css');
	add_action('wp_head', NAME_PLUGIN_VAR_youtube_thumbnail_player_wpf.'_js');
	
	add_filter('plugin_action_links', 'youtube_thumbnail_player_wpf_add_settings_link', 10, 2 );

	/* CARGAMOS LA ULTIMA VERSION DE JQUERY */
	function youtube_thumbnail_player_wpf_cargar_jquery() {		
			wp_enqueue_script('jquery');		
	}
	add_action('init', 'youtube_thumbnail_player_wpf_cargar_jquery');
	
	
function youtubeFn($atts) {
    extract(shortcode_atts(array(
	"id" => '',
    ), $atts));

	return getVideo($id);
}

add_shortcode('ytube', 'youtubeFn');

function getVideo($id)
{
	$mData = getMetaData($id);
	if($mData == NULL || $mData =='')
		return '<span style="color:#FF0000">Video No Found</span>';
	$mData['duracion'] = seg2time($mData['duracion']);
	$html = 
			"<div id='contenidoVideo'>
				<span class='thumbnail'>
					<!--<span class='autor'><a target='_Blank' href='http://youtube.com/user/".$mData['autor']."'>".$mData['autor'] ."</a></span>-->
					<span class='youtubeLogo'></span>
					<span class='duracion'>".$mData['duracion'] ."</span>
					<span class='botonPlay' onclick='verVideo(\"".$id."\")'></span>
					<span class='slideshowVideo'>
						<img  src=".$mData['thumbnailF'].">
						<img  style='display:none' src=".$mData['thumbnail1'].">
						<img  style='display:none' src=".$mData['thumbnail2'].">
						<img  style='display:none' src=".$mData['thumbnail3'].">
					</span>
					
				</span>
				<span class='titulo'>".$mData['title']."</span>
				<span class='desc'>".$mData['desc'] ."</span>
				<span class='average'><img src='".WP_PLUGIN_URL.'/'.PLUGIN_FOLDER_youtube_thumbnail_player_wpf."/images/rating/".round(floatval($mData['average'])) .".png' title='".$mData['numRaters']."'></span>
				<span class='tags'>".$mData['tags'] ."</span>
				
				
			</div>
			
			";
	return $html;
}

function seg2time($seg_ini) {
$seg_ini = intval($seg_ini);
if($seg_ini == 0)
	return '00:00:00';
$horas = floor($seg_ini/3600);
if($horas<10)
	$horas = '0'.$horas;
$minutos = floor(($seg_ini-($horas*3600))/60);
if($minutos<10)
	$minutos = '0'.$minutos;
$segundos = $seg_ini-($horas*3600)-($minutos*60);
if($segundos<10)
	$segundos = '0'.$segundos;
return $horas.':'.$minutos.':'.$segundos;

}
function php_curl2($url){
	$c = curl_init($url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	$xmlData = curl_exec($c);
	curl_close($c);	
	return $xmlData;
}
function getMetaData($video){
	$xmlData 				= php_curl2("https://gdata.youtube.com/feeds/api/videos/$video");  
	$xmlData 				= str_replace('yt:', 'yt', $xmlData); 
	$xmlData 				= str_replace('gd:', 'yt', $xmlData); 
	$xmlData 				= str_replace('media:', 'media', $xmlData); 
	if (trim($xmlData) == '' || $xmlData == 'Invalid id' || $xmlData == 'Private video' || strlen($xmlData )<50)
		return NULL;
	$xml 					= new SimpleXMLElement($xmlData);   
	/*echo '<pre>';
	print_r($xml);*/	
	$data['tags'] 			= $xml->mediagroup->mediakeywords;
	$data['title'] 			= $xml->title;
	$data['desc'] 			= substr($xml->content,0,100).'...';
	$data['autor'] 			= $xml->author->name;
	$data['autorUrl'] 		= $xml->author->uri;
	$data['duracion']		= $xml->mediagroup->ytduration['seconds'];
	$data['average']		= $xml->ytrating['average'];
	$data['max']			= $xml->ytrating['max'];
	$data['min']			= $xml->ytrating['min'];
	$data['numRaters']		= $xml->ytrating['numRaters'];
	$data['thumbnailF'] 	= $xml->mediagroup->mediathumbnail[0]['url'];
	$data['thumbnail1'] 	= $xml->mediagroup->mediathumbnail[1]['url'];
	$data['thumbnail2'] 	= $xml->mediagroup->mediathumbnail[2]['url'];
	$data['thumbnail3'] 	= $xml->mediagroup->mediathumbnail[3]['url'];
	
	return $data;
	
}
?>
