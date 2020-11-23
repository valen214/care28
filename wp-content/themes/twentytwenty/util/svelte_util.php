<?php
// this file is imported by ./functions.php

function showSveltePage($PAGE = "Home", $props = []){
?><!DOCTYPE html>
<html>
<head>

<title>Care28</title>

<link rel="stylesheet" type="text/css"
    href="/pages/<?php echo $PAGE; ?>.css" />
<link rel="modulepreload"
    href="/pages/<?php echo $PAGE; ?>.js" />

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

<script>
(function(){
  import(
    "/pages/<?php echo $PAGE; ?>.js"
  ).then(module => {
    new module.default({
      target: document.body,
      props: <?php echo json_encode((object)$props); ?>
    });
  });
})();
</script>

<?php
} /******** END OF showSveltePage() *************************
*************************************************************/