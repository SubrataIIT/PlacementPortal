<?php

session_start();

if(!isset($_SESSION['kloggedin']) || $_SESSION['kloggedin'] !==true)
{
    header("location: clogin.php");

}?>
<!DOCTYPE html>
<html lang="en">

<head>
     <link rel="stylesheet" href="sty.css" /> 
   <style> 
    
        * {
            margin: 0px;
            padding: 0px;
        }
        
        table {
            margin:2%;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    background-color: white;
    width: 80vw;
    }

    td, th {
        margin:1%;
    border: 1px solid #dddddd;
    text-align: left;
    padding:8px;
}
     
    </style> 


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
                <a aria-label="Navigate to the Experience section" href="logout.php" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span class="small2">logout</Details></span></a>
            </li>
        </ul>
    </nav>
   
   
     <!-- <form class="form2 st_cp" action="" method="POST">
        <h1 class="details">Job Application</h1>
       <hr>
       
    </form> -->
    
<div>
<?php
            require_once "config.php";


            $email = $_SESSION['kemail'];
            $ID = 0;
            $hide = "";
            $cid = $jobID = "";
          

            if(isset($_REQUEST['offer'])){
                $jobid=$_REQUEST['applyId'];
                $roll=$_REQUEST['applyRoll'];
                $sql3="INSERT INTO get_offer (job_id,rollno) VALUES ('$jobid','$roll')";
                $stmt4= $conn->query($sql3);
                $stmt4=null;
            }

            $stmt = $conn->query("SELECT Cid FROM company_reg WHERE Cemail='$email'");
            if($row=$stmt->fetch()) $cid=$row['Cid'];

            echo '<table class="table">';
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Student Roll no.</th>";
            echo "<th>Student Name</th>";
            echo "<th>Job Profile</th>";
            echo "<th>Student Mail</th>";
            echo "<th >Contact No.</th>";
            echo "<th>Give Offer</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            $stmt2 = $conn->query("SELECT job_id,job_title from job WHERE Cid='$cid'");
            while($row = $stmt2->fetch()){
            $jobID = $row['job_id'];
            $jobtitle = $row['job_title'];
            $sql= "SELECT * FROM apply_for WHERE jobID=$jobID";
            $result= $conn->query($sql);

            
            if($result->rowCount() > 0){
            
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                $rollno= $fname = $lname = $student_mail = $mobile = "";
                $rollno = $row['rollno'];
                $sql2 = "SELECT Fname, Lname, Semail, Phone_NO FROM student WHERE rollno = '$rollno'";
                $stmt3= $conn->query($sql2);
                    if($dataStudent=$stmt3->fetch()){
                        $fname = $dataStudent['Fname'];
                        $lname = $dataStudent['Lname'];
                        $student_mail = $dataStudent['Semail'];
                        $mobile = $dataStudent['Phone_NO'];
                    }
                    $ID++;

                echo "<tr>";
                echo "<td>" . $ID . "</td>";
                echo "<td>" . $rollno . "</td>";
                echo "<td>" . $fname . " " . $lname . "</td>";
                echo "<td>" . $jobtitle . "</td>";
                echo "<td>" . $student_mail . "</td>";
                echo "<td>" . $mobile . "</td>";

                if($conn->query("SELECT * FROM get_offer WHERE job_id='$jobID' and rollno='$rollno'")->rowCount()>0){
                    $hide = "style= 'display:none'";
                }
                else{
                    $hide = "";
                }
                echo '<td '. $hide . '><form action="" method="POST"><input type="hidden" name="applyId" value=' . $jobID . '>
                <input type="hidden" name="applyRoll" value=' . $rollno . '>
                <input type="submit" class="applybtn" name="offer" value="Give Offer"></form></td>';
                echo "</tr>";
        }
        }
        }
        echo "</tbody>";
        echo "</table>";
            ?>
</div></div>
    </body>
</html>