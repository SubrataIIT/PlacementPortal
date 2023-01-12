<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['role']) && (($_POST['role'])== "Student" ||($_POST['role'])== "Admin") ){
        header("Location: index.php");
    }
    else if(isset($_POST['role']) && ($_POST['role'])== "Company"){
        header("Location: clogin.php");
    }
    else{
        header("Location: start.php"); 
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
            <p>Select a Role</p>
        </div>
        <form action="" method="POST">
        <div class="form"> 
             <input type="radio" id="Student" name="role" value="Student">
             <label for="student" >Student</label>
        </div>
          <div class="form">
            <input type="radio" id="Company"   name="role" value="Company" >
            <label for="company">Company</label>
          </div>
          <!-- <div class="form">
            <input type="radio" id="Admin"   name="role" value="Admin">
            <label for="Admin">Admin</label>
          </div> -->
           <button type="submit" class="button">Continue</button>
            
        </form>
       
    </div>
    
</body>


</html>