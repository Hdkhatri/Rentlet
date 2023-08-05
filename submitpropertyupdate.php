<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");
if(!isset($_SESSION['mobile']))
{
	header("location:login.php");
}

//// code insert
//// add code

$msg="";
if(isset($_POST['add']))
{
	$ep_id=$_REQUEST['ep_id'];
	
	$name=$_POST['name'];
	$ptype=$_POST['ptype'];
	$bhk=$_POST['bhk'];
	$r_type=$_POST['r_type'];
	$maintence=$_POST['maintence'];
	$rent_price=$_POST['rent_price'];
	$city=$_POST['city'];
	$asize=$_POST['asize'];
	$loc=$_POST['loc'];
	$furn_status=$_POST['furn_status'];
	$rr_id=$_SESSION['rr_id'];
	$feature=$_POST['feature'];
	$bath=$_POST['bath'];
	$parking = $_POST['parking'];
	$date=$_POST['date'];
	$images = $_FILES['images'];
	$flag=$_POST['flag'];
	
	
	
	$sql = "UPDATE property SET name = '{$name}', p_type = '{$ptype}', bhk = '{$bhk}', r_type = '{$r_type}', maintence = '{$maintence}',
	rent_price = '{$rent_price}', city = '{$city}', carpet_area = '{$asize}', address = '{$loc}', furn_status = '{$furn_status}', description = '{$feature}', 
	bathroom = '{$bath}', parking = '{$parking}', available_from = '{$date}', rr_id = '{$rr_id}', flag = '{$flag}'
	WHERE ep_id = '{$ep_id}'";

	
	$result=mysqli_query($con,$sql);
	$p = "SELECT p_id FROM property WHERE ep_id = '$ep_id'";
	$p_query = mysqli_query($con,$p);
	$row=mysqli_fetch_array($p_query);
	$p_id = $row['p_id'];

	if($result == true)
	{	// Insert user images into 'user_images' table	
		foreach ($images['name'] as $key => $name) {
			$image_path = 'uploads/' . $name;
			move_uploaded_file($images['tmp_name'][$key], $image_path);
			$sql = "INSERT INTO images (p_id, image_path) VALUES ('$p_id', '$image_path')";
			mysqli_query($con, $sql);
		}
		$msg="<p class='alert alert-success'>Property Updated</p>";
		header("Location:feature.php?msg=$msg");
	}
	else{
		$msg="<p class='alert alert-warning'>Property Not Updated</p>";
		header("Location:feature.php?msg=$msg");
	}
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
<link rel="shortcut icon" href="images/favicon.ico">

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
<link rel="stylesheet" type="text/css" href="css/color.css">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

<!--	Title
	=========================================================-->
<title>Rentlet - Update Property</title>
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
                        <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Submit Property</b></h2>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-left float-md-right">
                            <ol class="breadcrumb bg-transparent m-0 p-0">
                                <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Submit Property</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
         <!--	Banner   --->
		 
		 
		<!--	Submit property   -->
        <div class="full-row">
            <div class="container" style="text-align">
                    <div class="row">
						<div class="col-lg-12">
							<h2 class="text-secondary double-down-line text-center">Submit Property</h2>
                        </div>
					</div>
                    <div class="row p-5 bg-white"style= "text-align:center">
                        <form method="post" enctype="multipart/form-data" style= "text-align:center">
								
								<?php
									
									$ep_id=$_REQUEST['ep_id'];
									$query=mysqli_query($con,"select * from property where ep_id='$ep_id'");
									while($row=mysqli_fetch_row($query))
									{
								?>
												
								<div class="description">
									<h5 class="text-secondary">Basic Information</h5><hr>
									
									
										<div class="row">
											<div class="col-xl-12">
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Property Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="name" required value="<?php echo $row['3']; ?>">
													</div>
												</div>
												
												
											</div>
											<div class="col-xl-12">
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Property Type</label>
													<div class="col-lg-9">
														<select class="form-control" required name="ptype" >
															<option value="<?php echo $row['5']; ?>"><?php echo $row['5']; ?></option>
															<option value="apartment">Apartment</option>
															<option value="bunglow">Bunglow</option>
															<option value="Tenament">Tenament</option>
															<option value="villa">Villa</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Property For</label>
													<div class="col-lg-9">
														<select class="form-control" required name="r_type">
															
															<option value="rent">Rent</option>
															<!-- <option value="sale">Sale</option> -->
														</select>
													</div>
												</div>
												
												
											</div>   
											<div class="col-xl-12">
												<div class="form-group row mb-3">
													<label class="col-lg-2 col-form-label">BHK</label>
													<div class="col-lg-9">
														<select class="form-control" required name="bhk" value="<?php echo $row['7']; ?> ">
															<option value="<?php echo $row['7']; ?>"><?php echo $row['7']; ?> </option>
															<option value="1 BHK">1 BHK</option>
															<option value="2 BHK">2 BHK</option>
															<option value="3 BHK">3 BHK</option>
															<option value="4+ BHK">4+ BHK</option>
															
														</select>
													</div>
												</div>
												<div class="form-group row mb-3">
													<label class="col-lg-2 col-form-label">Property </label>
													<div class="col-lg-9">
														<select class="form-control"  name="flag" >
															<option value="1">Available For Rent</option>
															<option value="2">Rented</option>
															
															
														</select>
													</div>
												</div>
													<!-- <div class="form-group row">
														<label class="col-lg-3 col-form-label">Bedroom</label>
														<div class="col-lg-9">
															<input type="text" class="form-control" name="bed" required placeholder="Enter Bedroom  (only no 1 to 10)">
														</div>
													</div> -->
												<!-- <div class="form-group row">
													<label class="col-lg-3 col-form-label">Balcony</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="balc" required placeholder="Enter Balcony  (only no 1 to 10)">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Hall</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="hall" required placeholder="Enter Hall  (only no 1 to 10)">
													</div>
												</div> -->
												
											</div>
										</div>
										<h5 class="text-secondary">Price & location</h5><hr>
										<div class="row">
											<div class="col-xl-5">
												<!-- <div class="form-group row">
													<label class="col-lg-3 col-form-label">Floor</label>
													<div class="col-lg-9">
														<select class="form-control" required name="floor">
															<option value="">Select Floor</option>
															<option value="1st Floor">1st Floor</option>
															<option value="2nd Floor">2nd Floor</option>
															<option value="3rd Floor">3rd Floor</option>
															<option value="4th Floor">4th Floor</option>
															<option value="5th Floor">5th Floor</option>
														</select>
													</div>
												</div> -->
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Rent Price</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="rent_price" required value="<?php echo $row['9']; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">City</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="city" required value="<?php echo $row['2']; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Area Size in {SQFT}</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="asize" required value="<?php echo $row['8']; ?>">
													</div>
												</div>
												
											</div>
											<div class="col-xl-6">
											<div class="form-group row">
													<label class="col-lg-3 col-form-label">Maintence</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="maintence" required value="<?php echo $row['10']; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Address</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="loc" required value="<?php echo $row['16']; ?>">
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Furnishing Status</label>
													<div class="col-lg-9">
													<select class="form-control" required name="furn_status">
															<option value="<?php echo $row['13']; ?>"><?php echo $row['13']; ?></option>
															<option value="Fully Furnished">Fully Furnished</option>
															<option value="Semi Furnished">Semi Furnished</option>
															<option value="Unfurnished">Unfurnished</option>
															
														</select>
													</div>
												</div>
												
											</div>
										</div>
										<h5 class="text-secondary">Addition Information</h5><hr>
										<div class="form-group row">
											<label class="col-lg-2 col-form-label">Describe Your Property</label>
											<div class="col-lg-9">
											<textarea class=" form-control" name="feature"  placeholder="hello">
												
											</textarea>
											</div>
											
										</div>
										<div class="form-group row">
													<label class="col-lg-2 col-form-label">Bathroom</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="bath" required value="<?php echo $row['14']; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Parking</label>
													<div class="col-lg-9">
													<select class="form-control" required name="parking">
															<option value="<?php echo $row['15']; ?>"><?php echo $row['15']; ?></option>
															<option value="Four Wheeler Parking">Four Wheeler Parking</option>
															<option value="two Wheeler Parking">Two Wheeler Parking</option>
															<option value="Both">Both</option>
															<option value="None">None</option>
														</select>
													</div>
												</div>
												
										<h5 class="text-secondary">Image & Status</h5><hr>
										<div class="row">
											<div class="col-xl-6">
												
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Image</label>
													<div class="col-lg-9">
														<input class="form-control" name="images[]" type="file" multiple  >
													</div>
												</div>
												
												
											</div>
											<div class="col-xl-6">
												
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Availabe From </label>
													<div class="col-lg-9">
														<input class="form-control" name="date" type="date" required="" value="<?php echo $row['6']; ?>" min="<?php echo date('Y-m-d'); ?>">
													</div>
												</div>
												
												
											</div>
										</div>
										
										<table>
												<tr>
													<th>Image</th>
													
													<th>Delete Image</th>
												</tr>
												<?php
													$p_id = $row['0'];
													$image_q=mysqli_query($con,"SELECT image_path,i_id,p_id FROM images WHERE p_id ='$p_id'");
													while($i=mysqli_fetch_row($image_q))
													{
												?>
												<tr>
													<td>
														<div style="width: 250px; height: 250px; overflow: hidden;">
															<img src="<?php echo $i[0]; ?>" alt="Image 1" style="object-fit: cover; width: 100%; height: 100%;">
														</div>
													</td>
													
													<td><a href="delete.php?id=<?php echo $i[1];?>">Delete</a></td>
												</tr>
												<?php } ?>
												<!-- Add more rows as needed -->
											</table>

										
											<input type="submit" value="Submit" class="btn btn-primary"name="add" >
										
								</div>
								</form>
								
							<?php
								} 
							?>
                    </div>            
            </div>
        </div>
	<!--	Submit property   -->
        
        
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
<script src="js/tinymce/tinymce.min.js"></script>
<script src="js/tinymce/init-tinymce.min.js"></script>
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