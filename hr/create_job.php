<?php
$conn = new mysqli("localhost", "root", "", "dbhr");

$message = "";

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $skills = $_POST['skills'];
    $min = $_POST['min_score'];

    $conn->query("INSERT INTO jobs(job_title,required_skills,min_score)
VALUES('$title','$skills','$min')");

    $message = "Job Created Successfully!";
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Create Job</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-6">
                <a href="dashboard.php">Dashboard</a>


                <div class="card shadow">

                    <div class="card-header bg-primary text-white">
                        <h4>Create Job Posting</h4>
                    </div>


                    <div class="card-body">

                        <?php if ($message != "") { ?>

                            <div class="alert alert-success">
                                <?php echo $message; ?>
                            </div>

                        <?php } ?>

                        <form method="POST">

                            <div class="mb-3">
                                <label class="form-label">Job Title</label>
                                <input type="text" name="title" class="form-control"
                                    placeholder="Enter job title" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Required Skills</label>
                                <textarea name="skills" class="form-control" rows="4"
                                    placeholder="Example: python, sql, machine learning, data analysis"
                                    required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Minimum Score (%)</label>
                                <input type="number" name="min_score" class="form-control"
                                    placeholder="Example: 60" required>
                            </div>

                            <button type="submit" name="submit"
                                class="btn btn-primary w-100">
                                Create Job
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>