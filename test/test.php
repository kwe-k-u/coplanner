<?php


require_once(__DIR__ . "/../utils/env_manager.php");
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../utils/google_auth.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Test</title>
    <!-- Paste this right before your closing </head> tag -->
    <script type="module" src="">
        import mixpanel from 'mixpanel-browser';
    </script>

</head>

<body>
    <form action="#" id="test">
        <input type="text" name="age"  value="test user" >
        <button type="submit" onclick="mixpanel_button()">mixpanel button test</button>
    </form>


<script src="../assets/js/jquery-3.6.1.min.js"></script>


<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/functions.js"></script>
<script>
    function mixpanel_button(){
        mixpanel.track_forms("#test","user email",{"age" : document.getElementsByName("age")[0].value});
    }
</script>
</body>

</html>