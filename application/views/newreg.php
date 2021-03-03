</!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>     
    </style>
    <script type="text/javascript">
        function validateform()
        {  
            var fname=document.myform.fname.value;
            var lname=document.myform.lname.value; 
            var uname=document.myform.uname.value; 
            var password=document.myform.password.value;
            var number=document.myform.number.value;
            var email=document.myform.email.value; 
              
            if (fname.length<5)
            {  
              alert("First Name must be at least 5 characters long.");  
              return false;  
            }
            else if(lname.length<5)
            {  
              alert("Last Name must be at least 5 characters long.");  
              return false;  
            }
            else if(lname.length<5)
            {  
              alert("User Name Must be 5 characters");  
              return false;  
            }
            else if(password.length<6)
            {  
              alert("Password must be at least 6 characters long.");  
              return false;  
            } 

            else if(number.length<10)
            {  
              alert("Mobile must be 10 numbers long.");  
              return false;  
            } 
            else if(email==null || email=="")
            {  
              alert("Email Cannot be null.");  
              return false;  
            }  
        }
    </script>
</head>
<body>
    
    <form method="post" name="myform" action="<?php echo base_url()?>main/reg" onsubmit="return validateform()">

    <fieldset style="width:100%">
        <legend> Register</legend>
        <input type="text" name="fname" placeholder="First Name" required="This field must be required"><br><br>

        <input type="text" name="lname" placeholder="Last Name" required=""><br><br>
        
        <input type="email" name="email" placeholder="Email"><br><br>

        <input type="text" name="number" placeholder="Mobile number" required=""><br><br>

        <input type="date" name="dob" placeholder="Date Of Birth"><br><br>

        <input type="text" name="addr" placeholder="Address"><br><br>

        <input type="text" name="dis" placeholder="District"><br><br>

        <input type="text" name="pin" placeholder="Pincode"><br><br>

        <input type="text" name="uname" placeholder="User Name" required=""><br><br>

        <input type="password" name="password" placeholder="Enter Password"
        pattern="(?=.*[!@#$%^&*])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one special character and at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
         required=""><br><br>

                <input type="submit" name="submit">
    </fieldset>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>  
 $(document).ready(function(){  
      $('#email').change(function(){  
           var email = $('#email').val();  
           if(email != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main1/email_availibility",  
                     method:"POST",  
                     data:{email:email},  
                     success:function(data){  
                          $('#email_result').html(data);  
                     }  
                });  
           }  
      });  

      $('#phno').change(function(){  
           var phno = $('#phno').val();  
           if(phno != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main1/phno_availability",  
                     method:"POST",  
                     data:{phno:phno},  
                     success:function(data){  
                          $('#phno_result').html(data);  
                     }  
                });  
           }  
      });  
       $('#uname').change(function(){  
           var uname = $('#uname').val();  
           if(uname != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main1/uname_availability",  
                     method:"POST",  
                     data:{uname:uname},  
                     success:function(data){  
                          $('#uname_result').html(data);  
                     }  
                });  
           }  
      });  
 }); 
 </script> 
</body>
</html>