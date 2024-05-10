
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['id'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>IMS|| Incident History</title>
   

    <!-- vendor css -->
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    
 <script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
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
                            <h5 class="m-b-10">Incident History</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="incident-history.php">Incident History</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->


    <!----- incident search ---------------->
  
    <div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5>Search Complaints</h5>
                <hr>
                <div class="card-body">
                    <form method="post">                                
                        <div class="row">
                            <div class="col-2">Search</div>
                            <div class="col-8">
                                <input class="form-control" type="search" name="search" placeholder="Search By Incident Number / Incident Reporter Name / Incident number" required="true">
                            </div>
                        </div>
                        <div class="row" style="margin-top:1%;">
                            <div class="col-6" align="center"><button type="submit" name="submit" class="btn btn-primary">Submit</button></div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <?php if (isset($_POST['submit'])) { 
                                $search = $_POST['search'];
                                ?>
                                <br>
                                <h4 align="center" style="color:blue">Search against: <?php echo $search;?></h4>
                                <hr />
                                <div class="card-body table-border-style">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Incident No</th>
                                                    <th>Incident Reporter Name</th>
                                                    <th>Reg Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $id = $_SESSION['id']; // Assuming the session contains the user ID
                                                $query = mysqli_query($con, "SELECT tblincidents.*, users.fullName AS name FROM tblincidents JOIN users ON users.id=tblincidents.userId WHERE (tblincidents.complaintNumber LIKE '%$search%' OR users.fullName LIKE '%$search%' OR users.contactNo LIKE '%$search%') AND users.id = '$id'");
                                                $cnt = 1;
                                                $count = mysqli_num_rows($query);
                                                if ($count > 0) {
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        ?>  
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt);?></td>
                                                            <td><?php echo htmlentities($row['complaintNumber']);?></td>
                                                            <td><?php echo htmlentities($row['name']);?></td>
                                                            <td><?php echo htmlentities($row['regDate']);?></td>
                                                            <td>
                                                                <?php 
                                                                $status = $row['status'];
                                                                if ($status == ''): ?>
                                                                <span class="badge badge-danger">Not Processed Yet</span>
                                                            <?php elseif ($status == 'in process'):?>
                                                             <span class="badge badge-warning">In Process</span>
                                                         <?php elseif ($status == 'closed'):?>
                                                             <span class="badge badge-success">Closed</span>
                                                         <?php endif;?>
                                                     </td>
                                                     <td>   
                                                        <a href="incident-details.php?cid=<?php echo htmlentities($row['complaintNumber']);?>" class="btn btn-primary"> View Details</a> 
                                                    </td>
                                                </tr>
                                                <?php 
                                                $cnt = $cnt + 1;
                                            } 
                                        } else { ?>
                                            <tr>
                                                <td colspan="6" style="color:red; font-size:16px;">No record found</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- [ form-element ] end -->
</div>
</div>
</div>
</div>


    <!----- End Incident Search------------>

        <!-- [ Main Content ] start -->
        <div class="row">
          
            <!-- [ form-element ] start -->
            <div class="col-sm-12">
                <div class="card">
                 
                    <div class="card-body">
                        <h5>View Incident History</h5>
                        <hr>
                       
                      <div class="row">
                            <div class="col-xl-12">
                <div class="card">
                   
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                        <tr><th>#</th>
											<th>Incident No</th>
											<th>Incident Reporter Name</th>
											<th>Reg Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
                                </thead>
                                <tbody>
                                    <?php 
$uid=$_SESSION['id'];
$query=mysqli_query($con,"select tblincidents.*,users.fullName as name from tblincidents join users on users.id=tblincidents.userId where tblincidents.userId='$uid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>  
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['complaintNumber']);?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
                                            <td> <?php echo htmlentities($row['regDate']);?></td>
                                             <td>
                                                <?php $status=$row['status'];
                                                if($status==''): ?>
                                                <span class="badge badge-danger">Not Processed Yet</span>
                                            <?php elseif($status=='in process'):?>
                                             <span class="badge badge-warning">In Process</span>
                                         <?php elseif($status=='closed'):?>
                                             <span class="badge badge-success">Closed</span>
                                         <?php endif;?>
</td>
                                           

<td>   <a href="incident-details.php?cid=<?php echo htmlentities($row['complaintNumber']);?>" class="btn btn-primary btn-sm"> View Details</a> 
											</td>

                                        </td>
                                            

                                        </tr>
                                        <?php $cnt=$cnt+1; } ?>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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




</body>

</html>
<?php } ?>