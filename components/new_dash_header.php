<header class="dashboard-header">

		<button class="burger-btn  blue-burger" data-target="dash-sidebar">
			<div class="bg-blue"></div>
			<div class="bg-blue"></div>
			<div class="bg-blue"></div>
		</button>

		<div class="profile-pill dropdown">

				<?php
					echo "<img src='$logo' alt='' width='32' height='32' class='rounded-circle me-2'>
					<p class='text-gray-1'>Hi, <span class='text-black'>$user_name</span></p>";
				?>

				<ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
					<li><a class="dropdown-item" href="#">New Trip</a></li>
					<li><a class="dropdown-item" href="#">Settings</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="#">Sign out</a></li>
				  </ul>
		</div>

	</header>