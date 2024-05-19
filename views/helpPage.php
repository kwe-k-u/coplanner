<?php
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");

$hm = new public_class();
$data = $hm->get_transaction("U001");
// echo json_encode($hi);
?>

<!DOCTYPE html>
<html lang="en">
<script src="../assets/js/functions.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="helpPage.css">
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