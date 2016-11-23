<?php
function post_meta_box_soc_share( $post ) {
    add_meta_box( 
        'soc-share',
        __( 'Soc Share Post Specific Settings' ),
        'render_soc_share',
        '',
        'normal',
        'default'
    );
}
function render_soc_share($post){
	?>
	Use Global (baltest): 
	<select name="soc-share-global">
		
		<option value="yes">Yes</option>
		<option <?php if( get_post_meta($post->ID, 'soc-share-global', true) == 'custom' ) echo "selected"; ?> value="custom">Use Custom for this post</option>
	</select>
	<?php
	$optns = unserialize( get_post_meta( $post->ID, 'soc-share-set', true ) );
	//echo "<pre>".print_r( $optns, true )."</pre>";
	//echo implode(",", $optns['soc_netwrks']);
	?>
	<div class="wrap soc-post-settings" <?php if( get_post_meta($post->ID, 'soc-share-global', true) <> 'custom' ) echo "style='display:none'"; ?>>
			<p class="input_wrap input_wrap_ntwrks">
				<div class="heading">Social Networks:</div>		
				<?php
				$sns=array(
						"fb" => "Facebook",
						"tw" => "Twitter",
						"gp" => "Google+",
						"pt" => "Pinterest",
						"li" => "LinkedIn",
						"wa" => "WhatsApp"
					);
				if( is_array( $optns['soc_netwrks'] ) )	$srtdsns = array_merge( $optns['soc_netwrks'], $sns );
				else $srtdsns = $sns;
				$srtcntr=1;
				foreach($srtdsns as $snid => $sn){
				?>
				<div class="content">
					<span class="row_hldr" position="<?php echo $srtcntr++; ?>">
						<span class="inputelements">
							<input <?php if( in_array( $sn, $optns['soc_netwrks'] ) ) echo "checked"; ?> type="checkbox" name="soc-share-set[soc_netwrks][<?php echo $snid; ?>]" id="<?php echo $snid; ?>" value="<?php echo $sn; ?>" /> 
							<label for="<?php echo $snid; ?>"><?php echo $sn; ?></label>
						</span>
						<img src="<?php echo SOCSHAREURL ?>/assets/upArrow.png" class="moveup" /> 
						<img src="<?php echo SOCSHAREURL ?>/assets/downArrow.png" class="movedown" />
					</span>
						</div>
				<?php } ?>
				<br>
				<i> Note: WhatsApp works on mobile devices only!</i>
			</p>
			<p class="input_wrap input_wrap_sizes">
			<table class="sizes_table" >
				<tr><td rowspan="2" class="head">
			Sizes: 
			</td>
			<td>
				<input <?php if( in_array("lrg", $optns ) ) echo "checked"; ?> type="radio" name="soc-share-set[size]" value="lrg" id="lrg" />
				<label for="lrg">
					Large
				</label></td>
			
				<td><input <?php if( in_array("mdm", $optns ) ) echo "checked"; ?> type="radio" name="soc-share-set[size]" value="mdm" id="mdm" checked/>
				<label for="mdm">
					Medium
				</label></td>
				
				<td><input <?php if( in_array("sml", $optns ) ) echo "checked"; ?> type="radio" name="soc-share-set[size]" value="sml" id="sml" />
				<label for="sml">
					Small</td></tr>
					<tr>
		
		<td><img src="<?php echo SOCSHAREURL ?>/assets/tray.png" class="large"/></td>
		<td><img src="<?php echo SOCSHAREURL ?>/assets/tray.png" class="med"/></td>
		<td><img src="<?php echo SOCSHAREURL ?>/assets/tray.png" class="small"/></td>
		</tr>
		</table>
			</p>
			<p class="input_wrap input_wrap_clrs">
				<div class="heading"> Colors: </div>
				<div class="content">Original <input <?php if( in_array("original", $optns ) ) echo "checked"; ?> type="checkbox" name="soc-share-set[color]" value="original" /> 
				<span <?php if( in_array("original", $optns ) ) echo "style='display:none;'"; ?> class="row_hldr1">Custom <input readonly class="jscolor" onChange="ths=this; $('#customcolor').val(ths.value);" value="<?php echo $optns['customcolor'] ?>"></span>
				<input id="customcolor" type="hidden" value="<?php echo $optns['customcolor'] ?>" name="soc-share-set[customcolor]"/></div>
			</p>
			<p class="input_wrap input_wrap_plcmnt">
			<table class="sizes_table">
				<tr>
			<td class="head" rowspan="2">Placement options: </td>
				<td width="37.5%">&nbsp;&nbsp;<input <?php if( in_array("dflt", $optns ) ) echo "checked"; ?> type="radio" name="soc-share-set[placement]" value="dflt" id="dflt" checked />
				<label for="dflt">
					Below Title (Default)
				</label>
				<br/>
				<img src="<?php echo SOCSHAREURL ?>/assets/belowtitle.png" class="placementsmall" /> 
				</td>
				<td width="37.5%">&nbsp;&nbsp;<input <?php if( in_array("left", $optns ) ) echo "checked"; ?> type="radio" name="soc-share-set[placement]" value="left" id="left" />
				<label for="left">
					Floating Left Area
				</label><br/>
				<img src="<?php echo SOCSHAREURL ?>/assets/leftarea.png" class="placementsmall" /> 
				</td></tr>
				<td>&nbsp;&nbsp;<input <?php if( in_array("aftrcntnt", $optns ) ) echo "checked"; ?> type="radio" name="soc-share-set[placement]" value="aftrcntnt" id="aftrcntnt" />
				<label for="aftrcntnt">
					After Content
				</label>
				<br/>
				<img src="<?php echo SOCSHAREURL ?>/assets/postcont.png" class="placementsmall"/> 
			</td>
			<td>&nbsp;&nbsp;<input <?php if( in_array("insdftrdimg", $optns ) ) echo "checked"; ?> type="radio" name="soc-share-set[placement]" value="insdftrdimg" id="insdftrdimg" />
				<label for="insdftrdimg">
					Inside Featured Image
				</label><br/>
				<img src="<?php echo SOCSHAREURL ?>/assets/feat.png" class="placementsmall" /> 
				</td></tr>
			</table>
			<i>Note: "Inside Featured Image" option only works with post having featured Image. Fallback is "Default"</i>
			</p>
			
	</div>
	<?php
}
function add_metas_soc_share($post_id){
	update_post_meta($post_id, 'soc-share-global', sanitize_text_field( $_POST['soc-share-global'] ) );
	update_post_meta($post_id, 'soc-share-set', serialize( $_POST['soc-share-set'] ) );
}

?>