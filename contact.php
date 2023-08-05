<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/rentlet.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/layerslider.css">
    <link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Title -->
    <title>Rentlet - Home</title>
</head>

<body>
    
    <?php include("include/header.php"); ?>
    <!--	Banner   --->
    <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Contact-Us</b></h2>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-left float-md-right">
                            <ol class="breadcrumb bg-transparent m-0 p-0">
                                <li class="breadcrumb-item text-white"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Contact-Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
         <!--	Banner   --->
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    if (!empty($_POST["send"])) {
        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = "harshilkhatri.sal@gmail.com";    
            $mail->Password = "udbjzagwpqcgktrq";

            $userName = $_POST["userName"];
            $userEmail = $_POST["userEmail"];
            $userPhone = $_POST["userPhone"];
            $userMessage = $_POST["userMessage"];

            $mail->setFrom($userEmail, $userName);
            $mail->addAddress($userEmail);
            $mail->Subject = "Contact Form Submission";
            $mail->Body = "Thanks, " . $userName . "\r\n We got your Message: '" . $userMessage . "'. \r\n We will Contact you soon.";

            $mail->send();
            $message = "Your Enquiry has been received successfully.";
        } catch (Exception $e) {
            $message = $e;
            // You can also use $e->getMessage() to get more detailed error information.
        }
    }
    ?>

    <div style="margin: 2% 25% 2% 25%">
    <div class="col-md-12">
                        <h2 class="text-secondary double-down-line text-center mb-4">Send Message</h2>
                    </div>
        <form method="post" action="#">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="userName" placeholder="Enter Name">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="userEmail" placeholder="Enter Email">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="userPhone" placeholder="Enter Phone">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" name="userMessage" placeholder="Enter Message"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mt-4">
                        <button type="submit" name="send" value="submit" class="btn btn-primary w-100">Send Enquiry</button>
                    </div>
                </div>
                <?php if (!empty($message)) { ?>
                    <div class='success'>
                        <strong><?php echo $message; ?></strong>
                    </div>
                    
                    
                        
                <?php  // Insert data into the database
                    $sql = "INSERT INTO contact (name, email, phone, message) VALUES ('$userName', '$userEmail', '$userPhone', '$userMessage')";

                    if ($con->query($sql) === TRUE) {
                        $message = "Data saved successfully!";
                    } else {
                        $message = "Error: " . $sql . "<br>" . $conn->error;
                    }
                } ?>

            </div>
        </form>
    </div>

    <?php include("include/footer.php"); ?>
</body>

</html>
