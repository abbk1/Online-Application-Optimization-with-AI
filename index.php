<?php
$conn = new mysqli("localhost","root","","dbhr");
$jobs = $conn->query("SELECT * FROM jobs");
?>

<!DOCTYPE html>
<html>
<head>
<title>Available Jobs</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="mb-4">Available Job Openings</h2>

<div class="row">

<?php while($job=$jobs->fetch_assoc()){ ?>

<div class="col-md-4">

<div class="card mb-4 shadow-sm">

<div class="card-body">

<h5 class="card-title">
<?php echo $job['job_title']; ?>
</h5>

<p class="card-text">
<b>Required Skills:</b><br>
<?php echo $job['required_skills']; ?>
</p>

<p>
<b>Minimum Score:</b>
<?php echo $job['min_score']; ?>%
</p>

<a href="apply.php?job_id=<?php echo $job['id']; ?>"
class="btn btn-primary">
Apply Now
</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>