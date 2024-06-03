<?php
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");

$hm = new public_class();
$data = $hm->get_transaction("U001");
//Uncomment after connection
// $user_id = get_session_user_id();
// $username = get_user_info($user_id)["user_name"];

$username = "Kwame";
?>

<!DOCTYPE html>
<html lang="en">
<script src="../assets/js/functions.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        margin: 0;
        height: 100vh;
        background: #f5f5f6ed;
        font-family: 'Nunito';
    }
    .body-container{
        margin: 0;
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 100%;
    }
    .right-body-container{
        margin: 0;
        display: flex;
        flex-direction: column;
        width: 77.5%;
        height: 100%;
    }
    .content-container{
        margin: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: auto;
    }


    .content-main {
        height: 90%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        
    }

    .help-container {
        width: 80%;
        height: 80%;
        margin-left: auto;
        margin-right: auto;
    }
    
    .help-main {
        width: 60%;
        margin-left: auto;
        margin-right: auto;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;

    }
    .help-content {
        width: 100%;
        height: 40%;
    }

    .help-subject {
        width: 95%;
        height: 3em;
        
    }
    .help-cont-title {
        font-size: larger;
        margin-left: auto;
        margin-right: auto;
    }
    .page-title  {
        font-size: large;
        font-weight: bold;
        width: 95%;
        margin-left: auto;
        margin-right: auto;

    }

    .help-subject  input {
        width: 100%;
        height: 100%;
        font-size: larger;
        padding: 0 0.5em;
        
    }

    .help-content textarea {
        width: 95%;
        height: 95%;
        padding: 0.5em;
        resize: none;
        overflow: scroll;
        border-radius: 10px; 
    }

    .fileupload {
        border: 1px solid black;
        width: 18em;
        height: 10em;
        align-self: center;
        place-items: center;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        border-radius: 10px; 
        background: white;

    }
    .fileupload div {
        width: 85%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        color: blue;
    }

    .fileupload-button {
        padding: 18px 0px;
        background: #1931A8;
        color: white !important;
        border-radius: 10px; 
    }
    .submit-button {
        padding: 18px 0;
        width: 70%;
        background: #1931A8;
        color: white !important;
        border-radius: 10px;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }

    


    @media screen and (min-width: 768px) {

    }

    @media screen and (max-width: 768px) {
        .body-container{
        /* margin: 0;
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 100%; */
        height: 100%;
        }

        .right-body-container{
            margin: 0;
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
        }
        .content-container{
            margin: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: unset;
            overflow: auto;
        }
        .content-main {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            
        }
        .help-container {
            width: 100%;
        }
        .help-main {
            width: 90%;
        }
        .help-cont-title {
        font-size: larger;
        width: 90%;
        }
        .help-content textarea {
            font-size: x-large;
        }


        .spacer {
            display: none;
        }



    }

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<body>
    <div class = "body-container">
        <!-- sidebar -->
        <?php
        require_once(__DIR__."/sidebar.php");
        ?>
        <div class = "right-body-container">
            <!-- topbar -->
            <?php
            require_once(__DIR__."/topbar.php");
            ?>
            <div class = "content-container">
                <!-- main content here -->

                <div class="content-main">                
                    <div class = "page-title">
                        Help and support
                    </div>
                    <div class = "help-container" > 
                        <div class = "help-cont-title"> Report and Issue </div>
                        <div class = "help-main"> 
                            <div class = "help-subject" >
                                <input type = "text" />
                            </div>
                            <div class ="help-content">
                                <textarea class = "help-content-text"></textarea>
                            </div>
                            <div  id="fileupload"  class = "fileupload" ondragover="handleDragOver(event)" ondrop="handleDrop(event)">
                                
                                    <div >
                                        Drag a file here
                                    </div>
                                    <div >
                                        OR
                                    </div>
                                
                                <div class = "fileupload-button"> Select file </div>
                                <input style = "display:none" type = "file" id = "fileInput" accept="image/*">
                            </div>
                            <div class = "submit-button"> Submit</div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

<script>
const fileInput = document.getElementById('fileInput');
const customButton = 
    document.querySelector('.fileupload');
    customButton.addEventListener('click', () => {
        console.log("hi")
    fileInput.click();
});

function handleDragOver(event) {
    event.preventDefault();
    const dropArea = document.getElementById('fileupload');
    dropArea.classList.add('drag-over');
}

function handleDrop(event) {
    event.preventDefault();
    const dropArea = document.getElementById('fileupload');
    dropArea.classList.remove('drag-over');

    const fileList = event.dataTransfer.files;

    // Ensure only one file is dropped
    if (fileList.length !== 1) {
        alert("Please drop only one file.");
        return;
    }

    const file = fileList[0];
    // const fileInfo = document.createElement('p');
    // fileInfo.textContent = `File: ${file.name}, Type: ${file.type}, Size: ${file.size} bytes`;

    //dropArea.appendChild(fileInfo);
}


</script>
</html>