
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['aid'])==0)
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
    <title>IMS|| Incidents Details</title>
   

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
    
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
                            <h5 class="m-b-10">Incidents Details</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="all-incident.php">Incidents Details</a></li>
                            
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
                 
                    <div class="card-body">
                        <h5>View Incidents Details</h5>
                        <hr>
                       
                      <div class="row">
                            <div class="col-xl-12">
                <div class="card">
                   
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                      
                                </thead>
                                <tbody>
                                   <?php $st='closed';
                                   $cid=$_GET['cid'];
$query=mysqli_query($con,"select tblincidents.*,users.fullName as name,category.categoryName as catname from tblincidents join users on users.id=tblincidents.userId join category on category.id=tblincidents.category where tblincidents.complaintNumber='$cid'");
while($row=mysqli_fetch_array($query))
{

?>                                  
                                        <tr>
                                            <td><b>Incident Number</b></td>
                                            <td><?php echo htmlentities($row['complaintNumber']);?></td>
                                            <td><b>Incident Reporter Name</b></td>
                                            <td> <?php echo htmlentities($row['name']);?></td>
                                            <td><b>Reg Date</b></td>
                                            <td><?php echo htmlentities($row['regDate']);?>
                                            </td>
                                        </tr>

<tr>
                                            <td><b>Incident Category </b></td>
                                            <td colspan="3"><?php echo htmlentities($row['catname']);?></td>
                                            <td><b>Incident Priority</b></td>
                                            <td colspan="5"><?php echo htmlentities($row['complaintPriority']);?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td ><b>Incident Reporter Name</b></td>
                                            <td colspan="5"> <?php echo htmlentities($row['reporter_name']);?></td>
                                            
                                        </tr>
<tr>
                                            <td><b>Complaint Details </b></td>
                                            
                                            <td colspan="5"> <?php echo htmlentities($row['complaintDetails']);?></td>
                                            
                                        </tr>

                                            </tr>
<tr>
<td><b>Final Status</b></td>
                                            
                              <td colspan="5"> <?php $status=$row['status'];
                                                if($status==''): ?>
                                                <span class="badge badge-danger">Not Processed Yet</span>
                                            <?php elseif($status=='in process'):?>
                                             <span class="badge badge-warning">In Process</span>
                                         <?php elseif($status=='closed'):?>
                                             <span class="badge badge-success">Closed</span>
                                         <?php endif;?></td>
                                            
                                        </tr>
                                        <hr>




<?php $ret=mysqli_query($con,"select incidentremark.remark as remark,incidentremark.status as sstatus,incidentremark.remarkDate as rdate from incidentremark join tblincidents on tblincidents.complaintNumber=incidentremark.complaintNumber where incidentremark.complaintNumber='$cid'");
$cnt=1;
$count=mysqli_num_rows($ret);
if($count): ?>
<tr>
<th>S.No</th>
<th colspan="3">Remark</th>
<th>Status</th>
<th>Updation Date</th>
</tr>
    <?php 
while($rw=mysqli_fetch_array($ret))
{
?>
                                         <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td colspan="3"><?php echo  htmlentities($rw['remark']); ?></td>
                                            <td><?php echo  htmlentities($rw['sstatus']); ?></td>
                                            <td><?php echo  htmlentities($rw['rdate']); ?></td></tr><?php $cnt=$cnt+1; } endif; ?>





<tr>
                                           
                                            
                                            <td> 
                                            <?php if($row['status']=="closed"){

                                                } else {?>
<a href="javascript:void(0);" onClick="popUpWindow('updateincident.php?cid=<?php echo htmlentities($row['complaintNumber']);?>');" title="Update order">
                                             <button type="button" class="btn btn-primary">Take Action</button></td>
                                            </a><?php } ?></td>
                                            <td colspan="5"> 
                                            <a href="javascript:void(0);" onClick="popUpWindow('userprofile.php?uid=<?php echo htmlentities($row['userId']);?>');" title="Update order">
                                             <button type="button" class="btn btn-primary">View User Detials</button></a></td>
                                            
                                        </tr>
                                        <?php  } ?>
                                   
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
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>




</body>

</html>
<?php } ?>