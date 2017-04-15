


<h1>Add User</h1>
<form action="/MyApplicationFramework/processUserData" method="POST">
	<table border=1>
		<?php foreach(User::$classDetails as $key => $value ) {
			if ( is_array($value) ) { 
				?>		
			<tr>
				<td><?php echo User::$classDetails[$key]['FriendlyName'] ?></td>
				<td>
					<?php if ( User::$classDetails[$key]['FieldType'] == 'TEXT' ) { ?>
						<input 	type="text" 
								name="<?php echo User::$classDetails[$key]['FieldName'] ?>" 
								maxlength="<?php echo User::$classDetails[$key]['VarSize'] ?>" />
					<?php } else if ( User::$classDetails[$key]['FieldType'] == 'EMAIL' ) { ?>
						<input 	type="email" 
								name="<?php echo User::$classDetails[$key]['FieldName'] ?>" 
								maxlength="<?php echo User::$classDetails[$key]['VarSize'] ?>" />
					<?php } else if ( User::$classDetails[$key]['FieldType'] == 'PASSWORD' ) { ?>
						<input 	type="password" 
								name="<?php echo User::$classDetails[$key]['FieldName'] ?>" 
								maxlength="<?php echo User::$classDetails[$key]['VarSize'] ?>" />
					<?php } else { ?>
						What?
					<?php } ?>
				</td>
			</tr>
		<?php
			}		
		} ?>
		<tr>
			<td colspan="2" style="text-align:center;"><button type="submit">Submit me!</button></td>
		</tr>
	</table>
</form>
