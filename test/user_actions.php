<?php
	require_once(__DIR__."/../controllers/interaction_controller.php");
	require_once(__DIR__."/../utils/core.php");
	$user_id = get_session_user_id();
	echo $user_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>test - User actions</title>
</head>
<body>

	
	<form action="" onsubmit="request_reset(this)">
		<h4>Reset password</h4>
		<label for="">Email</label>
		<input type="email" name="email" ><br>

		<button type="submit">Reset</button>
	</form>




	<h4>Curator following</h4>
	<div id="curatorlist">
		<ol>
			<?php
				$curators = get_all_curators();
				foreach ($curators as $curator) {
					$c_name= $curator["curator_name"];
					$c_id=$curator["curator_id"];
					$is_following = is_user_following_curator($user_id,$c_id);

					if ($is_following){
						echo "<li>".
							$curator["curator_name"]
							."<button onclick='unfollow_curator(\"$user_id\",\"$c_id\")'>Unfollow</button>"
						."</li>";
					}else{
						echo "<li>".
							$c_name
							."<button onclick='follow_curator(\"$user_id\",\"$c_id\")'>Follow</button>"
						."</li>";

					}
				}
			?>
		</ol>
	</div>





	<h4>Curator following</h4>
	<div id="wishlist">
		<ol>
			<?php
				$campaigns = get_all_campaigns();
				foreach ($campaigns as $campaign) {
					$c_name= $campaign["title"];
					$c_id=$campaign["campaign_id"];
					$is_following = is_campaign_wishlisted($user_id,$c_id);

					if ($is_following){
						echo "<li>".
							$c_name
							."<button onclick='remove_from_wishlist(\"$user_id\",\"$c_id\")'>Remove from wishlist</button>"
						."</li>";
					}else{
						echo "<li>".
							$c_name
							."<button onclick='add_to_wishlist(\"$user_id\",\"$c_id\")'>Add to wishlist</button>"
						."</li>";

					}
				}
			?>
		</ol>
	</div>

	<script>


		function follow_curator(user_id,curator_id){
			// alert("user is " + user_id+ " and curator is "+curator_id);
			payload = "action=follow_curator";
			payload += "&user_id="+user_id;
			payload += "&curator_id="+curator_id;
			send_request(
				"POST",
				"../processors/processor.php",
				payload,
				(response)=>{
					window.location.reload();
				}
			);
		}


		function unfollow_curator(user_id,curator_id){
			// alert("user is " + user_id+ " and curator is "+curator_id);
			payload = "action=unfollow_curator";
			payload += "&user_id="+user_id;
			payload += "&curator_id="+curator_id;
			send_request(
				"POST",
				"../processors/processor.php",
				payload,
				(response)=>{
					window.location.reload();
				}
			);
		}


		function add_to_wishlist(user_id,campaign_id){
			payload = "action=add_campaign_wishlist";
			payload += "&user_id="+user_id;
			payload += "&campaign_id="+campaign_id;
			send_request(
				"POST",
				"../processors/processor.php",
				payload,
				(response)=>{
					window.location.reload();
				}
			);
		}


		function remove_from_wishlist(user_id,campaign_id){
			// alert("user is " + user_id+ " and curator is "+curator_id);
			payload = "action=remove_campaign_wishlist";
			payload += "&user_id="+user_id;
			payload += "&campaign_id="+campaign_id;
			send_request(
				"POST",
				"../processors/processor.php",
				payload,
				(response)=>{
					window.location.reload();
				}
			);
		}


		function request_reset(form){
			event.preventDefault();
			var email = form.email.value;
			payload = "action=request_password_reset";
			payload += "&email=" + email;

			send_request(
				"POST",
				"../processors/processor.php",
				payload,
				(response) =>{
					alert(response);
				}
			);
		}

		function send_request(type, endpoint, data, onFinish){
			const xhttp = new XMLHttpRequest();
			xhttp.open(type, endpoint);
			xhttp.onreadystatechange = function (){
				if (xhttp.readyState == XMLHttpRequest.DONE){
					onFinish(xhttp.response);
				}
			}
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send(data);
		}



		function url_params(key){
			url = window.location.search.substr(1);
			params = url.split("&");
			params.forEach(element => {
				pair = element.split("=");
				element_key = pair[0];
				if(element_key= key){
					value = pair[1];
				}
			});

			return value;
		}
	</script>

</body>
</html>