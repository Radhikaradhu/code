<!DOCTYPE html>
<html>
<head>
	<title>updation</title>
	<style>
		fieldset{
			padding: 10px;
			margin-left:450px;
			text-align:center;
		}
		input{
			padding:10px;
			margin-top: 5px;
			text-align:center;
		}
		textarea{

			margin-top: 5px;
			text-align:center;
		}body
        {
            background-image: url(../img/8.jpg);
            background-size:cover;
            width: 600px;
        }


	</style>
</head>
<body>
    <a href="<?php echo base_url()?>main/sdash">Back To dashboard</a>
	<form action="<?php echo base_url()?>main/updatdetails" method="POST">
       <?php
        if(isset($user_data))
        {
            foreach($user_data->result() as $row1) 
            {
                ?>

		
		<input type="text" name="fname" placeholder="First Name" value="<?php echo $row1->fname;?>"></br>

        <input type="text" name="lname" placeholder="Last Name" value="<?php echo $row1->lname;?>"></br>

        <input type="email" name="email" placeholder="Email Address" value="<?php echo $row1->email;?>"></br>

        <input type="text" name="number" placeholder="Phone Number" value="<?php echo $row1->number;?>"></br>

        <input type="date" name="dob" placeholder="Date Of Birth" value="<?php echo $row1->dob;?>"></br>

        <input type="text" name="addr" placeholder="Address" value="<?php echo $row1->addr;?>"></br>

        <input type="text" name="dis" placeholder="District" value="<?php echo $row1->dis;?>"></br>

        <input type="text" name="pin" placeholder="Pin Number" value="<?php echo $row1->pin;?>"></br>

        <input type="text" name="uname" placeholder="User Name" value="<?php echo $row1->uname;?>"></br>

        <input type="text" name="password" placeholder="password" value="<?php echo $row1->password;?>"></br>

	    <input type="hidden" name="id" value="<?php echo $row1->id; ?>">
        <button type="submit" name="update"  value="update">Update</button>

         </form>
    <?php
}
    }
?>
  

  
</body>
</html>