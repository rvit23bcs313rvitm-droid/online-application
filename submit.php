<?php
require_once 'dbconfig.php';

function safe_post($key) {
    return isset($_POST[$key]) ? trim($_POST[$key]) : '';
}

$name    = safe_post('full_name');
$email   = safe_post('email');
$phone   = safe_post('phone');
$course  = safe_post('course');
$gender  = safe_post('gender');

$allFilled = $name && $email && $phone && $course && $gender;

$insertSuccess = false;
$errorMsg = "";

if ($allFilled) {
    $stmt = $conn->prepare("
        INSERT INTO applications
        (full_name, email, phone, course, gender)
        VALUES (?, ?, ?, ?, ?)
    ");

    if ($stmt) {
        $stmt->bind_param("sssss", $name, $email, $phone, $course, $gender);
        if ($stmt->execute()) $insertSuccess = true;
        else $errorMsg = "Error inserting data: " . $stmt->error;
        $stmt->close();
    } else {
        $errorMsg = "Prepare failed: " . $conn->error;
    }
}

$conn->close();

function h($str) { return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Summary</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <?php if (!$allFilled): ?>
        <h2>Invalid Submission</h2>
        <p>Please fill all required fields.</p>

    <?php elseif ($insertSuccess): ?>
        <div class="success-box">
            <h2 class="success-title">Application Submitted Successfully ✅</h2>
            <p>Your details are saved in the database:</p>

            <table class="summary-table">
                <tr><th>Full Name</th><td><?php echo h($name); ?></td></tr>
                <tr><th>Email</th><td><?php echo h($email); ?></td></tr>
                <tr><th>Phone</th><td><?php echo h($phone); ?></td></tr>
                <tr><th>Course</th><td><?php echo h($course); ?></td></tr>
                <tr><th>Gender</th><td><?php echo h($gender); ?></td></tr>
            </table>
        </div>

    <?php else: ?>
        <h2>Database Error</h2>
        <p>Could not save your data.</p>
        <pre><?php echo h($errorMsg); ?></pre>
    <?php endif; ?>

    <p style="margin-top:20px;">
        <a href="index.html">← Back to Form</a> |
        <a href="view_all.php">View All Applications</a>
    </p>
</div>

</body>
</html>
