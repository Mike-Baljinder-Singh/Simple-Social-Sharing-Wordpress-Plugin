<?php
/* 
Core function to create HTML of the sharing icons
 */
function render_soc_share_html( $network='', $size='medium', $style='default', $pid, $color='' ){
	if( $size == '' ) $size = 'medium';
	$html = '<div class="soc_share_frame size_' . $size . ' style_' . $style . '">';
	$title = urlencode( get_the_title( $pid ) );
	$url = urlencode( get_the_permalink( $pid ) );
	$img = urlencode( wp_get_attachment_url( get_post_thumbnail_id( $pid ) ) );
	
	//Data Layout for the available Social networks
	$sndata = array(
				'Facebook'	=> array(
									'class'	=>	'fa-facebook-square',
									'shurl'	=>	'javascript:void(0)" onclick="soc_share_invoke_pu(this);" data-url="https://www.facebook.com/sharer.php?u=' . $url . '&title=' . $title
								),
				'Twitter'	=> array(
									'class'	=>	'fa-twitter-square',
									'shurl'	=>	'javascript:void(0)" onclick="soc_share_invoke_pu(this);" data-url="http://twitter.com/share?text=' . $title . '&url=' . $url
								),
				'Google+'	=> array(
									'class'	=>	'fa-google-plus-square',
									'shurl'	=>	'javascript:void(0)" onclick="soc_share_invoke_pu(this);" data-url="https://plus.google.com/share?url=' . $url
								),
				'Pinterest'	=> array(
									'class'	=>	'fa-pinterest-square',
									'shurl'	=>	'javascript:void(0)" onclick="soc_share_invoke_pu(this);" data-url="http://pinterest.com/pin/create/button/?url=' . $url . '&media=' . $img . '&description=' . $title
								),
				'LinkedIn'	=> array(
									'class'	=>	'fa-linkedin-square',
									'shurl'	=>	'javascript:void(0)" onclick="soc_share_invoke_pu(this);" data-url="https://www.linkedin.com/cws/share?url=' . $url
								),
				'WhatsApp'	=> array(
									'class'	=>	'fa-whatsapp',
									'shurl'	=>	'whatsapp://send?text=' . $title . '-%20' . $url
								)
			);
	
	//Initiate networks to all networks if there is no specification
	if( $network == '' ) $networks = array_keys( $sndata );
	else $networks = explode( ",", $network );
	
	//Removing WhatsApp if the device is not mobile device.
	if( ( ( $key = array_search( 'WhatsApp', $networks ) ) !== false ) && ( !wp_is_mobile() ) ){
		unset($networks[$key]);
	}
	
	//Rendering the icons
	foreach( $networks as $nw ){
		$html.='<a href="' . $sndata[ $nw ][ 'shurl' ] . '" class="snetworks ' . $nw . '" title="Share On ' . $nw . '">
					<i style="color: #' . $color . '" class="fa ' . $sndata[ $nw ][ 'class' ] . '" aria-hidden="true"></i>
				</a>';
	}
	$html.= '</div>';
	return $html;
}
?>