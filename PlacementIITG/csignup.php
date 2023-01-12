<?php
require_once "config.php";

$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "email cannot be blank";
    }
    else{
        $sql = "SELECT id FROM company_login WHERE Cemail = :s_email";
        $stmt = $conn->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(":s_email", $param_email);

            // Set the value of param email
            $param_email = trim($_POST['email']);

            // Try to execute this statement
            if($stmt->execute()){
                // mysqli_stmt_store_result($stmt);
                if($stmt->rowCount() == 1)
                {
                    $email_err = "This Email is already Taken"; 
                }
                else{
                    $email = trim($_POST['email']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
        // mysqli_stmt_close($stmt);
    }

    


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 6){
    $password_err = "Password cannot be less than 6 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $confirm_password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO company_login (Cemail, Cpassword) VALUES (:s_email, :s_password)";
    $stmt = $conn->prepare($sql);
    if ($stmt)
    {
       $stmt->bindParam(":s_email", $param_email);
       $stmt->bindParam(":s_password", $param_password);

        // Set these parameters
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if ($stmt->execute())
        {
            header("location: clogin.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    // mysqli_stmt_close($stmt);
}
$conn==NULL;
}

?>



 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="sty2.css" />
    <style>
        .st_cp2{
            text-align: center;
            background-color: lightpink;
        }
        .pic3{
            display: block;
    justify-content: center;
    height: 20vh;
    margin-left: 8%;
    align-items: center;
        }
        .button:hover {
  background-color: #4CAF50; /* Green */
  color: white;
}
        
    </style>
</head>

<body>

    <div class="st_cp2">
        <div class="pic3">
            <img src="IITG_white.png" alt="">
        
        </div>
        
        <form action="" method="POST">
        <div class="form"> 
            <label class="la" for="email"></label>
            <input type="email" class="form-control" name="email" id="username" placeholder="Enter Your Email">
             
        </div>
          <div class="form">
         
            <label class="la" for="password"></label>
            <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[0-9])(?=.*?[!@#$%^&*_+`~=?\|<>/]).{8,}" class="form-control" name ="password" id="password" placeholder="Enter Your Password">
           
           
        </div>
          <div class="form">
            <label class="la" for="confirm_password"></label>
            <input type="password" class="form-control" name ="confirm_password" id="confirm_password" placeholder="Confirm Password"  >
           
          </div>
           <div class="form2">
            <span> 
                    <?php 
                          if($email_err)echo $email_err;
                          elseif($password_err) echo $password_err;
                          else if($confirm_password_err) echo $confirm_password_err;     
                    ?>
            </span>
           <button type="submit" class="button"><a href="clogin.php" class="signup">Login</a></button>
            
             <button type="submit" class="button">Signup</button>
            </div>
    </form>
       
    </div>
    
</body>


</html>