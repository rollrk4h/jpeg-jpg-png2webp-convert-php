<?php
if (isset($_POST['file_name'])) {
  $file_name = $_POST['file_name'];

  if (unlink($file_name)) {
    echo "File deleted successfully.";
  } else {
    echo "Error deleting file.";
  }
} else {
  echo "No file name provided.";
}
