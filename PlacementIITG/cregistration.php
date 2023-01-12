<?php

session_start();

if(!isset($_SESSION['kloggedin']) || $_SESSION['kloggedin'] !==true)
{
    header("location: clogin.php");
}

require_once "config.php";

$login_email = $_SESSION['kemail'];
$hide = "";
$read="";
$company_name = "";
$email = $login_email;
$location = "";
$contact = "";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $company_name = trim($_POST["Cname"]);
    $email = trim($_POST["Cemail"]);
    $location = trim($_POST["location"]);
    $contact = trim($_POST["contact"]);
    $sql = "INSERT INTO company_reg (Cname, Cemail, contact) VALUES ('$company_name', '$email', '$contact')";
    $stmt = $conn->prepare($sql);
    if ($stmt)
    {
        $stmt->execute();

        $cid = "";
        $sql1 = "SELECT Cid FROM company_reg WHERE Cemail = '$email'";
        $stmt1 = $conn->prepare($sql1);
        if($stmt1){
            $stmt1->execute();
            if($row = $stmt1->fetch()){
                $cid = $row['Cid'];
            }

            $space = ' ';
            $words = explode($space,$location);
            foreach($words as $loc){
                $sql2 = "INSERT INTO company_location(Cid, location) VALUES ('$cid', '$loc')";
                $conn->exec($sql2);
            }
        }
    }
    $stmt = null;
} 

$sql = "SELECT Cid, Cname, Cemail, contact FROM company_reg WHERE Cemail = '$login_email'";
$result = $conn->prepare($sql);
$result->execute();
    if($row = $result->fetch()){
        $hide = "display: none";
        $read="readonly";
        $cid = $row["Cid"];
        $company_name = $row["Cname"];
        $email = $row["Cemail"];
        $contact = $row["contact"];
        $sql1 = "SELECT location FROM company_location WHERE Cid = '$cid'";
        $result1 = $conn->prepare($sql1);
        $result1->execute();
        $location = "";
        while($row1 = $result1->fetch()){
            $location = $location . $row1['location'] . " ";
        }
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
                    <img src="My project.png" class="circle img-responsive profile-pic" alt="avatar">
                </a>
            </li>

            <li class="bold">
                <a aria-label="Navigate to the About section" href="cindex.php" class="waves-effect waves-dark teal-text"><i
            class="small"></i><span class="small2" >Home</span></a>
            </li>  
             <li class="bold">
                <a aria-label="Navigate to the Experience section" href="#experience" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span class="small2">Company Details</Details></span></a>
            </li>
            <li class="bold">
                <a aria-label="Navigate to the Experience section" href="jobdetails.php" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span class="small2">Job Details</Details></span></a>
            </li><li class="bold">
                <a aria-label="Navigate to the Projects section" href="applicants.php" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span>Applicants</span></a>
            </li>
            <li class="bold">
                <a aria-label="Navigate to the Experience section" href="logout.php" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span class="small2">logout</Details></span></a>
            </li>
        </ul>
    </nav>
   

    <form class="form2 st_cp" action="" method="POST">
       <h1 class="details">Company Details</h1>
       <hr>
       <div class="nil">
     <div class="reg_form">
        <div class="reg_form1">
        <label class="la" for="fname">Company Name</label>
        <input type="text" id="fname" name="Cname" size="30" placeholder="Enter Company name" value='<?php echo $company_name ?>' required <?php echo $read?>>
        </div>
         <div class="reg_form1">
        <label class="la" for="Semail">Company Email</label>
        <input type="Email" id="Email" name="Cemail" size="30" value='<?php echo $email?>' required readonly>
        </div>
        </div>
        <div class="reg_form">
        
        <div class="reg_form1">
        <label class="la" for="rollno">Job Location</label>
        <input  type="text" id="rollno" name="location" size="30" placeholder="Enter Job location" value='<?php echo $location ?>' required <?php echo $read?>>
        </div>
        <div class="reg_form1">
        <label class="la" for="lname">Contact</Title></label>
        <input type="text" id="lname" name="contact" size="30" placeholder="Enter Contact Number" value='<?php echo $contact ?>' required <?php echo $read?>>
        </div>
        </div>
        
       
        <div class=" reg_form2">
            <button style="<?php echo $hide?>;" type="submit" class="button_f">Submit</button>
        </div>
    </form>
    

    </body>
    </html>
    

