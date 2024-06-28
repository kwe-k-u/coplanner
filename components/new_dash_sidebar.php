<aside class=" d-md-flex flex-column flex-shrink-0 p-3 bg-light" id="dash-sidebar">
		<a class="navbar-brand d-flex justify-content-center" href="./index.php">
            <img class="logo-medium" src="../assets/images/site_images/logo.webp" alt="">
        </a>
		<hr>
		<?php
		$server_baseurl = server_base_url();
			echo "
			<ul class='nav nav-pills flex-column mb-auto'>
		  <li class='nav-item'>
			<a href='{$server_baseurl}curator/dashboard.php' class='nav-link active' aria-current='page'>
				<i class='fa-solid fa-home'></i>
			  Dashboard
			</a>
		  </li>
		  <li>
			<a href='{$server_baseurl}curator/trips.php' class='nav-link link-dark'>
			  <i class='fa-solid fa-route'></i>
			  Your Trips
			</a>
		  </li>
		  <li>
			<a href='{$server_baseurl}curator/bookings.php' class='nav-link link-dark'>
				<i class='fa-solid fa-receipt'></i>
			  Bookings
			</a>
		  </li>
		</ul>
		<hr>
		  <a href='{$server_baseurl}curator/settings.php' class='d-flex align-items-center link-dark text-decoration-none'>
			<i class='fa-solid fa-gear'></i>
			<strong>Settings</strong>
		  </a>
			";
		?>

	</aside>