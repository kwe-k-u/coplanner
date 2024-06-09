<?php
	require_once(__DIR__ . "/../utils/core.php");
	require_once(__DIR__ . "/../controllers/admin_controller.php");


	if(!is_session_user_admin()){
		header("Location: ../index.php");
		die();
	}

	$category = isset($_GET["category"]) ? $_GET["category"]: "all";





?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex, nofollow" />

    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin || Media management</title>
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- easygo css -->
	<link rel="stylesheet" href="../assets/css/general.css">
	<link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
	<!-- ============================== -->
	<!-- main-wrapper [start] -->
	<div class="main-wrapper">
		<?php require_once(__DIR__ . "/../components/admin_header.php") ?>
		<?php require_once(__DIR__ . "/../components/admin_navbar_mobile.php"); ?>
		<!-- ============================== -->
		<!-- dashboard content [start] -->
		<main class="dashboard-content">
			<?php require_once(__DIR__ . "/../components/admin_navbar_desktop.php"); ?>
			<div class="main-content px-3">
				<section class="all-trips">
					<div class="d-flex justify-content-between align-items-center border-1 border-bottom py-3">
						<div>
							<h5 class="title easygo-fs-3 easygo-fw-1 m-0">All Media</h5>
							<small class="easygo-fs-5 text-gray-1 align-middle"><a href="#">Admin</a> <i class="fa-solid fa-chevron-right"></i> media management</small>
						</div>

						<div class="form-input-field">
							<div class="text-gray-1 easygo-fs-4">Categories</div>

							<select name="collaborator_role" onchange="return select_media_category(this)">
								<option value="all" <?php  echo ($category == "all") ? "selected": "" ?>>All</option>
								<option value="curator" <?php  echo ($category == "curator") ? "selected": "" ?>>Curator uploads</option>
								<option value="campaign" <?php  echo ($category == "campaign") ? "selected": "" ?>>Campaign media</option>
								<option value="destination" <?php  echo ($category == "destination") ? "selected": "" ?>>Destination media</option>
							</select>
						</div>
						<!-- <a href="create_a_tour.php" class="easygo-btn-1">Create a Trip</a> -->

					</div>
					<!-- ============================== -->
					<!-- tirp card listing [start] -->
					<div class="trip-cards">
						<div class="row pt-5">
							<!-- ============================== -->
							<!-- tirp card [start] -->
							<?php
							if($category == "all"){

								$media = get_media();
							}else{
								$media = get_media_by_category($category);
							}
							// $trips = null;
							// var_dump($trips);

							if (!$media) {
								echo "<h4>There aren't any uploaded media</h4>";
							} else {
								foreach ($media as $entry) {
									$id = $entry["media_id"];
									$type = $entry["media_type"];
									$location = $type == "confidential" ? "" : $entry["media_location"];
									$is_foreign =  isset($entry["is_foreign"]) ? $entry["is_foreign"] : null;
									$category = $category == "all" ? $entry["category"] : $category;
									$date = format_string_as_date_fn($entry["upload_date"]);

									echo "
                                        <div class='col-lg-4 col-md-6 pb-4'>
                                <div class='trip-card-2'>
                                    <div class='trip-card-img'>
                                        <img src='$location' alt=' image'>
                                    </div>
                                    <div class='trip-card-content'>
                                        <h5 class='header'>$date</h5>
                                        <div class='easygo-fs-5 d-flex align-items-center justify-content-between'>
                                            <div><i class='fa-regular fa-calendar-days' text-capitalised></i> $category</div>
                                            <div><i class='fa-solid fa-pen-to-square'></i>$date</div>
                                        </div>
                                        <div class='easygo-fs-5'>
                                        </div>
                                        <div class='py-3 d-flex justify-content-between align-items-center easygo-fs-5'>
                                            <span><i class='fa-solid fa-tag'></i> $type</span>
                                            <div>
                                                <a class='btn px-3 py-1 border easygo-fs-5' href='#'>Verify</a>
                                                <a class='btn px-3 py-1 border easygo-fs-5' href='#' onclick='delete_media(\"$id\")'>Delete</a>
                                                <a class='btn px-3 py-1 border easygo-fs-5' href='#' data-bs-target='#changeMedia_modal' onclick='set_changeMedia_id(\"$id\")' data-bs-toggle='modal'>Change</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        ";
								}
							}
							?>

						</div>
					</div>
					<!-- tirp card listing [end] -->
					<!-- ============================== -->
				</section>
			</div>
		</main>
		<!-- dashboard-content [end] -->
		<!-- ============================== -->
	</div>
	<!-- main-wrapper [end] -->
	<!-- ============================== -->



	<!-- ============================== -->
	<!-- ID modal [start] -->
	<div class="modal fade" id="changeMedia_modal">
		<div class="modal-dialog modal-xl">
			<div class="modal-content p-5">

				<form method="post" action="../test/test.php" onsubmit="change_media(this)">
					<div class="d-flex gap-2">

						<div class="form-input-field">
							<input class="px-4 py-2 flex-grow-1" id="change_media_input" type="text" placeholder='Image url' accept='.png, .jpg, .jpeg' name="media">
						</div>
						<input type="hidden" name="media_id" id="changeMedia_id">

						<div class="form-input-field">

							<select name="media_type" onchange="return change_media_select(this)">
								<option value="text">From web</option>
								<option value="file">Upload</option>
							</select>
						</div>
						<div>
							<button class="btn btn-default border text-blue px-4 py-2" type="submit">Change</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- ID modal [end] -->
	<!-- ============================== -->


	<!-- ============================== -->
	<!-- Bootstrap js -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
	<!-- JQuery js -->
	<script src="../assets/js/jquery-3.6.1.min.js"></script>
	<!-- easygo js -->
	<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
	<script src="../assets/js/functions.js"></script>
	<script src="../assets/js/admin/media.js"></script>
	<script src="../assets/js/general.js"></script>
	<!-- Custom script-->
	<script>
		function select_curator(){
			let id = event.target.value;
			if (id){
				goto_page("admin/template_itineraries.php?curator_id="+id);
			}else{
				goto_page('admin/template_itineraries.php');
			}
		}
	</script>
</body>

</html>