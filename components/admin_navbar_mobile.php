<header class="nav-menu d-lg-none">
	<div class="nav-menu-title bg-blue text-white easygo-fw-1 py-3 ps-3 d-flex justify-content-between">
		<div class=" logo logo-small">
                <img class="dashlogo img-fluid" src="../assets/images/site_images/logo.webp" alt="easygo logo">
            </div>
		<h6 class="m-0">Dashboard</h6>
		<button data-target="dashboard-menu" class="burger-btn slide-down-btn">
			<div></div>
			<div></div>
			<div></div>
		</button>
	</div>

	<div id="dashboard-menu" class="slide-down-sub-menu">
		<ul class="main-list">
			<li>
				<a href="dashboard.php">
				<img src="../assets/images//svgs/dashboard.svg" alt="dashboard image">
						Dashboard
				</a>

			</li>
			<li>
				<a href="template_itineraries.php">
					<img src="../assets/images/svgs/trips.svg" alt="trips icon">
					Itineraries
				</a>
			</li>
			<li>
				<a href="users.php">
					<img src="../assets/images/svgs/trips.svg" alt="trips icon">
					Users
				</a>
			</li>
			<li>
				<a href="locations.php">
					<img src="../assets/images/svgs/trips.svg" alt="trips icon">
					Destinations
				</a>
			</li>
			<li>
				<a href="transactions.php">
					<img src="../assets/images/svgs/trips.svg" alt="trips icon">
					Transactions
				</a>
			</li>
			<li>
				<div class="slide-down-menu">
					<a data-target="settings-submenu" href="#" class="slide-down-btn">
						Settings
						<span class="arrow"><img src="../assets/images/svgs/arrow-down.svg" alt="arrow down image"></span>
					</a>
					<ul id="settings-submenu" class="sub-menu slide-down-sub-menu">
						<li><a href="destination_requests.php">Destination Requests</a></li>
					</ul>
				</div>
			</li>
			<!-- <li>
				<div class="slide-down-menu">
					<a data-target="dashboard-submenu" class="slide-down-btn" href="#">
					<img src="../assets/images/svgs/trips.svg" alt="trips icon">
						Itineraries
						<span class="arrow"><img src="../assets/images/svgs/arrow-down.svg" alt="arrow down image"></span></a>
					<ul id="dashboard-submenu" class="sub-menu slide-down-sub-menu">
						<li><a href="#">Templates</a></li>
					</ul>
				</div>
			</li> -->
			<!-- <li><a href="#"><img src="../assets/images/svgs/finance.svg" alt="finance icon"> Finance</a></li>
			<li><a href="#"><img src="../assets/images/svgs/notifications.svg" alt="notifications icon">Notifications</a></li> -->
		</ul>
	</div>
</header>