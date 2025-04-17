<?php
// Start PHP and handle form submission
if (isset($_POST["send"])) {
    $name = $_POST['fullname'];
    $number = $_POST['contactno'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");

    $sql = "INSERT INTO contact_query (query_name, query_mail, query_number, query_message)
            VALUES ('$name', '$email', '$number', '$message')";

    $result = mysqli_query($conn, $sql) or die("Query unsuccessful: " . mysqli_error($conn));

    // ✅ Redirect to homepage after successful submission
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Contact Us - Blood Bank</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    header("Location: home.php");
</head>

<body>
<?php
$active = 'contact';
include 'head.php';
?>

<div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
  <div class="container">
    <div id="content-wrap" style="padding-bottom:50px;">
      <h1 class="mt-4 mb-3">Contact</h1>
      <div class="row">
        <!-- Form Section -->
        <div class="col-lg-8 mb-4">
          <h3>Send us a Message</h3>
          <form method="post">
            <div class="form-group">
              <label>Full Name:</label>
              <input type="text" class="form-control" name="fullname" required>
            </div>
            <div class="form-group">
              <label>Phone Number:</label>
              <input type="tel" class="form-control" name="contactno" required>
            </div>
            <div class="form-group">
              <label>Email Address:</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
              <label>Message:</label>
              <textarea class="form-control" name="message" rows="6" required maxlength="999" style="resize:none"></textarea>
            </div>
            <button type="submit" name="send" class="btn btn-primary">Send Message</button>
          </form>
        </div>

        <!-- Contact Info Section -->
        <div class="col-lg-4 mb-4">
          <h2>Contact Details</h2>
          <?php
          include 'conn.php';
          $sql = "SELECT * FROM contact_info WHERE contact_id = 1";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              echo "<p><strong>Address:</strong><br>" . $row['contact_address'] . "</p>";
              echo "<p><strong>Contact Number:</strong><br>" . $row['contact_phone'] . "</p>";
              echo "<p><strong>Email:</strong><br><a href='mailto:" . $row['contact_mail'] . "'>" . $row['contact_mail'] . "</a></p>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</div>
</body>
</html>