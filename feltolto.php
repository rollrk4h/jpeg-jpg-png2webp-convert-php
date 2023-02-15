<!DOCTYPE html>
<html>

<head>
  <title>Képfeltöltő és konvertáló</title>
</head>
<style>
  body {
    background-color: #F8F8F8;
    font-family: Arial, sans-serif;
    margin: 0 auto;
    text-align: center;
  }

  .container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .upload-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    border: 2px dashed #ccc;
    background-color: #fff;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    text-align: center;
    margin: 0 auto;
    margin-top: 100px;
  }

  .upload-form h1 {
    font-size: 24px;
    margin: 0 0 20px;
  }

  .upload-form input[type="file"] {
    display: none;
  }

  .upload-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
  }

  .upload-btn:hover {
    background-color: #3e8e41;
  }

  .upload-form label {
    display: block;
    background-color: #fff;
    color: #555;
    border: 2px solid #ccc;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
    margin: 20px 0;
  }

  .upload-form label:hover {
    background-color: #f2f2f2;
  }

  .upload-form #file-name {
    margin: 20px 0 0;
    font-size: 18px;
    font-weight: bold;
    color: #4CAF50;
  }
</style>

<body>
  <div class="upload-form">
    <h1><br>JPEG/JPG/PNG -> WEBP <br> CONVERTER</h1>
  </div>
  <input type="file" name="fileToUpload" id="imageUpload" />
  <button class="upload-btn" id="uploadButton">Upload</button>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#uploadButton").on("click", function() {
        // Get the selected file from the input element
        var file = $("#imageUpload")[0].files[0];

        // Create a FormData object to send the file data to the server
        var formData = new FormData();
        formData.append("file", file);

        // Send the file to the server using AJAX
        $.ajax({
          url: "upload.php", // Replace with your server-side script that handles the upload
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            // Once the server has processed the file, it will respond with the filename
            // Use the filename to download the file back to the client
            var filename = response;
            var downloadUrl = "download.php?file=uploaded_image.webp";

            // Create an invisible link to download the file
            var link = document.createElement("a");
            link.href = downloadUrl;
            link.download = filename;
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Delete the file from the server using AJAX
            $.ajax({
              url: "delete.php", // Replace with your server-side script that deletes the file
              type: "POST",
              data: {
                file: "uploaded_image.webp"
              },
              success: function(response) {
                console.log(response);
              },
              error: function(xhr, status, error) {
                console.log("Error deleting file: " + error);
              },
            });
          },
          error: function(xhr, status, error) {
            console.log("Error uploading file: " + error);
          },
        });
      });
    });
  </script>
</body>

</html>