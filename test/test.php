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
        <button onclick="mixpanel_button()">mixpanel button test</button>
        <button onclick="mixpanel_time()">time</button>
    </form>


<script src="../assets/js/jquery-3.6.1.min.js"></script>


<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/functions.js"></script>
<script>
    // $(document).ready(()=>);

    function mixpanel_time(){
        mixpanel.time_event("test timer")
    }

    function mixpanel_button(){
        mixpanel.track("test timer", {"finis": "timed fiined"});

        // mixpanel.track_forms("#test","user email",{"age" : document.getElementsByName("age")[0].value});
    }
</script>
</body>

</html>