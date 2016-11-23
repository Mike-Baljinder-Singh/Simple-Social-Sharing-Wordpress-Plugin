$=jQuery;
$(document).ready(function(){
	//Function of moving social network sorws
	$('.moveup').click( function(){
		ths = this;
		new_pos = parseInt( $(ths).parent().attr('position') ) - 1;
		
		oldel = $('span[position="' + new_pos + '"] span.inputelements').html();
		newel = $('span[position="' + ( new_pos + 1 ) + '"] span.inputelements').html();
		
		$('span[position="' + new_pos + '"] span.inputelements').html( newel );
		$('span[position="' + ( new_pos + 1 ) + '"] span.inputelements').html( oldel );
		
	});
	$('.movedown').click(function(){
		ths=this;
		new_pos=parseInt($(ths).parent().attr('position')) + 1;
		
		oldel = $('span[position="' + new_pos + '"] span.inputelements').html();
		newel = $('span[position="' + ( new_pos - 1 ) + '"] span.inputelements').html();
		
		$('span[position="' + new_pos + '"] span.inputelements').html( newel );
		$('span[position="' + ( new_pos - 1 ) + '"] span.inputelements').html( oldel );
		
	});



		// Switch Click
		$('.Switch').click(function() {
			// Check If Enabled (Has 'On' Class)
			if ($(this).hasClass('On')){
				// Try To Find Checkbox Within Parent Div, And Check It
				$(this).parent().find('input:checkbox.other').attr('checked', true);
				// Change Button Style - Remove On Class, Add Off Class
				$(this).removeClass('On').addClass('Off');
			} else { // If Button Is Disabled (Has 'Off' Class)
				// Try To Find Checkbox Within Parent Div, And Uncheck It
				$(this).parent().find('input:checkbox.other').attr('checked', false);	
				// Change Button Style - Remove Off Class, Add On Class
				$(this).removeClass('Off').addClass('On');	
			}	
		});
		// Loops Through Each Toggle Switch On Page
		$('.Switch').each(function() {
			// Search of a checkbox within the parent
			if ($(this).parent().find('input:checkbox.other').length){
				
				// This just hides all Toggle Switch Checkboxs
				// Uncomment line below to hide all checkbox's after Toggle Switch is Found
				// $(this).parent().find('input:checkbox').hide();
				
				// For Demo, Allow showing of checkbox's with the 'show' class
				// If checkbox doesnt have the show class then hide it
				if (!$(this).parent().find('input:checkbox.other').hasClass("show")){
					$(this).parent().find('input:checkbox.other').hide(); }
				// Comment / Delete out the above 2 lines when using this on a real site
				
				// Look at the checkbox's checkked state
				if ($(this).parent().find('input:checkbox.other').is(':checked')){
					// Checkbox is not checked, Remove the On Class and Add the Off Class
					$(this).removeClass('On').addClass('Off');
				} else { 			
					// Checkbox Is Checked Remove Off Class, and Add the On Class
					$(this).removeClass('Off').addClass('On');
				}
			}
		});
	$('input[name="color"],input[name="soc-share-set[color]"]').change(function(){
		ths=this;
		if( $('input[name="'+ $(ths).attr('name') +'"]:checked').length > 0) 
			$(ths).closest('.content').find('span.row_hldr1').hide();
		else
			$(ths).closest('.content').find('span.row_hldr1').show();
	});
	$('select[name="soc-share-global"]').change(function(){
		if( $(this).val() == 'custom' ) $('div.wrap.soc-post-settings').show();
		else $('div.wrap.soc-post-settings').hide();
	});
});
function chng_clr(ths){
	$('input [name="customcolor"]').val( $(ths).val() );
}