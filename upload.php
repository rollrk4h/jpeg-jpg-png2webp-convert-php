<?php
if ($_FILES["file"]["error"] > 0) {
  echo "Error uploading file: " . $_FILES["file"]["error"];
} else {
  // Get file extension
  $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

  // Create image resource from uploaded file
  switch ($extension) {
    case "jpg":
    case "jpeg":
      $image = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
      break;
    case "png":
      $image = imagecreatefrompng($_FILES["file"]["tmp_name"]);
      break;
    default:
      echo "Invalid file type. Only JPEG and PNG are supported.";
      exit;
  }

  // Convert image to WebP format with 90% quality
  imagewebp($image, "uploaded_image.webp", 90);

  // Force download of the WebP image
  header("Content-Disposition: attachment; filename=\"uploaded_image.webp\"");
  header("Content-Type: image/webp");
  readfile("uploaded_image.webp");

  // Delete the temporary file
  //unlink("uploaded_image.webp");
}
