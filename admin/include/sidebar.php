
		<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar  ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="assets/images/user/user-gear.png" alt="User-Profile-Image">
						<div class="user-details">
							<?php
								$id=intval($_SESSION["aid"]);
								$query=mysqli_query($con,"select * from admin where id='$id'");
								while($row=mysqli_fetch_array($query))
								{
								?>	
							<span><?php echo  htmlentities($row['fullname']);?></span>
							<div id="more-details"><?php echo  htmlentities($row['email']);?><i class="fa fa-chevron-down m-l-5"></i></div><?php } ?>
						</div>
					</div>
					<div class="collapse" id="nav-user-link">
						<ul class="list-unstyled">
							<li class="list-group-item"><a href="admin-profile.php"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
							<li class="list-group-item"><a href="setting.php"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
							<li class="list-group-item"><a href="logout.php"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
						</ul>
					</div>
				</div>
				
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>Admin Management</label>
					</li>
					<li class="nav-item">
					    <a href="dashboard.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					
					<li class="nav-item">
					    <a href="category.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Add Category</span></a>
					</li>
					<!-- <li class="nav-item">
					    <a href="subcategory.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Add Subcategory</span></a>
					</li> -->
					<li class="nav-item">
					    <a href="manage-users.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Manage Users</span></a>
					</li>







					<li class="nav-item pcoded-menu-caption">
						<label>User Incidents</label>
					</li>


					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Manage Complaint</span></a>
						<ul class="pcoded-submenu">
							<li>
	<a href="all-incident.php">All Incidents</a></li>
							<li>
	<a href="notprocess-incident.php">Not Process Yet</a></li>
							<li>
								<a href="inprocess-incident.php">In Process</a></li>
							
							<li><a href="closed-incident.php">Closed Incidents</a></li>
							
						</ul>
					</li>
					<li class="nav-item pcoded-menu-caption">
						<label>Search</label>
					</li>
					<li class="nav-item">
					    <a href="user-search.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-search"></i></span><span class="pcoded-mtext">User Search</span></a>
					</li>
					<li class="nav-item">
					    <a href="incident-search.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-search"></i></span><span class="pcoded-mtext">Search Complaint</span></a>
					</li>
					

				</ul>
				
		
				
			</div>
		</div>
	</nav>