<!DOCTYPE html>
<html>
	<head>
		<title></title>
        <style>
        	fieldset{
        		width:50px;
        		margin-top:15%;
        		margin-left:35%; 
        	}

        </style>
	</head>
	<body>
		<form method="post" action="<?php echo base_url()?>main/login">
			<fieldset>
				<legend>Reset Password</legend>
			<table>

			<tr>
				<td><h2>Password:<h2></td>
			    <td><input type="password" name="email" placeholder="Password"></td>
			<tr>
				<td><h2>Confirm Password:</h2></td>
			   <td><input type="password" name="password" placeholder="Confirm Password"></td>
			</tr>  
			<tr>			
				<td ><input type="submit" name="submit" value="Reset Password" ></td>
			</tr>
			</table>
            </fieldset>
	</form>
	</body>	
</html>  