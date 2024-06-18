<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	</head>
<?php
    include "../conn.php";
    $ImageData = $_GET['ImgNum'] ?? '';
    $ImageCount = $_GET['ImgCount'] ?? '';


    $sql_img = "SELECT PICTURE FROM u896821908_bts.newupdate WHERE idNewUpdate = :imageCount";
    $stmt_img = $conn->prepare($sql_img);
    $stmt_img->bindParam(':imageCount', $ImageCount, PDO::PARAM_INT); // Bind the parameter
    $stmt_img->execute();
    
    // Check if the query returned any results
    if ($stmt_img->rowCount() > 0) {
        $row = $stmt_img->fetch(PDO::FETCH_ASSOC);
        $imageValue = $row['PICTURE'];
        $_SESSION['ImgPrevValue'] = basename($imageValue);
    } else {
        // Set a default blank value
        $_SESSION['ImgPrevValue'] = "";
    }
    
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_Update"])) {
        // Check if an image was uploaded


        
        if (isset($_FILES["img_input"]) && $_FILES["img_input"]["error"] === UPLOAD_ERR_OK) {
            try {
                // Move the uploaded image file to the desired location using the original filename
                $destinationDir = "../img/drive-download-20230614T125330Z-001/";
                $destinationPath = $destinationDir . $_FILES["img_input"]["name"];
    
                if (move_uploaded_file($_FILES["img_input"]["tmp_name"], $destinationPath)) {
                    // Update the image path in the database
                    $imagePath = $destinationPath;

                    // Update the image data in the database
                    $sql_update = "UPDATE newupdate SET PICTURE = :imageData WHERE idNewUpdate = :imageCount";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bindParam(':imageData', $imagePath, PDO::PARAM_LOB);
                    $stmt_update->bindParam(':imageCount', $ImageCount, PDO::PARAM_INT); // Bind the parameter
                    $stmt_update->execute();
                } else {
                    echo "Error moving uploaded image.";
                }
    
                // Display image details in JavaScript console
                echo '<script>
                var currentURL = new URL(window.location.href);
                currentURL.searchParams.delete("ImgNum");
                currentURL.searchParams.delete("ImgCount");
                
                window.history.replaceState({}, document.title, currentURL.href);
                window.location.reload();
            </script>';
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            // No file uploaded or file input empty
            echo "No file uploaded.";
        }

      

    } else {
        // Set default photo path
        $defaultPhotoPath = "../img/drive-download-20230614T125330Z-001/LOGIN PAGE.png";
    }

    ?>

<body>
    <div id="modal_img1" class="modal_img1">

        <div class="modal-content_img1">
            <div class="modal-header_img1">
                <span class="close_img1">&times;</span>
                <center><h2>Modal Img <?php echo $_SESSION['ImgPrevValue']?></h2></center>
            </div>
            <div class="modal-body_img1">
                <form action="#" method="post" enctype="multipart/form-data">
                    <center>
                        <div id="img-prev" ></div>

                        <br>
						<input type="file" name="img_input" id="fileInput" class="custom-file-input">
						<label for="fileInput" class="custom-file-label">Choose a file</label>
                    </center>
                    <br>
            </div>
            <div class="modal-footer_img1">
                <center>
                    <input type="submit" name="submit_Update" value="Update" class="Submit_Img" id= "UpdateImg">
                    <input type="reset" name="reset" value="Cancel" class="Cancel_Img" id="cancelButton">
                </center>
            </div>
            </form>

        </div>

    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var modal_img1 = document.getElementById("modal_img1");
    var span_img1 = document.getElementsByClassName("close_img1")[0];

    $(document).ready(function () {
        // Bind a click event to the Cancel button
        $("#cancelButton").click(function () {
            var currentURL = new URL(window.location.href);
            currentURL.searchParams.delete('ImgNum');
            currentURL.searchParams.delete('ImgCount');

            window.history.replaceState({}, document.title, currentURL.href);
            window.location.reload();
        });

        
    });
</script>

</html>