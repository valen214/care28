<?php
/**
 * Template Name: Login Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<script>
(function(){

let injectStyleSheet = (href) => {
  let link = document.createElement("link");
  link.rel = "stylesheet";
  link.href = href;
  document.head.appendChild(link);
};

let SCRIPT_ORIGIN = "http://150.136.251.80:8000";
injectStyleSheet(SCRIPT_ORIGIN + "/pages/Login.css");
import(
  SCRIPT_ORIGIN + "/pages/Login.js"
).then(module => {
  new module.default({
    target: document.body,
    props: {

    }
  });
});


})();
</script>