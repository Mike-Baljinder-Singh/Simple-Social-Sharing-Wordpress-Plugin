jQuery(document).ready(function(){
	//Add rendered code to featured image section	
	if( jQuery('.share_in_fimg').length > 0){
		jQuery('.share_in_fimg').each(function(){
			ths = this;
			soc_html = jQuery(ths).html();
			if( jQuery(ths).closest('article').find('.post-thumbnail').length > 0 )
				jQuery(ths).closest('article').find('.post-thumbnail').append( soc_html );
			else{
				//Getting ready for fallback- "Default", if the featured image section is not foud
				jQuery(ths).find('.soc_share_frame').addClass('style_default');
				jQuery(ths).find('.soc_share_frame').removeClass('style_insdftrdimg');
				jQuery(ths).attr('class', 'share_in_title');
			}
		});
	}
	//Add rendered code to featured title section	
	if( jQuery('.share_in_title').length > 0){
		jQuery('.share_in_title').each(function(){
			ths = this;
			soc_html = jQuery(ths).html();
			jQuery(ths).closest('article').find('.entry-title').append( soc_html );
		});
	}
});
//Function to handle clicks to popups
function soc_share_invoke_pu( ths ){
	url = jQuery(ths).attr("data-url");
	window.open( url, '', 'height=500, width=500' );
	e.preventdefault;
}