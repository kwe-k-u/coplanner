<?php
	require_once(__DIR__."/../controllers/public_controller.php");
	require_once(__DIR__."/../controllers/admin_controller.php");

	$result = signup_controller("email","kweku","first.user@email.com","pass");
	echo "First email sign up =>" .($result == 1) ?"Success" : "Failed";

	$result = signup_controller("email","kweku","second.user@email.com","pass");
	echo "Second email sign up =>" .($result == 1) ?"Success" : "Failed";


	$result = signup_controller("google","Google person","google_user_1");
	echo "Google sign up =>" .($result == 1) ?"Success" : "Failed";

	$result = signup_controller("apple","Apple person","apple_user_1");
	echo "Apple sign up =>" .($result == 1) ?"Success" : "Failed";

	$result = apple_login("apple_user_1");
	echo "Apple login =>" .($result == 1) ?"Success" : "Failed";

	$result = google_login("google_user_1");
	echo "Google login =>" .($result == 1) ?"Success" : "Failed";


	$result = email_login("somebody","password");
	echo "Wrong email login =>" .($result != 1) ? "Success" : "Failed";

	$result = email_login("first.user@email.com","pass");
	echo "Correct Email Login => " .($result == 1) ? "Success" : "Failed";


	$result = create_destination("Shai Hills","Bunso, Eastern Region",15.23,-5.33,1);
	echo "Destination add (Shai Hills) => " .($result == 1) ? "Success" : "Failed";


	$result = create_destination("Bunso Eco Park","Bunso, Eastern Region",15.23,-5.33,1);
	echo "Destination add (Bunso Eco Park) => " .($result == 1) ? "Success" : "Failed";
	$destination_id = get_destinations_by_name("Bunso Eco Park")[0]["destination_id"];


	$result = add_destination_activity($destination_id,"Hiking",0);
	echo "Destination activity (Hiking) =>" . ($result == 1) ? "Success" : "Failed";

	$result = add_destination_activity($destination_id, "Sightseeing",1);
	echo "Destination activity (Sightseeing) =>" . ($result == 1) ? "Success" : "Failed";

	$destination_id = get_destinations_by_name("Shai")[0]["destination_id"];
	$result = add_destination_activity($destination_id, "Sightseeing",1);
	echo "Destination activity (Sightseeing) =>" . ($result == 1) ? "Success" : "Failed";



?>