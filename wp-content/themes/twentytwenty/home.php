<!DOCTYPE html>
<?php


include __DIR__ . "/template-parts/top-bar.php";
include __DIR__ . "/api/custom_table_constants.php";

$SCRIPT_ORIGIN = "http://150.136.251.80:8000";

?>
<html>
<head>


<link rel="preload" as="style"
    href="<?php echo $SCRIPT_ORIGIN; ?>/pages/Home.css" />
<link rel="modulepreload"
    href="<?php echo $SCRIPT_ORIGIN; ?>/pages/Home.js" />

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
  
  let injectStyleSheet = (href) => {
    let link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = href;
    document.head.appendChild(link);
  };

  let SCRIPT_ORIGIN = "<?php echo $SCRIPT_ORIGIN; ?>";
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
