 
<?php

session_start();

if(!isset($_SESSION['kloggedin']) || $_SESSION['kloggedin'] !==true)
{
    header("location: clogin.php");
}

require_once "config.php";
$login_email = $_SESSION['kemail'];
$hide="";
$job_title = "";
$desc = "";
$salary = "";
$vacancy = "";
$courses= ""; 
$deptartment= "";
$cpicut_of = "";
$examdate = "";
$examduration = "";
$examtype = "";
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $job_title = trim($_POST["job_title"]);
    $desc = trim($_POST["description"]);
    $salary = trim($_POST["salary"]);
    $vacancy = trim($_POST["vacancy"]);
    $courses = ($_POST["eligible_course"]); 
    $deptartment = ($_POST["eligible_dept"]);
    $cpicut_of = trim($_POST["cpi_cutoff"]);
    $examdate = trim($_POST["exam_date"]);
    $examduration = trim($_POST["duration"]);
    $examtype = trim($_POST["exam_type"]);
    $sql4 = "SELECT Cid FROM company_reg WHERE Cemail='$login_email'";
    $CID="";
    $stmt5 = $conn->prepare($sql4);
    if($stmt5){
        $stmt5->execute();
        if($row = $stmt5->fetch()){
            $CID = $row['Cid'];
        }
    $sql = "INSERT INTO job (Cid, job_title, job_description, vacancy, salary, cpi) VALUES ('$CID', '$job_title', '$desc', '$vacancy', '$salary', '$cpicut_of')";
    $stmt = $conn->prepare($sql);
    if ($stmt){
        $stmt->execute();
        $jobID="";
        $sql1 = "SELECT job_id FROM job WHERE Cid = '$CID' and job_title='$job_title'";
        $stmt1 = $conn->prepare($sql1);
        if($stmt1){
            $stmt1->execute();
            if($row = $stmt1->fetch()){
                $jobID = $row['job_id'];
            }

            $sql2 = "INSERT INTO exam VALUES ('$CID', '$jobID', '$examdate', '$examduration', '$examtype')";
            $conn->exec($sql2);
            foreach($deptartment as $dept){
                $sql3 = "INSERT INTO eligibledept (job_id, eligible_dept) VALUES ('$jobID', '$dept')";
                $conn->exec($sql3);
            }
            
            foreach($courses as $course){
                $sql3 = "INSERT INTO eligiblecourse (job_id, eligible_course) VALUES ('$jobID', '$course')";
                $conn->exec($sql3);
            }
        }
        $stmt1 = null;
    }
    $stmt = null;
} 
}
// $sql = "SELECT job_id, job_title, job_description, vacancy, salary, cpi FROM job WHERE job_id = '$jobID";
// $result = $conn->prepare($sql);
// $result->execute();
//     if($row = $result->fetch()){
//         $hide = "display: none";
//         $read="readonly";
//         $cid = $row["Cid"];
//         $company_name = $row["Cname"];
//         $email = $row["Cemail"];
//         $contact = $row["contact"];
//         $sql1 = "SELECT location FROM company_location WHERE Cid = '$cid'";
//         $result1 = $conn->prepare($sql1);
//         $result1->execute();
//         $location = "";
//         while($row1 = $result1->fetch()){
//             $location = $location . $row1['location'] . " ";
//         }
//     }
// $result = null;
$conn = null;

?>
<!DOCTYPE html>
<html lang="en">

<head>  
     <link rel="stylesheet" href="sty.css" /> 
     <script type="text/javascript" src="multi.js"></script>
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
            </li>
            <li class="bold">
                <a aria-label="Navigate to the Projects section" href="applicants.php" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span>Applicants</span></a>
            </li>
             <li class="bold">
                <a aria-label="Navigate to the Experience section" href="logout.php" class="waves-effect waves-dark teal-text"><i
            class=" small"></i><span class="small2">logout</Details></span></a>
            </li>
        </ul>
    </nav>
   
    <form class="form2 st_cp" action="" method="post">
        <h1 class="details">Job Details</h1>
       <hr>
     <div class="reg_form">
        <div class="reg_form1">
         <label class="la">Job Title</label>
        <input type="text" name="job_title" required = 'true' placeholder = "Job Title"><br><br>
        </div>
         <div class="reg_form1">
         <label>Salary</label> 
         <input type="text" name="salary" required = 'true' placeholder = "Salary"><br><br>
        </div>
    </div>
    <div class="reg_form">
        <div class="reg_form1">
        <label>Description</label>
        <input type="text" name="description" required = 'true' placeholder = "job description"><br><br>
        </div>
         <div class="reg_form1">
             <label>Vacancy</label>
             <input type="text" name="vacancy" required = 'true' placeholder = "Vacancy"><br><br>
     
         </div>
    </div>
      
   <div class="reg_form">
        <div class="reg_form1">
      
        <label>department: </label>
        <select name="eligible_dept[]"   required  multiple multiselect-search="true" multiselect-select-all="true">
        
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
    </div><div class="reg_form1">
     <label>Eligible Courses</label>
      <select name="eligible_course[]" required  multiple multiple multiselect-search="true" multiselect-select-all="true">
                                    
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
          </div></div>
          <div class="reg_form">
        <div class="reg_form1">
      
      <label>CPI cutoff </label>
      <input type="text" name="cpi_cutoff" step='0.1' required = 'true' placeholder = "CPI cut-off"><br><br>
    </div> <div class="reg_form1"><label for="type">Exam type</label>
        <input type="radio" name="exam_type" value="online"> online
<input type="radio" name="exam_type" value="offline" > offline
    </div>
</div> <div class="reg_form">
        <div class="reg_form1">
      <label>Exam date </label>
      <input type="date" name="exam_date" step='0.1' required = 'true' >
    </div>
      <div class="reg_form1">
      <label>Exam duration </label>
      <input type="text" name="duration" step='0.1' required = 'true' placeholder = "exam_duration"><br><br>
    </div></div>
       <div class="reg_form reg_form_j">
            <button style="<?php echo $hide?>;" type="submit" class="button_f">Submit</button>
        </div>
</form>

    </body>
    </html>