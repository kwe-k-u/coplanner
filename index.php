<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="assets/images/site_images/favicon.ico" type="image/x-icon">
</head>
</html>
<?php

	// Capture any existing query string from the current URL
	$queryString = $_SERVER['QUERY_STRING'];

	// Check if there's a query string and prepare it for inclusion in the new URL
	if (!empty($queryString)) {
		$queryString = '?' . $queryString;
	}

	// Check the PATH_INFO or default to a specific redirection
	if (!isset($_SERVER["PATH_INFO"]) || $_SERVER["PATH_INFO"] == "/shared_experiences" || $_SERVER["PATH_INFO"] == "/shared_experience") {
		header("Location: shared_experience/" . $queryString);
	} else {
		header("Location: travel_plan/" . $queryString);
	}
?>