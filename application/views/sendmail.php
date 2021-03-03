<!DOCTYPE html>
<html>
<head>
	<title>Email Sending</title>
</head>
<body>
	<h1>Welcome To Email Page</h1>
	<h3>Send Mail Here!!!</h3>
	<?php if($error = $this->session->flashdata('msg')){ ?>
       <p style="color: green;"><strong>Success!</strong> <?php echo  $error; ?><p>
  <?php } ?>

	<form action="<?php echo base_url(); ?>main/send" method="post">
		<input type="Email" name="from" placeholder="Enter Valid Email"><br>
		<textarea name="message" placeholder="Sending message Here" style="width:500px; height: 100px;"></textarea>
		<button type="submit" name="submit" value="submit">Send Mail</button>
	</form>
</body>
</html>