<?php

	if ( ! defined( 'ABSPATH' ) ) exit; 
 
	$option = get_option('azplugin-option');			 
?>

<div class="wrap">

	<h2><?php _e('Az plugin options','az-plugin'); ?></h2>
	
	<form action="" method="post">
	
		<table class="form-table">
			<tr>
				<th scope="row"><label for="option"><?php _e('Option','az-plugin'); ?></label></th>
				<td> <input type="text" name="option" value="<?=$option?>"> <?=$option?> </td>
			</tr>		
		</table>
	
		<?php submit_button();?>
		
	</form>
	
</div>