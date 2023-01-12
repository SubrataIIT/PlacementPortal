<?php
session_start();
if(isset($_SESSION['email']))
{
    header("location: index.php");
    exit;
}
require_once "config.php";

$email = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['email'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password</br>";
    }
    else{
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, Semail, Spassword FROM student_login WHERE Semail = '$email'";
    $stmt = $conn->prepare($sql);
    
    // Try to execute this statement
    if($stmt->execute()){
       
        if($stmt->rowCount() == 1)
                {
                    // mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    // echo "<h1> $password - $username</h1>";
                    if($row=$stmt->fetch()){
                        $id=$row['id'];
                        $email=$row['Semail'];
                        $hashed_password=$row['Spassword'];
                    }

                    if($stmt->fetch())
                    $param_password = password_hash($password, PASSWORD_DEFAULT);
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            session_start();
                            $_SESSION["email"] = $email;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: index.php");
                            
                        }
                        else {
                          $err = "Wrong Password Please try again.</br>";
                        }
                    }

                }
                else{
                  $err = "No such user exist</br>";
                }

    }
}    


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
        .form{
            text-align: center;
            
        }
        .st_cp{
            background-color: lightpink;
        }
        .button:hover {
  background-color: #4CAF50; /* Green */
  color: white;
}
        
    </style>
    
</head>

<body>
    <div class="st_cp">
        <div class="pic1">
            <img src="IITG_white.png" alt="">
        </div>
        
        <div class="form">
           
        </div>
        <form action="" method="post">
        <div class="form"> 
             <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
    
        </div>
          <div class="form">
             <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
   
          </div>
           <div>
            <button type="submit" class="button"><a href="signup.php" class="signup">Signup</a></button>
            <button type="submit" class="button">Login</button>
           </div>
    </form>
       
    </div>
    
    
</body>


</html>