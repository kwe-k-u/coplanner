<?php
	$id = get_session_user_id();

	$info = get_collaborator_info($id);
	$curator_id = get_session_account_id();

	$balance = format_string_as_currency_fn(get_curator_statistics($id)["withdrawable_balance"]);
	$name = $info["user_name"];
	$company = $info["curator_name"];;
	$page = explode("/",$_SERVER["SCRIPT_NAME"]);
	$page = end($page);
	switch($page){
		case "create_a_trip.php":
		case "trips.php":
		case "group_trips.php":
			$page = "Group Tours";
			break;
		case "private_trips.php":
			$page = 'Private Tours';
			break;
		case "account_settings.php":
			$page = "Account Settings";
			break;
		case "transactions.php":
			$page = "Transactions";
			break;
		default:
			$page = "Dashboard";
	}
?>
<header class="dashboard-header d-none d-lg-flex">
            <div class="dashlogo logo logo-medium">
                <img class="img-fluid" src="../assets/images/svgs/logo.svg" alt="easygo logo">
            </div>

			<?php echo "<div class='dashboard-title'>$page</div>"; ?>
            <div class="right-sec">
                <form id="dashboard-search">
                    <div class="form-input-field">
                        <input class="p-2" type="text" placeholder="search">
                    </div>
                </form>
                <div class="balance d-flex flex-column justify-content-center">

					<?php echo "<h4 class='m-0 easygo-fs-3 easygo-fw-1'>GHC $balance</h4>"; ?>
                    <small class="easygo-fs-5 text-orange">Withdrawable balance</small>
                </div>
                <div class="user-menu d-flex gap-1">
                    <div class="user-icon">
                        <img src="../assets/images/others/profile.jpeg" alt="">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
						<?php
						echo "
                        <h5 class='easygo-fs-3'>$company</h5>
                        <h6 class='text-orange easygo-fs-5'>$name</h6>
						";

						?>
                    </div>
                </div>
            </div>
        </header>