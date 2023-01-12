
<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
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
   
     <!-- <form class="form2 st_cp" action="" method="POST">
        <h1 class="details">Job Application</h1>
       <hr>
       
    </form> -->
    
<div>
         <?php
            require_once "config.php";
            $hide = "";
            $hide2="style='display: none'";
            $email = $_SESSION['email'];
            if(isset($_REQUEST['apply'])){
                echo "Applied succesfully";
                $hide = "style='display: none'";
                $hide2="";
            $jobid=$_REQUEST['applyId'];
            $rollno=$_REQUEST['applyRoll'];
            $sql3="INSERT INTO apply_for (jobid,rollno) VALUES ('$jobid','$rollno')";
            $stmt= $conn->query($sql3);
            $stmt=null;
            }
            if(isset($_REQUEST['withdraw'])){
            $jobid=$_REQUEST['withdrawId'];
            $rollno=$_REQUEST['withdrawRoll'];
            $sql4="DELETE FROM apply_for WHERE jobid='$jobid' AND rollno='$rollno'";
            $stmt= $conn->query($sql4);
            $stmt=null;

            }
            $sql= "SELECT * FROM job";
            $result= $conn->query($sql);
            if($result->rowCount() > 0){
                echo '<table class="table">';
                echo "<thead>";
                echo "<tr>";
              
                echo "<th>Company Name</th>";
                echo "<th>Job Profile</th>";
                echo "<th>Apply</th>";
                echo "<th>Withdraw</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row=$result->fetch(PDO::FETCH_ASSOC)){

                    $cpicriteria = $row['cpi'];
                    $jobid=$row["job_id"];
                    $eligibledept = "";
                    $eligiblecourse = "";
                    $eligible = "";
                    $roll = $student_cpi = $student_dept = $student_course = "";
                    $sql2 = "SELECT rollno, cpi, Course, department FROM student WHERE Semail = '$email'";
                    $st= $conn->query($sql2);
                        if($dataStudent=$st->fetch()){
                            $roll=$dataStudent['rollno'];
                            $student_cpi = $dataStudent['cpi'];
                            $student_course = $dataStudent['Course'];
                            $student_dept = $dataStudent['department'];
                        }
                    
                    $sql5 = "SELECT eligible_dept FROM eligibledept WHERE job_id = '$jobid' and eligible_dept='$student_dept'";
                    $stmt2 = $conn->query($sql5);
                    $sql6 = "SELECT eligible_course FROM eligiblecourse WHERE job_id = '$jobid' and eligible_course='$student_course'";
                    $stmt3 = $conn->query($sql6);
                    
                    if($stmt2->rowCount()==1 && $stmt3->rowCount()==1){
                        if($cpicriteria<=$student_cpi){
                    

                    echo "<tr>";
                    
                    $cid=$row["Cid"];
                    $sql1 = "SELECT Cname FROM company_reg WHERE Cid = '$cid'";
                    $r= $conn->query($sql1);
                    if($data=$r->fetch()){
                        $cname=$data['Cname'];
                    }
                
                    echo "<td>" . $cname . "</td>";
                    echo "<td>" . $row["job_title"] . "</td>";
                    // echo "<td>" . $row["id"] . "</td>";

                    echo '<td ><form action="" method="POST"><input type="hidden" name="applyId" value=' . $row["job_id"] . ' >
                                    <input type="hidden" name="applyRoll" value=' . $roll . '>
                        <input type="submit" class="btn" name="apply" value="Apply"></form></td>';
                    echo '<td ><form action="" method="POST"><input type="hidden" name="withdrawId" value=' . $row["job_id"] . '>
                            <input type="hidden" name="withdrawRoll" value=' . $roll . '>
                        <input type="submit" class="button_g" name="withdraw" value="Withdraw"  ></form></td>';
                    echo "</tr>";
                }
                }}
                
                echo "</tbody>";
                echo "</table>";

            }
            ?>
</div></div>
    </body>
    </html>
    

