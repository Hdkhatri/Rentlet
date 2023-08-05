
<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");
$error="";
$msg="";
if(!isset($_SESSION['mobile']))
{
	header("location:login.php");
}								
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
<meta name="description" content="Homex template">
<meta name="keywords" content="">
<meta name="author" content="Unicoder">
<link rel="shortcut icon" href="images/rentlet.ico">

<!--	Fonts
	========================================================-->
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

<!--	Css Link
	========================================================-->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/layerslider.css">
<link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<!--	Title
	=========================================================-->
<title>Rentlet - Property details</title>
 
<style>
        /* Styles for the slideshow container */
        .slideshow-container {
            
            position: relative;
            margin: auto;
        }
        
        /* Styles for the slideshow images */
        .slideshow-container img {
            width: 100%;
            height: 500px;
        }
        
        /* Styles for the previous and next buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }
        
        /* Styles for the previous button */
        .prev {
            left: 0;
        }
        
        /* Styles for the next button */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }
    </style>
</head>
<body>

<!--	Page Loader
=============================================================
<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
	<div class="d-flex justify-content-center y-middle position-relative">
	  <div class="spinner-border" role="status">
		<span class="sr-only">Loading...</span>
	  </div>
	</div>
</div>
--> 


<div id="page-wrapper">
    <div class="row"> 
        <!--	Header start  -->
		<?php include("include/header.php");?>
        <!--	Header end  -->
        
        <!--	Banner   --->
        <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Property Detail</b></h2>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-left float-md-right">
                            <ol class="breadcrumb bg-transparent m-0 p-0">
                                <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Property Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
         <!--	Banner   --->

		 
        <div class="full-row">
            <div class="container">
           
                <div class="row">
				
					<?php
						$id=$_REQUEST['ep_id']; 
						$query=mysqli_query($con,"SELECT property.*, register.* FROM `property`,`register` WHERE property.rr_id=register.rr_id and ep_id='$id'");
						while($row=mysqli_fetch_array($query))
						{ $name = $row['name'];
                          $area = $row['area'];
                          $pid = $row['p_id'];
					  ?>
				  
                    <div class="col-lg-8">

                        <div class="row">
                            <div class="col-md-12">
                            <div class="slideshow-container">
                                    <?php
                                    
                                    
                                    // Query to retrieve image paths
                                    $sql = "SELECT image_path FROM images WHERE p_id = $pid";
                                    $result = $con->query($sql);
                                    
                                    // Display slideshow images
                                    if ($result->num_rows > 0) {
                                        while ($row1 = $result->fetch_assoc()) {
                                            $imagePath = $row1["image_path"];
                                            echo '<img src="' . $imagePath . '" class="slide" />';
                                        }
                                    } else {
                                        echo "No images found.";
                                    }
                                    
                                   
                                    ?>
                                    
                                    <!-- Previous and Next buttons -->
                                    <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
                                    <a class="next" onclick="changeSlide(1)">&#10095;</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="bg-primary d-table px-3 py-2 rounded text-white text-capitalize">
                                <?php if($row['flag']== 2 ){ ?><td>Rentout</a></td>
                                <?php } else { ?>
								<td class="text-capitalize">For Rent </td>
                                <?php }?></div>
                                <h5 class="mt-2 text-secondary text-capitalize"><?php echo $row['name'];?></h5>
                                <span class="mb-sm-20 d-block text-capitalize"><i class="fas fa-map-marker-alt text-primary font-12"></i> &nbsp;<?php echo $row['area'];?>,<?php echo $row['city'];?></span>
							</div>
                            <div class="col-md-6">
                                <div class="text-primary text-left h5 my-2 text-md-right">Rs <?php echo $row['rent_price'];?></div>
                                <div class="text-left text-md-right">Price</div>
                            </div>
                        </div>
                        <div class="property-details">
                            
                           
                            
                            <h5 class="mt-5 mb-4 text-secondary">Property Summary</h5>
                            <div  class="table-striped font-14 pb-2">
                                <table class="w-100">
                                    <tbody>
                                        <tr>
                                            <td>BHK:</td>
                                            <td class="text-capitalize"><?php echo $row['bhk'];?></td>
                                            <td>Property Type :</td>
                                            <td class="text-capitalize"><?php echo $row['p_type'];?></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Floor :</td>
                                            <td class="text-capitalize"><?php echo $row['10'];?></td>
                                            <td>Total Floor :</td>
                                            <td class="text-capitalize"><?php echo $row['28'];?></td>
                                        </tr> -->
                                        <tr>
                                            <td>City :</td>
                                            <td class="text-capitalize"><?php echo $row['city'];?></td>
                                            <td>State :</td>
                                            <td class="text-capitalize">Maharastra</td>
                                        </tr>
                                        <tr>
                                            <td>Carpet Area (SQFT):</td>
                                            <td class="text-capitalize"><?php echo $row['carpet_area'];?></td>
                                            <td>Bathroom :</td>
                                            <td class="text-capitalize"><?php echo $row['bathroom'];?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="text-secondary my-4">Description</h4>
                            <p><?php echo $row['description'];?></p>
                            <!-- <h5 class="mt-5 mb-4 text-secondary">Features</h5>
                            <div class="row">
								<?php echo $row['17'];?>
								
                            </div>    -->
                            <?php } ?>           
                        </div>
                    </div>
					
				
					
                    <div class="col-lg-4">
                        <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4 mt-md-50">Send Message</h4>
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
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
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
                                    $mail->Body = "Thanks, " . $userName . "\r\n We got your Message: '" . $userMessage . "'.\r\n We got enquiry of " . $name ."," . $area ."\r\n We will Contact you soon.";

                                    $mail->send();
                                    $message = "Your Enquiry has been received successfully.";
                                } catch (Exception $e) {
                                    $message = "An error occurred while sending the email. Please try again later.";
                                    // You can also use $e->getMessage() to get more detailed error information.
                                }
                            }
                            ?>
                            <?php echo $area; ?>
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
                                            <?php } ?>
                                        </div>
        </form>
                        
                        

                        <div class="sidebar-widget mt-5">
                            <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Recent Property Add</h4>
                            <ul class="property_list_widget">
							
								<?php 
								$query=mysqli_query($con,"SELECT * FROM `property`  LIMIT 6");
										while($row=mysqli_fetch_array($query))
										{if($row['flag']== 1)
                                            {
								?>
                                <li> <img src="uploads/rohan1.jpg" alt="pimage">
                                    <h6 class="text-secondary hover-text-primary text-capitalize"><a href="propertydetail.php?ep_id=<?php echo $row['ep_id'];?>"><?php echo $row['name'];?></a></h6>
                                    <span class="font-14"><i class="fas fa-map-marker-alt icon-primary icon-small"></i> <?php echo $row['area'];?>,<?php echo $row['city'];?></span>
                                    
                                </li>
                                <?php }} ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!--	Footer   start-->
		<?php include("include/footer.php");?>
		<!--	Footer   start-->
        
        
        <!-- Scroll to top --> 
        <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
        <!-- End Scroll To top --> 
    </div>
</div>
<!-- Wrapper End --> 

<!--	Js Link
============================================================--> 
<script src="js/jquery.min.js"></script> 
<!--jQuery Layer Slider --> 
<script src="js/greensock.js"></script> 
<script src="js/layerslider.transitions.js"></script> 
<script src="js/layerslider.kreaturamedia.jquery.js"></script> 
<!--jQuery Layer Slider --> 
<script src="js/popper.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/tmpl.js"></script> 
<script src="js/jquery.dependClass-0.1.js"></script> 
<script src="js/draggable-0.1.js"></script> 
<script src="js/jquery.slider.js"></script> 
<script src="js/wow.js"></script> 
<script src="js/custom.js"></script> 
<script>
        var slideIndex = 0;
        showSlide(slideIndex);
        
        function changeSlide(n) {
            showSlide(slideIndex += n);
        }
        
        function showSlide(index) {
            var slides = document.getElementsByClassName("slide");
            
            // Wrap around to the first slide if index exceeds the number of slides
            if (index >= slides.length) {
                slideIndex = 0;
            } else if (index < 0) {
                slideIndex = slides.length - 1;
            }
            
            // Hide all slides
            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            
            // Display the current slide
            slides[slideIndex].style.display = "block";
        }
    </script>
</body>

</html>