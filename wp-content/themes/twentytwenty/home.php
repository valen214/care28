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
<?php


include __DIR__ . "/template-parts/top-bar.php";
include __DIR__ . "/api/custom_table_constants.php";


?>
<body>

<script>
(function(){
  
  let injectStyleSheet = (href) => {
    let link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = href;
    document.head.appendChild(link);
  };

  let SCRIPT_ORIGIN = "http://150.136.251.80:8000";
  injectStyleSheet(SCRIPT_ORIGIN + "/pages/Home.css");
  import(
    SCRIPT_ORIGIN + "/pages/Home.js"
  ).then(module => {
    new module.default({
      target: document.body,
      props: {

      }
    });
  });
})();
</script>
