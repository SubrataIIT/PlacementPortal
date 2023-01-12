<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}

require_once "config.php";


$login_email = $_SESSION['email'];
$no_application = "";
$hide = "";
$read="";
$firstname ="";
$lastname = "";
$iitgmail = $login_email;
$rollno = "";
$mobile = "";
$gender = "";
$dob = "";
$department ="";
$course =  "";
$cpi = "";
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    // $hide = "display: none";
   
    $firstname = trim($_POST["Fname"]);
    $lastname = trim($_POST["Lname"]);
    $iitgmail = trim($_POST["Semail"]);
    $rollno = trim($_POST["rollno"]);
    $mobile = trim($_POST["mobile"]);
    $gender = trim($_POST["gender"]);
    $dob = trim($_POST["dob"]);
    $department = trim($_POST["department"]);
    $course = trim($_POST["course"]);
    $cpi = trim($_POST["cpi"]);
    $sql = "INSERT INTO student (Fname, Lname, Semail,  rollno, Phone_No, gender, Dob, department, Course, cpi) VALUES ('$firstname', '$lastname', '$iitgmail',  '$rollno', '$mobile', '$gender', '$dob', '$department', '$course', '$cpi' )";
    $stmt = $conn->prepare($sql);
    if ($stmt)
    {
        $stmt->execute();
    }
    $stmt = null;
}

$sql = "SELECT NO_of_application, Fname, Lname, Semail, rollno, Phone_NO, gender, Dob, department, Course, cpi FROM student WHERE Semail = '$login_email'";
$result = $conn->prepare($sql);
$result->execute();
    if($row = $result->fetch()){
        $no_application = $row['NO_of_application'];
        $hide = "style='display: none'";
        $read="readonly";
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
                <a id="logo-container" aria-label="Navigate to the beginning of the page" href="#intro" class="brand-logo ">
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
   
    <form class="form2 st_cp" action="" method="POST">
        <h1 class="details">Registration</h1>
        <div></div>
       <hr>
        <div class="reg_form">
        <div class="reg_form1">
        <label class="la"  for="fname">First Name</label>
        <input type="text" id="fname" name="Fname" size="30" placeholder="Enter First Name" value='<?php echo $firstname?>' required <?php echo $read?>>
        </div>
        <div class="reg_form1">
        <label class="la"  for="lname">Last Name</label>
        <input type="text" id="lname" name="Lname" size="30" placeholder="Enter Last Name"value='<?php echo $lastname?>' required <?php echo $read?>>
        </div>
        </div>
        <div class="reg_form">
        <div class="reg_form1">
        <label class="la"  for="Semail">Email</label>
        <input type="Email" id="Email" name="Semail" size="30" value='<?php echo $login_email?>' required <?php echo $read?>>
        </div>
        <div class="reg_form1">
        <label class="la"  for="rollno">Roll No</label>
        <input  type="text" id="rollno" name="rollno" size="30" placeholder="Enter your Roll No"value='<?php echo $rollno?>'required <?php echo $read?>>
        </div>
        </div>
        <div class="reg_form">
        <div class="reg_form1">
        <label class="la"  for="Birthday">Date of Birth</label>
        <input type="date" id="dob" name="dob" placeholder="Enter Date of Birth" value='<?php echo $dob?>' required <?php echo $read?>>
        </div>
        <div class="reg_form1">
        <label class="la"  for="male">Gender</label>
        <input type="radio" name="gender" value="male"> Male
<input type="radio" name="gender" value="female" > Female

        </div>
        </div>
        <div class="reg_form">
        <div class="reg_form1">
        <label class="la"  for="phno">Phone No</label>
        <input type="text" id="phno" name="mobile" size="30"placeholder="Enter your Mobile No"value='<?php echo $mobile?>' required <?php echo $read?>>
        </div>
        <div class="reg_form1">
        <label class="la"  for="dept">Department</label>
       
        <select name="department"value=<?php echo $department?> required <?php echo $read?>>
                                    <option value="" disabled selected><?php echo $department ?></option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Computer Science and Engineering">Computer Science and Engineering</option>
                                    <option value="Physics">Physics</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Electronics & Electrical Engineering">Electronics & Electrical Engineering</option>
                                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                                    <option value="Civil Engineering">Civil Engineering</option>
                                    <option value="Design">Design</option>
                                    <option value="Chemical Engineering">Chemical Engineering</option>
                                    </select>
        </div>
        </div>
        <div class="reg_form">
        <div class="reg_form1">
        <label class="la" ><div>Course</div></label>
        <select name="course" required <?php echo $read?>>
                                    <option value="" disabled selected ><?php echo $course ?></option>
                                    <option value="MSc Mathematics & Computing">MSc Mathematics & Computing</option>
                                    <option value="MSc Physics">MSc Physics</option>
                                    <option value="MSc Chemistry">MSc Chemistry</option>
                                    <option value="BTech CSE">BTech CSE</option>
                                    <option value="BTech EEE">BTech EEE</option>
                                    <option value="BTech Mechanical Engineering">BTech Mechanical Engineering</option>
                                    <option value="BTech Civil Engineering">BTech Civil Engineering</option>
                                    <option value="Design (BDes)">Design (BDes)</option>
                                    <option value="BTech Chemical Engineering">BTechChemical Engineering</option>
                                    <option value="MTech CSE">MTech CSE</option>
                                    <option value="MTech EEE">MTech EEE</option>
                                </select>
        </div>
        <div class="reg_form1">
        <label class="la"  for="cpi">CPI</label>
        <input type="text" id="cpi" name="cpi" size="30" placeholder="Enter your cpi" value='<?php echo $cpi?>'required <?php echo $read?>>
        </div>
        </div>
        <div class="reg_form2 ">
            <button <?php echo $hide?>; type="submit" class="button_f">Submit</button>
        </div>
    </form>
    

    </body>
    </html>
    

