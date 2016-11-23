<?php
/* 
Settings page of the plugin
 */
 
 //Saving the options
if( isset( $_POST[ 'saveoptions' ] ) ){
	update_option( 'soc-share-set', serialize( $_POST ) );
}
$optns = unserialize( get_option( 'soc-share-set' ) );
?>
<div class="wrap soc-settings">
	<h1>Soc Share Global Settings</h1>
	<form action="" method="post">
		<p class="input_wrap input_wrap_display">
			<div class="heading"> Display On: </div>
			<?php
				//Getting all registered public post types, except attachment
				$pst_typs = get_post_types( array( 'public' => true ), 'objects' );
				foreach( $pst_typs as $pst_typ ) if( $pst_typ->name <> 'attachment' ){
				?>
					<div class="content">
						<input <?php if( in_array($pst_typ->name, $optns['display_on'] ) ) echo "checked"; ?> type="checkbox" class="other" name="display_on[]" value="<?php echo $pst_typ->name; ?>" />
						<div class="Switch Round">
							<div class="Toggle"></div>		
						</div>
						<?php echo $pst_typ->labels->name; ?>
					</div>
				<?php
				}
			?>
		</p>
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
			if( is_array( $optns[ 'soc_netwrks' ] ) )
				$srtdsns = array_merge( $optns[ 'soc_netwrks' ], $sns );
			else
				$srtdsns = $sns;
			$srtcntr = 1;
			foreach( $srtdsns as $snid => $sn ){
			?>
				<div class="content">
				<span class="row_hldr" position="<?php echo $srtcntr++; ?>">
					<span class="inputelements">
						<input <?php if( in_array( $sn, $optns[ 'soc_netwrks' ] ) ) echo "checked"; ?> type="checkbox" name="soc_netwrks[<?php echo $snid; ?>]" id="<?php echo $snid; ?>" value="<?php echo $sn; ?>" />
						
						<label for="<?php echo $snid; ?>"><?php echo $sn; ?></label>
					</span>
					<img src="<?php echo SOCSHAREURL ?>/assets/upArrow.png" class="moveup" /> 
					<img src="<?php echo SOCSHAREURL ?>/assets/downArrow.png" class="movedown" />
				</span>
				
				</div>

			<?php 
			} 
			?>
			<i> Note: WhatsApp works on mobile devices only!</i>
			
		</p>
		<p class="input_wrap input_wrap_sizes">
			<table class="sizes_table" >
			
			<tr><td rowspan="2" class="head">
			Sizes: 
			</td>
			<td>
			<input <?php if( in_array("lrg", $optns ) ) echo "checked"; ?> type="radio" name="size" value="lrg" id="lrg" />
			<label for="lrg">
				Large
			</label></td>
			<td>
			<input <?php if( in_array("mdm", $optns ) ) echo "checked"; ?> type="radio" name="size" value="mdm" id="mdm" />
			<label for="mdm">
				Medium
			</label></td>
			<td>
			<input <?php if( in_array("sml", $optns ) ) echo "checked"; ?> type="radio" name="size" value="sml" id="sml" />
			<label for="sml">
				Small
			</label>
		</td></tr>
	
		<tr>
		
		<td><img src="<?php echo SOCSHAREURL ?>/assets/tray.png" class="large"/></td>
		<td><img src="<?php echo SOCSHAREURL ?>/assets/tray.png" class="med"/></td>
		<td><img src="<?php echo SOCSHAREURL ?>/assets/tray.png" class="small"/></td>
		</tr>
		</table>
			</p>
		<!--<p class="input_wrap input_wrap_clrs">-->
			<div class="heading"> Colors: </div>
			<div class="content">
			<label for="color">Original </label>
			<input id="color" <?php if( in_array("original", $optns ) ) echo "checked"; ?> type="checkbox" name="color" value="original"  /> 
			<span <?php if( in_array("original", $optns ) ) echo "style='display:none'"; ?> class="row_hldr1">Custom <input readonly class="jscolor" onChange="ths=this; $('#customcolor').val(ths.value);" value="<?php echo $optns['customcolor'] ?>"></span>
			<input id="customcolor" type="hidden" value="<?php echo $optns['customcolor'] ?>" name="customcolor"/></div>
		<!--</p>-->
		<p class="input_wrap input_wrap_plcmnt">
			<table class="sizes_table">
			<tr>
			<td class="head" rowspan="2">Placement options: </td>
			<td width="37.5%">&nbsp;&nbsp;<input <?php if( in_array("dflt", $optns ) ) echo "checked"; ?> type="radio" name="placement" value="dflt" id="dflt" checked />
			<label for="dflt">
				Below Title (Default)
			</label><br/>
			<img src="<?php echo SOCSHAREURL ?>/assets/belowtitle.png" class="placement" /> 
			</td>
			<td width="37.5%">&nbsp;&nbsp;<input <?php if( in_array("left", $optns ) ) echo "checked"; ?> type="radio" name="placement" value="left" id="left" />
			<label for="left">
				Floating Left Area
			</label><br/>
			<img src="<?php echo SOCSHAREURL ?>/assets/leftarea.png" class="placement" /> 
			</td></tr>
			<td>&nbsp;&nbsp;<input <?php if( in_array("aftrcntnt", $optns ) ) echo "checked"; ?> type="radio" name="placement" value="aftrcntnt" id="aftrcntnt" />
			<label for="aftrcntnt">
				After Content
			</label><br/>
			&nbsp;&nbsp;<img src="<?php echo SOCSHAREURL ?>/assets/postcont.png" class="placement"/> 
			</td>
			<td>&nbsp;&nbsp;<input <?php if( in_array("insdftrdimg", $optns ) ) echo "checked"; ?> type="radio" name="placement" value="insdftrdimg" id="insdftrdimg" />
			<label for="insdftrdimg">
				Inside Featured Image
			</label><br/>
			<img src="<?php echo SOCSHAREURL ?>/assets/feat.png" class="placement" /> 
			</td></tr>
			</table>
			<i>Note: "Inside Featured Image" option only works with post having featured Image. Fallback is "Default"</i>
		</p>
		<p class="input_wrap input_wrap_submit">
			<input type="submit" name="saveoptions" value="Save Settings" />
		</p>
	</form>
</div>