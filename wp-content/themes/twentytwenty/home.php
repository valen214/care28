<!DOCTYPE html>
<html>
<head>


<style>
* {
  box-sizing: border-box;
}

html, body {
  height: 100%;
  width: 100%;
  margin: 0;
  border: 0;
}

</style>

</head>
<body>



<?php





include __DIR__ . "/template-parts/top-bar.php";

getTopBar();

echo "<pre>";
var_dump(wp_get_upload_dir());