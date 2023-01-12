<?php
session_start();
if(!isset($_SESSION['kloggedin']) || $_SESSION['kloggedin']!==true){
    header("location: clogin.php");
}

                 require_once "config.php";
                 $email = $_SESSION['kemail'];
                 $Cname="xxxxx";
                 $Cemail="xxxx@gmail.com";
                 $contact="xxxxxx";
                 $sql1 = "SELECT CName,Cemail,contact FROM company_reg WHERE Cemail= '$email' ";
                 $stmt1 = $conn->prepare($sql1);
                 if($stmt1){
                     $stmt1->execute();
                     if($row = $stmt1->fetch()){
                         $Cname = $row['CName'];
                         $Cemail = $row['Cemail'];
                         $contact = $row['contact'];
                         
                     }
                    
                    }
            

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
                <a aria-label="Navigate to the About section" href="cindex.php" class="waves-effect waves-dark teal-text"><i
            class="small"></i><span class="small2" >Home</span></a>
            </li>  
             <li class="bold">
                <a aria-label="Navigate to the Experience section" href="cregistration.php" class="waves-effect waves-dark teal-text"><i
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
                <a aria-label="Navigate to the Skills section" href="logout.php" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span>logout</span></a>
            </li>
        </ul>
    </nav>

                       
<form class="form2 st_cp">
    <div ><h1 class="hea"></h1></div>
    <div class="reg_form">
        <div class="reg_form1">
            <h3>Company Name</h3>
            <h3><?php echo $Cname?></h3>
         </div>
        
        </div>
        <div class="reg_form">
        <div class="reg_form1">
            <h3>Company Email</h3>
            <h3><?php echo $Cemail?></h3>
        </div>
        
       </div>
        </div>
        <div class="reg_form">
        <div class="reg_form1">
            <h3>Mobile No</h3>
          <h3><?php echo  $contact ?></h3>
       </div>
                </div>
        <!-- </div>
        // <div class="reg_form">
        // <div class="reg_form1">
        //      <h3>Department</h3>
        //   <h3><?php echo $department?></h3>
        // </div>
        // <div class="reg_form1">
        //      <h3>Course</h3>
        //   <h3><?php echo $course?></h3>
        // </div>
        // </div>
        // <div class="reg_form">
        // <div class="reg_form1">
        //      <h3>Cpi</h3>
        //   <h3><?php echo $cpi?></h3>
        //  </div>
        // <div class="reg_form1">
        //     <h3>No of Application</h3>
        //     <h3><?php echo $no_application?></h3>
        // </div>
        // </div> -->
</form>
    </body>
    </html>