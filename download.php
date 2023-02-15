<?php
if (isset($_GET['file'])) {
  $filename = $_GET['file'];
  $filePath = '' . $filename;

  if (file_exists($filePath)) {
    header('Content-Type: application/octet-stream');
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
  }
}
