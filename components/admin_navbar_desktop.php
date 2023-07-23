<aside class="sidebar d-lg-flex d-none flex-column justify-content-between bg-gray-3" id="curator_side_bar">
	<ul class="main-list slide-down">
		<li>
			<a data-target="dashboard-submenu-sb" class="slide-down-btn" id="nav_dash" href="dashboard.php">
				<img src="../assets/images//svgs/dashboard.svg" alt="dashboard image"> Dashboard </a>
		</li>
		<li>
			<div class="slide-down-menu">
				<a data-target="trips-submenu-sb" class="slide-down-btn" id="nav_trips" href="#"><img src="../assets/images//svgs/trips.svg" id="d" alt="dashboard image"> Trips <span class="arrow"><img src="../assets/images/svgs/arrow-down.svg" alt="arrow down image"></span></a>
				<ul id="trips-submenu-sb" class="sub-menu slide-down-sub-menu">
					<li><a href="group_trips.php" id="nav_sub_groups">Group Trips</a></li>
					<li><a href="private_trips.php" id="nav_sub_private">Private Trips</a></li>
					<!-- <li><a href="all_trips.php">Trips</a></li> -->
				</ul>
			</div>
		</li>

		<li>
			<div class="slide-down-menu">
				<a data-target="users-submenu-sb" class="slide-down-btn" id="nav_users" href="#"><img src="../assets/images//svgs/trips.svg" alt="dashboard image"> Users <span class="arrow"><img src="../assets/images/svgs/arrow-down.svg" alt="arrow down image"></span></a>
				<ul id="users-submenu-sb" class="sub-menu slide-down-sub-menu">
					<li><a href="curators.php" id="nav_sub_groups">Curators</a></li>
					<li><a href="users.php" id="nav_sub_private">Tourists</a></li>
				</ul>
			</div>
		</li>
		<li>
			<a href="locations.php" id="nav_finance">
				<img src="../assets/images/svgs/finance.svg" alt="finance icon">
				 Locations
			</a>
		</li>
		<li>
			<a href="bookings.php" id="nav_finance">
				<img src="../assets/images/svgs/finance.svg" alt="finance icon">
				 Finance
			</a>
		</li>
		<!-- <li><a href="notifications.php"><img src="../assets/images/svgs/notifications.svg" alt="notifications icon">Notifications</a></li> -->

		<li>
			<div class="slide-down-menu">
				<a data-target="settings-submenu-sb" class="slide-down-btn" id="nav_account" href="#"><i class="fa-solid fa-gear"></i> Settings <span class="arrow"><img src="../assets/images/svgs/arrow-down.svg" alt="arrow down image"></span></a>
				<ul id="settings-submenu-sb" class="sub-menu slide-down-sub-menu">
					<li><a href="curator_id_verification.php" id="nav_settings_curator_id">Curator ID approvals</a></li>
					<li><a href="curator_verification.php" id="nav_settings_verification">Verification Requests</a></li>
					<li><a href="users.php" id="nav_settings_media">Media management</a></li>
				</ul>
			</div>
		</li>
		<!-- <li><a href="account_settings.php"><img src="../assets/images/svgs/notifications.svg" alt="settings icon">Account Settings</a></li> -->
	</ul>
	<div class="py-4 border-top">
		<a class="easygo-fs-4 text-red" onclick="return logout()"><img src="../assets/images/svgs/logout.svg" alt="logout icon"> Logout</a>
	</div>
</aside>