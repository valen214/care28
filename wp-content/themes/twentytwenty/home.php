<!DOCTYPE html>
<html>
<head>


<link rel="preload" as="style"
    href="/pages/Home.css" />
<link rel="modulepreload"
    href="/pages/Home.js" />

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

  injectStyleSheet("/pages/Home.css");
  import(
    "/pages/Home.js"
  ).then(module => {
    new module.default({
      target: document.body,
      props: <?php
      include __DIR__ . "/api/pages/home.php";
      echo homePageProps();

      ?>
    });
  });
})();
</script>
