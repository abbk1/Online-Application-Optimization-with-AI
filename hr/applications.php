<?php
$conn = new mysqli("localhost", "root", "", "dbhr");

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

    <title>Applications</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <!-- NAVBAR -->

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">

            <a class="navbar-brand" href="admin_dashboard.php">
                AI Recruitment Dashboard
            </a>

            <a href="dashboard.php">Dashboard</a>

        </div>
    </nav>


    <div class="container mt-5">

        <h3 class="mb-4">All Job Applications</h3>

        <div class="card shadow">

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
                            <th>Job Applied</th>
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

</body>

</html>