<?php if ( ! defined('ABSPATH')) exit; ?>
 
<div class="wrap">
    
    <?php
    if($this->logged_in){
      
    } else {
    ?>
 
	<form method="post">
		<table class="form-table">
			<tr>
				<td>User</td> 
				<td><input name="userdata[user]"></td>
			</tr>
			<tr>
				<td>Password </td>
				<td><input type="password" name="userdata[user_password]"></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Enter"> 
				</td>
			</tr>
                        <tr>
				<td colspan="2">
                                    <input type="checkbox" name="userdata[continuar_conectado]" value="1"> 
				</td>
			</tr>
		</table>
	</form>
    <?php } ?>
	
</div> <!-- .wrap -->

