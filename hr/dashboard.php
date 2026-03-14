<?php
$conn = new mysqli("localhost", "root", "", "dbhr");

$jobs = $conn->query("SELECT COUNT(*) as total FROM jobs")->fetch_assoc();
$applications = $conn->query("SELECT COUNT(*) as total FROM candidates")->fetch_assoc();

$result = $conn->query("
SELECT candidates.*, jobs.job_title
FROM candidates
JOIN jobs ON candidates.job_id = jobs.job_id
ORDER BY candidates.id DESC
");
// var_dump($result);die;
?>

<!DOCTYPE html>
<html>

<head>

    <title>HR Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container-fluid">

            <a class="navbar-brand" href="#">AI Recruitment</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="menu">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="create_job.php">Create Job</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="applications.php">Applications</a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>


    <div class="container mt-4">

        <h3 class="mb-4">Admin Dashboard</h3> <span><a href="../applicant/apply.php">Apply for Job</a></span>

        <!-- STATS -->

        <div class="row">

            <div class="col-md-6">

                <div class="card text-center shadow">

                    <div class="card-body">

                        <h2><?php echo $jobs['total']; ?></h2>

                        <p class="text-muted">Total Jobs</p>

                        <a href="create_job.php" class="btn btn-primary">
                            Create Job
                        </a>

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="card text-center shadow">

                    <div class="card-body">

                        <h2><?php echo $applications['total']; ?></h2>

                        <p class="text-muted">Total Applications</p>

                        <a href="applications.php" class="btn btn-success">
                            View Applications
                        </a>

                    </div>

                </div>

            </div>

        </div>


        <!-- RECENT APPLICATIONS -->

        <div class="card mt-5 shadow">

            <div class="card-header bg-primary text-white">

                Recent Applications

            </div>

            <div class="card-body">

                <table class="table table-striped table-bordered">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Skills</th>
                            <th>Matched Skills</th>
                            <th>Missing Skills</th>
                            <th>Job</th>
                            <th>AI Score</th>
                            <th>Status</th>
                            <th>CV</th>
                            <th>Date</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $result->fetch_assoc()) { ?>

                            <tr>

                                <td><?php echo $row['id']; ?></td>

                                <td><?php echo $row['name']; ?></td>

                                <td><?php echo $row['email']; ?></td>

                                <td><?php echo $row['skills']; ?></td>

                                <td><?php echo $row['matched_skills']; ?></td>

                                <td><?php echo $row['missing_skills']; ?></td>

                                <td><?php echo $row['job_title']; ?></td>

                                <td>

                                    <div class="progress">

                                        <div class="progress-bar bg-success"

                                            style="width:<?php echo $row['ai_score']; ?>%">

                                            <?php echo $row['ai_score']; ?>%

                                        </div>

                                    </div>
                                <td>

                                    <span class="badge bg-<?php echo $row['ai_decision'] == "shortlisted" ? "success" : "danger"; ?>"><?php echo $row['ai_decision']; ?></span>

                                </td>


                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="../applicant/<?php echo $row['cv_file'] ?? ""; ?>"
                                        target="_blank">
                                        View CV
                                    </a>

                                </td>

                                <td><?php echo $row['created_at']; ?></td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>