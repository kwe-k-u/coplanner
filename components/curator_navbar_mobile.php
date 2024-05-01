<header class="nav-menu d-lg-none">
	<div class="nav-menu-title bg-blue text-white easygo-fw-1 py-3 ps-3 d-flex justify-content-between">
		<div class=" logo logo-small">
                <img class="dashlogo img-fluid" src="../assets/images/site_images/logo.png" alt="easygo logo">
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
				<a href="#"><img src="../assets/images/svgs/dashboard.svg" alt="trips icon">
					Dashboard
				</a>
			</li>
			<li><a href="bookings.php"><img src="../assets/images/svgs/finance.svg" alt="finance icon"> Bookings</a></li>
			<li><a href="account_settings.php"><i class="fa-solid fa-gear"></i>Account Settings</a></li>
			<li><a href="#" onclick="return logout()"><img src="../assets/images/svgs/logout.svg" alt="notifications icon">Log out</a></li>
		</ul>
	</div>
</header>