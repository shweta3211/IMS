
<?php
session_start();
include('include/config.php');
error_reporting(0);
if(strlen($_SESSION['id'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit'])) {
    $uid = $_SESSION['id'];
    $category = $_POST['category'];
    $complaintype = $_POST['complaintype'];
    $reporter_name = mysqli_real_escape_string($con, $_POST['noc']); // Escape reporter name
    $complaintdetials = mysqli_real_escape_string($con, $_POST['complaindetails']);

    // Generate random 5-digit number
    $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

    // Get current year
    $currentYear = date("Y");

    // Concatenate the parts to form the unique incident_id
    $incident_id = "RMG" . $randomNumber . $currentYear;

    // Build and execute the SQL query
    $query = mysqli_query($con, "INSERT INTO tblincidents (incident_id, userId, category, complaintPriority, reporter_name, complaintDetails) VALUES ('$incident_id', '$uid', '$category', '$complaintype', '$reporter_name', '$complaintdetials')");

    if($query) {
        echo '<script> alert("Your complaint has been successfully submitted and your incident ID is '.$incident_id.'")</script>';
    } else {
        echo '<script> alert("Error submitting complaint: ' . mysqli_error($con) . '")</script>';
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>IMS||Register Incident</title>
   

    <!-- vendor css -->
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    
   <script>
function getCat(val) {
  //alert('val');

  $.ajax({
  type: "POST",
  url: "getsubcat.php",
  data:'catid='+val,
  success: function(data){
    $("#subcategory").html(data);
    
  }
  });
  }
  </script> 

</head>
<body class="">
	<?php include('include/sidebar.php');?>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<?php include('include/header.php');?>

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Register Incident</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="register-incident.php">Register Incident</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
          
            <!-- [ form-element ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Register Incident</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                            	
                                    <br />
                                <form method="post" name="complaint" enctype="multipart/form-data">
                                	
                                  
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Category Name</label>
                                        <select name="category" id="category" class="form-control" onChange="getCat(this.value);" required="">
<option value="">Select Category</option>
<?php $sql=mysqli_query($con,"select id,categoryName from category ");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['categoryName']);?></option>
<?php
}
?>
</select>
                                        
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Incident Priority</label>
                                        <select name="complaintype" class="form-control" required="">
                                            <option value="">Select Priority</option>
                                            <option value=" High"> High</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Low">Low</option>
                                        </select> 
                                        
                                    </div>
                                     <div class="form-group">
                                     <label for="exampleInputEmail1">Incident Reporter Name</label>
                                            <?php
                                            // Assuming the user is logged in and the session contains user ID
                                            $uid = $_SESSION['id'];
                                            
                                            // Fetch the user's name from the database
                                            $query = mysqli_query($con, "SELECT fullName FROM users WHERE id='$uid'");
                                            $row = mysqli_fetch_array($query);
                                            $fullName = htmlentities($row['fullName']); // Sanitize the output for security
                                            
                                            // Output the user's name as the value of the input field
                                            ?>
                                            <input type="text" name="noc" required="required" value="<?php echo $fullName; ?>" class="form-control">
                                        
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Incident Details (max 2000 words)</label>
                                        <textarea  name="complaindetails" required="required" cols="10" rows="8" class="form-control" maxlength="2000"></textarea>
                                        
                                    </div>
                                     
                                    <button type="submit" class="btn  btn-primary" name="submit">Submit</button>
                                </form>
                            </div>
                           
                        </div>
             
                   
                    </div>
                </div>
          
            </div>
            <!-- [ form-element ] end -->
        </div>
        <!-- [ Main Content ] end -->

    </div>
</section>


    <!-- Required Js -->
    <script src="../admin/assets/js/vendor-all.min.js"></script>
    <script src="../admin/assets/js/plugins/bootstrap.min.js"></script>




</body>

</html>
<?php } ?>