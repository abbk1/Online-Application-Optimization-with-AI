
<?php

$conn = new mysqli("localhost","root","","dbhr");
if(isset($_POST['submit'])){
    // var_dump($_POST);die;
$name=$_POST['name']??'';
$email=$_POST['email']??'';
$phone=$_POST['phone']??'';
$job_id=$_POST['job_id'];

 // Handle file upload
    $cv_name = $_FILES['cv']['name'];
    $tmp_name = $_FILES['cv']['tmp_name'];

    // Create uploads folder if it doesn't exist
    if(!is_dir("upload")) {
        mkdir("upload", 0777, true);
    }

    // Save file to uploads folder
    $destination = "upload/" . time() . "_" . $cv_name; // Add timestamp to avoid duplicate names
    move_uploaded_file($tmp_name, $destination);

    $cv_path = $destination;

/* Run Python AI */


$job=$conn->query("SELECT * FROM jobs WHERE job_id=$job_id")->fetch_assoc();

$skills=$job['required_skills'];
$min_score=$job['min_score'];

// Path to Python executable
// $python = "C:\\Users\\ABK\\AppData\\Local\\Programs\\Python\\Python313\\python.exe";
// $python = "C:\Users\ABK\AppData\Local\Programs\Python\Python313\python.exe";
$python = "C:/Users/ABK/AppData/Local/Programs/Python/Python313/python.exe";


// Absolute path to Python script
$python_script =  "C:/xampp/htdocs/arketic_ai/ai/ai_analyzer.py";

// echo "Script: $python_script\n";die;
// Absolute path to uploaded CV
// $cv_path = realpath($cv_path); 

// Build command
$command = "\"$python\" \"$python_script\" \"$cv_path\" \"$skills\" $min_score 2>&1";

// Debug: check command
// var_dump($command);

// Run Python
$output = shell_exec($command);

// Debug: see raw output
// var_dump($output);die;

// Decode JSON
$data = json_decode($output, true);

// Debug
if($data === null){
    die("JSON decode failed. Output was: " . $output);
}


$score=$data['score'];
$status=$data['status'];

$matched_skills = implode(", ", $data['matched_skills']);
$missing_skills = implode(", ", $data['missing_skills']);

$sql="INSERT INTO `candidates`(`name`, `email`, `skills`,`matched_skills`,`missing_skills`, `cv_file`, `ai_score`, `ai_decision`, `created_at`, `job_id`) 
VALUES ('$name','$email','$skills','$matched_skills','$missing_skills','$destination','$score','$status', NOW(),'$job_id')";

$conn->query($sql);

echo "Application Submitted";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>AI Recruitment Form</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

<h2>Job Application</h2>
<span><a href="../hr/dashboard.php">Dashboard</a></span>

<form action="apply.php" method="POST" enctype="multipart/form-data">

<input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>

<input type="email" name="email" class="form-control mb-3" placeholder="Email">

<input type="text" name="phone" class="form-control mb-3" placeholder="Phone">

<select name="job_id" class="form-control mb-3">
    <?php 
    $jobs = $conn->query("SELECT * FROM jobs");
    while($job = $jobs->fetch_assoc()){
        echo "<option value='".$job['job_id']."'>".$job['job_title']."</option>";
    }
    ?>
</select>

<label>Upload CV</label>
<input type="file" name="cv" class="form-control mb-3" required>

<button class="btn btn-primary" type="submit" name="submit">Submit Application</button>

</form>

</body>
</html>