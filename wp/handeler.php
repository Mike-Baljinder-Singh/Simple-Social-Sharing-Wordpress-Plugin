<?php
/* 
Handeler to handle the icon placement with different styles and layout. To be invoked only if the site's frontend is being used.
 */
if( !is_admin() ){
	add_action( 'the_content', function( $content ){
		$options = unserialize( get_option( 'soc-share-set' ) );
		
		//Only loaded on the posts, where they are approved from plugin settings page
		if ( in_array( get_post_type(), $options[ 'display_on' ] ) ){
			global $post;
			if( get_post_meta( $post->ID, 'soc-share-global', true ) == 'custom' ) {
				unset( $options );
				$options = unserialize( get_post_meta( $post->ID, 'soc-share-set', true ) );
			}
			if( !isset( $options[ 'color' ] ) ) $color = $options[ 'customcolor' ];
			switch( $options[ 'placement' ] ){
				case 'left':
					return $content . render_soc_share_html( implode( ",", $options[ 'soc_netwrks' ] ), $options[ 'size' ], 'left', $post->ID, @$color );
					break;
				case 'aftrcntnt':
					return $content . render_soc_share_html( implode( ",", $options[ 'soc_netwrks' ] ), $options[ 'size' ], 'aftrcntnt', $post->ID, @$color );
					break;
				case 'insdftrdimg':
					$add_content = "<div class='share_in_fimg'>". render_soc_share_html( implode( ",", $options[ 'soc_netwrks' ] ), $options[ 'size' ], 'insdftrdimg', $post->ID, @$color ) . "</div>";
					  return $content . $add_content;
					break;
				case 'dflt':
					$add_content = "<div class='share_in_title'>". render_soc_share_html( implode( ",", $options[ 'soc_netwrks' ]), $options[ 'size' ], 'default', $post->ID, @$color ) ."</div>";
					  return $content . $add_content;
					break;
				default:
					return $content;
			}
		}
		else return $content;
	});
}
?>