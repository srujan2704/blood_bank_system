<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if all expected POST values are set
if (!isset(
    $_POST['fullname'],
    $_POST['mobileno'],
    $_POST['emailid'],
    $_POST['age'],
    $_POST['gender'],
    $_POST['blood'],
    $_POST['address']
)) {
    die("Missing form data.");
}

// Get form values
$name = $_POST['fullname'];
$number = $_POST['mobileno'];
$email = $_POST['emailid'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood'];
$address = $_POST['address'];

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "blood_donation");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the insert statement
$stmt = $conn->prepare("INSERT INTO donor_details (
    donor_name, donor_number, donor_mail, donor_age,
    donor_gender, donor_blood, donor_address
) VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssisss", $name, $number, $email, $age, $gender, $blood_group, $address);

// Execute and redirect or show error
if ($stmt->execute()) {
    header("Location: http://localhost/Blood-Bank-And-Donation-Management-System/home.php");
    exit();
} else {
    echo "Error inserting data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>