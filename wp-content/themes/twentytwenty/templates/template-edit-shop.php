<?php
/**
 * Template Name: Edit Shop Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

include dirname(__DIR__) . "/api/custom_table_constants.php";

$user_ID = get_current_user_id();

$shop_ID = $wpdb->get_var(
  "SELECT `shop_ID` FROM {$profile_table} WHERE `ID`={$user_ID}"
);


get_header();
?>


<h2>My Products</h2>
<style>
.edit-shop-product {
  padding: 15px;
  border: 1px solid rgba(0, 0, 0, 0.2);
  margin-top: 15px;
}
</style>
<?php
  $shop_products = $wpdb->get_results(
    "SELECT * FROM {$shop_products_table}
    WHERE `shop_ID`={$shop_ID}",
    ARRAY_A
  );

  foreach($shop_products as $product):
?>
  <div class="edit-shop-product">
    <div>
      <?php echo $product["name"]; ?>
    </div>
    <div>
      <?php echo $product["description"]; ?>
    </div>
  </div>
<?php endforeach; ?>