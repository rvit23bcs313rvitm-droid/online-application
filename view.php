<?php
include 'db.php';

// Get all registrations (latest ID first to match screenshot)
$result = $conn->query("SELECT * FROM registrations ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Registrations</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, system-ui;
      background: #f7f7f7;
      margin: 0;
      padding: 20px;
    }

    /* Wider card just for this page */
    .container.table-page {
      max-width: 900px;
      margin: 0 auto;
      background: #ffffff;
      padding: 24px 24px 32px;
      border-radius: 12px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    .table-page h2 {
      text-align: center;
      margin-top: 0;
      margin-bottom: 10px;
      font-size: 28px;
      color: #111827;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: #ffffff;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
      font-size: 14px;
    }

    th {
      background: #2563eb;
      color: #ffffff;
      font-weight: 600;
      white-space: nowrap;
    }

    tr:nth-child(even) {
      background: #f2f2f2;
    }

    .back-link {
      text-align: center;
      margin-top: 18px;
      font-size: 15px;
    }

    .back-link a {
      text-decoration: none;
      color: #2563eb;
    }

    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container table-page">
    <h2>All Registrations</h2>

    <table>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Course</th>
        <th>Registered On</th>
      </tr>
      <?php
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['fullname']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['phone']}</td>
                  <td>{$row['course']}</td>
                  <td>{$row['created_at']}</td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='6' style='text-align:center;'>No records found</td></tr>";
      }
      ?>
    </table>

    <div class="back-link">
      <a href="index.html">← Back to Form</a>
    </div>
  </div>
</body>
</html>
