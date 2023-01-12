<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
    header("location: login.php");
}
require_once "config.php";

$login_email = $_SESSION['email'];
$no_application = "xxx";
$firstname ="xxx";
$lastname = "";
$iitgmail = $login_email;
$rollno = "xxxxxxxxx";
$mobile = "xxxxxxxxx";
$gender = "xxxx";
$dob = "xx-xx-xxxx";
$department ="xxxxxxxxx";
$course =  "xxxxxxxxx";
$cpi = "xxxx";

$sql = "SELECT NO_of_application, Fname, Lname, Semail, rollno, Phone_NO, gender, Dob, department, Course, cpi FROM student WHERE Semail = '$login_email'";
$result = $conn->prepare($sql);
$result->execute();
    if($row = $result->fetch()){
        $no_application = $row['NO_of_application'];
        
       
        $firstname = $row["Fname"];
        $lastname = $row["Lname"];
        $iitgmail = $row["Semail"];
        
        $rollno = $row["rollno"];
        $mobile = $row["Phone_NO"];
        $gender = $row["gender"];
        
        $dob = $row["Dob"];
        $department = $row["department"];
        $course = $row["Course"];
        $cpi = $row["cpi"];
    }
$result = null;
$conn = null;
?>


<!DOCTYPE html>
<html lang="en">

<head> 
     <link rel="stylesheet" href="sty.css" /> 
  </head>

<body>
    <!-- Google Tag Manager (noscript) -->
   <div class="bd">
    <nav class="hide-on-small-only navbar">
        <ul class="side-nav fixed section table-of-contents">

            <li class="logo">
                <a id="logo-container" aria-label="Navigate to the beginning of the page" href="#intro" class="brand-logo grey-blue-text">
                    <img src="logo_iitg.jpeg" class="circle img-responsive profile-pic" alt="avatar">
                </a>
            </li>

            <li class="bold">
                <a aria-label="Navigate to the About section" href="index.php" class="waves-effect waves-dark teal-text"><i
            class="small"></i><span class="small2" >Home</span></a>
            </li>
            <li class="bold">
                <a aria-label="Navigate to the Experience section" href="registration.php" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span class="small2">Registration</span></a>
            </li>

            <li class="bold">
                <a aria-label="Navigate to the Projects section" href="job_application.php" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span>Job Application</span></a>
            </li>
            
             <li class="bold">
                <a aria-label="Navigate to the Skills section" href="logout.php" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span>logout</span></a>
            </li>

            
        </ul>
    </nav>
 <form class="form2 st_cp">
    <div ><h1 class="hea"></h1></div>
    <div class="reg_form">
        <div class="reg_form1">
            <h3>Name</h3>
            <h3><?php echo $firstname?><?php echo $lastname?></h3>
         </div>
        <div class="reg_form1">
            <h3>Email</h3>
            <h3><?php echo $iitgmail?></h3>
        </div>
        </div>
        <div class="reg_form">
        <div class="reg_form1">
            <h3>Roll No</h3>
            <h3><?php echo $rollno?></h3>
        </div>
        <div class="reg_form1">
            <h3>DoB</h3>
            <h3><?php echo $dob?></h3>
       </div>
        </div>
        <div class="reg_form">
        <div class="reg_form1">
            <h3>Gender</h3>
          <h3><?php echo $gender?></h3>
       </div>
        <div class="reg_form1">
        <h3>Phone No</h3>
          <h3><?php echo $mobile?></h3>
        </div>
        </div>
        <div class="reg_form">
        <div class="reg_form1">
             <h3>Department</h3>
          <h3><?php echo $department?></h3>
        </div>
        <div class="reg_form1">
             <h3>Course</h3>
          <h3><?php echo $course?></h3>
        </div>
        </div>
        <div class="reg_form">
        <div class="reg_form1">
             <h3>Cpi</h3>
          <h3><?php echo $cpi?></h3>
         </div>
        <div class="reg_form1">
            <h3>No of Application</h3>
            <h3><?php echo $no_application?></h3>
        </div>
        </div>
</form>
    </body>
    </html>