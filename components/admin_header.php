<?php
$id = get_session_user_id();
$name = get_user_accounts($id)["user_name"];
$role = $_SESSION["user_role"];

?>
<header class="dashboard-header d-none d-lg-flex">
	<div class="dashlogo logo logo-medium">
		<img class="img-fluid" src="../assets/images/site_images/logo.png" alt="easygo logo">
	</div>

	<div class="right-sec">
		<form id="dashboard-search">
			<div class="form-input-field">
				<input class="p-2" type="text" placeholder="search">
			</div>
		</form>
		<div class="balance d-flex flex-column justify-content-center">

		</div>
		<div class="user-menu d-flex gap-1">
			<div class="user-icon">
				<img src="../assets/images/others/profile.jpeg" alt="">
			</div>
			<div class="d-flex flex-column justify-content-center">
				<?php
				echo "
                        <h5 class='easygo-fs-3'>$name</h5>
                        <h6 class='text-orange easygo-fs-5 text-capitalize'>$role</h6>
						";

				?>
			</div>
		</div>
	</div>
</header>