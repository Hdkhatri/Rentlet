<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");

///search code
	
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
<title>Rentlet </title>
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
                        <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Property Grid</b></h2>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-left float-md-right">
                            <ol class="breadcrumb bg-transparent m-0 p-0">
                                <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Property Grid</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
         <!--	Banner   --->
        
        <!--	Property Grid
		===============================================================-->
        <div class="full-row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <?php
                            if (isset($_REQUEST['filter'])) {
                                try {
                                    $p_type = $_REQUEST['p_type'];
                                    $ttype = $_REQUEST['ttype'];
                                    $city = $_REQUEST['city'];

                                    $sql = "SELECT property.*, register.uname,register.u_type FROM property,register  WHERE (p_type='{$p_type}' or ttype='{$ttype}' or city='{$city}') and property.rr_id=register.rr_id ";
                                    $result = mysqli_query($con, $sql);

                                    if ($result) {
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                if ($row['flag'] == 1 || $row['flag'] == 2) {
                                                    ?>
                                                    <div class="col-md-6 ">
                                                        <div class="featured-thumb hover-zoomer mb-4">
                                                            <?php
                                                            $image = mysqli_query($con, "SELECT images.* FROM `property`, `images` WHERE property.p_id=images.p_id AND property.p_id = " . $row['p_id']);
                                                            while ($image_path = mysqli_fetch_array($image)) {
                                                                ?>
                                                                <div class="overlay-black overflow-hidden position-relative">
                                                                    <div id="carouselExample" class="carousel slide" data-ride="carousel">
                                                                        <div class="carousel-inner">
                                                                            <?php
                                                                            $active = true; // Flag for the first image to be marked as active
                                                                            while ($image_path = mysqli_fetch_array($image)) {
                                                                                ?>
                                                                                <div class="carousel-item <?php if ($active) {
                                                                                    echo 'active';
                                                                                    $active = false;
                                                                                } ?>">
                                                                                    <img src="<?php echo $image_path['image_path']; ?>"
                                                                                        alt="pimage"
                                                                                        class="d-block w-100"
                                                                                        style="width: 200px; height: 300px;">
                                                                                    <!-- Add any additional carousel content or captions here -->
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>
                                                                        <!-- Carousel navigation controls -->

                                                                    </div>


                                                                    <div class="sale bg-secondary text-white">For <?php if ($row['flag'] == 2) {
                                                                            ?><td class="text-capitalize">Rentout</a></td>
                                                                        <?php } else { ?>
                                                                            <td class="text-capitalize"> Rent </td>
                                                                        <?php } ?></div>
                                                                    <div class="price text-primary text-capitalize">Rs<?php echo $row['rent_price']; ?>
                                                                        <span class="text-white"><?php echo $row['carpet_area']; ?>
                                                                            Sqft</span></div>
                                                                </div>

                                                                <div class="featured-thumb-data shadow-one">
                                                                    <div class="p-4">
                                                                        <h5 class="text-secondary hover-text-primary mb-2 text-capitalize"><a
                                                                                    href="propertydetail.php?ep_id=<?php echo $row['ep_id']; ?>"><?php echo $row['name']; ?></a>
                                                                        </h5>
                                                                        <span class="location text-capitalize"><i
                                                                                    class="fas fa-map-marker-alt text-primary"></i> <?php echo $row['area']; ?>,<?php echo $row['city']; ?></span>
                                                                    </div>
                                                                    <div class="px-4 pb-4 d-inline-block w-100">
                                                                        <div class="float-left text-capitalize"><i
                                                                                    class="fas fa-user text-primary mr-1"></i>By : <?php echo $row['uname']; ?>
                                                                        </div>
                                                                        <div class="float-right"><i
                                                                                    class="far fa-calendar-alt text-primary mr-1"></i> <?php echo $row['available_from']; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                        } else {
                                            echo "<h1 class='mb-5'><center>No Property Available</center></h1>";
                                        }
                                    } else {
                                        throw new Exception(mysqli_error($con));
                                    }
                                } catch (Exception $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                            }
                            ?>
                        </div>
                    </div>
             
                
					
                    <div class="col-lg-4">
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
                                        <h6 class="text-secondary hover-text-primary text-capitalize"><a href="propertydetail.php?p_id=<?php echo $row['p_id'];?>"><?php echo $row['name'];?></a></h6>
                                        <span class="font-14"><i class="fas fa-map-marker-alt icon-primary icon-small"></i> <?php echo $row['area'];?>,<?php echo $row['city']; ?></span>
                                        
                                    </li>
                                    <?php }} ?>

                                </ul>
                            </div>
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
</body>

</html>