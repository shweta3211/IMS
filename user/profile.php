
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['id'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$fname=$_POST['fullname'];
$contactno=$_POST['contactno'];
$address=$_POST['address'];
$state=$_POST['state'];
$country=$_POST['country'];
$pincode=$_POST['pincode'];
$id=$_SESSION["id"];
$sql=mysqli_query($con,"update users set fullName='$fname',contactNo='$contactno',address='$address',State='$state',country='$country',pincode='$pincode' where id='$id'");
echo "<script>alert('Profile Updated successfully');</script>";
echo "<script>window.location.href='profile.php'</script>";
}

	?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>IMS||User Profile</title>
   

    <!-- vendor css -->
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    
    

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
                            <h5 class="m-b-10">User Profile</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="profile.php">User Profile</a></li>
                            
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
                        <h5>User Profile</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                            	<?php
$id=intval($_SESSION["id"]);
$query=mysqli_query($con,"select * from users where id='$id'");
while($row=mysqli_fetch_array($query))
{
?>	
                                <form method="post">
                                	
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Full Name</label>
                                        <input type="text" name="fullname" required="required" value="<?php echo htmlentities($row['fullName']);?>" class="form-control" >
                                        
                                    </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">User Email</label>
                                        <input type="email" name="useremail" required="required" value="<?php echo htmlentities($row['userEmail']);?>" class="form-control" readonly>
                                        
                                    </div>
                                       <div class="form-group">
                                        <label for="exampleInputEmail1">Contact Number</label>
                                        <input type="text" name="contactno" required="required" value="<?php echo htmlentities($row['contactNo']);?>" class="form-control">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <textarea  name="address" required="required" class="form-control"><?php echo htmlentities($row['address']);?></textarea>    
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Pincode</label>
                                       <input type="text" name="pincode" maxlength="6" required="required" value="<?php echo htmlentities($row['pincode']);?>" class="form-control" onkeyup="getCityCountry(this.value)">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">City</label>
                                        <select name="state" id="state" class="form-control">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Country</label>
                                        <input type="text" name="country" id="country" placeholder="Country" class="form-control">      
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Reg Date</label>
                                        <input type="text" name="regdate" required="required" value="<?php echo htmlentities($row['regDate']);?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">User Photo</label>
                                       <?php $userphoto=$row['userImage'];
if($userphoto==""):
?>
<img src="userimages/noimage.png" width="256" height="256" >
<a href="update-image.php">Change Photo</a>
<?php else:?>
    <img src="userimages/<?php echo htmlentities($userphoto);?>" width="256" height="256">
    <a href="update-image.php">Change Photo</a>
<?php endif;?>
                                    </div><?php } ?>
                                
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
    <script src="../admin/assets/js/pcoded.min.js"></script>

    <script>
        function getCityCountry(pincode) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if (response && response[0] && response[0].PostOffice) {
                var cityDropdown = document.getElementById('state');
                var countryInput = document.getElementById('country');
                cityDropdown.innerHTML = '<option value="">Select City</option>';

                for (var i = 0; i < response[0].PostOffice.length; i++) {
                    var cityName = response[0].PostOffice[i].Name;
                    var countryName = response[0].PostOffice[i].Country;
                    if (cityName && cityName.trim() !== '') {
                        cityDropdown.innerHTML += '<option value="' + cityName + '">' + cityName + '</option>';
                    }
                    if (countryName && countryName.trim() !== '') {
                        countryInput.value = countryName; // Set country value directly
                    }
                }
                countryInput.readOnly = true; // Make the country input field read-only
            }
        }
    };
    xhttp.open("GET", "https://api.postalpincode.in/pincode/" + pincode, true);
    xhttp.send();
}

    </script>





</body>

</html>
<?php } ?>