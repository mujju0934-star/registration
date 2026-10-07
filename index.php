<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

function clean($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, "UTF-8");
}

$name    = clean($_POST["name"] ?? "");
$email   = trim($_POST["email"] ?? "");
$phone   = trim($_POST["phone"] ?? "");
$dob     = trim($_POST["dob"] ?? "");
$gender  = clean($_POST["gender"] ?? "");
$course  = clean($_POST["course"] ?? "");
$address = clean($_POST["address"] ?? "");

if (
    strlen($name) < 3 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    !preg_match("/^[0-9]{10}$/", $phone) ||
    $dob === "" ||
    $gender === "" ||
    $course === "" ||
    $address === ""
) {
    http_response_code(400);
    echo "Invalid information. Please go back and check your entries.";
    exit;
}

$email = htmlspecialchars($email, ENT_QUOTES, "UTF-8");
$phone = htmlspecialchars($phone, ENT_QUOTES, "UTF-8");
$dob = htmlspecialchars($dob, ENT_QUOTES, "UTF-8");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container result">
    <h1 class="success">Registration Successful!</h1>
    <p style="text-align:center">
        Your application has been submitted successfully.
    </p>

    <hr>

    <h2>Application Details</h2>

    <p><strong>Full Name:</strong> <?= $name ?></p>
    <p><strong>Email:</strong> <?= $email ?></p>
    <p><strong>Phone:</strong> <?= $phone ?></p>
    <p><strong>Date of Birth:</strong> <?= $dob ?></p>
    <p><strong>Gender:</strong> <?= $gender ?></p>
    <p><strong>Course:</strong> <?= $course ?></p>
    <p><strong>Address:</strong> <?= nl2br($address) ?></p>

    <button onclick="window.print()">Print Application</button>

    <button onclick="window.location.href='index.html'">
        Back to Registration
    </button>
</div>

</body>
</html>