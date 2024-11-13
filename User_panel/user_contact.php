<?php 

$conn = new mysqli('localhost', 'root', '', 'trippy');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['send']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; // Corrected variable name
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO `user_contact`(`name`, `email`, `phone`, `message`) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);
    $stmt->execute();
    echo "<script>alert('Message sent successfully!'); window.location='contact_success.html';</script>";
    $stmt->close();
    $conn->close();
}
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="header">
    <strong><a href="home.php" class="logo">Trippy.</a></strong>

    <nav class="navbar">
      <a href="home.html">home</a>
      <a href="about.html">about</a>
      <a href="package.html">package</a>
      <a href="book.html">book</a>
      <a href="index.html">Login</a>
    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>

</section>

    <div class="contact-form">
        <h1>Contact Us</h1>
        
        <form method="post" action="">
            <div class="form">
                <label>Full Name :</label>
                <input type="text" name="name" value="" placeholder="Enter your name">
            </div>

            <div class="form">
                <label>Email :</label>
                <input type="text" name="email" value="" placeholder="Enter your Email">
            </div>

            <div class="form">
                <label>Phone Number :</label>
                <input type="text" name="phone" value="" placeholder="Enter your Phone Number">
            </div>

            <div class="form">
                <label>Message :</label>
                <textarea name="message"></textarea>
            </div>

            <input type="submit" class="button" name="send" value="Send">
        </form>
    </div>
</body>
</html>
