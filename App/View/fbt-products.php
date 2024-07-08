<?php
defined("ABSPATH") or die();
global $product;
$fbt_products = get_post_meta($product->get_id(), '_fbt_products', true);
if (!empty($fbt_products)) {
    ?>
    <html lang="eng">
    <head>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <title></title>
    </head>
    <body>
    <div class="fbt-products">
        <div class="notification"></div>
        <h2 class="fbt-title"><b><?php echo esc_html__(get_option('fbt_title_text'),'frequently-bought-together'); ?></b></h2>
        <form id="fbt-form">
            <div class="Products">
                <?php
                foreach ($fbt_products as $fbt_product_id) {
                    $fbt_product = wc_get_product($fbt_product_id);
                    ?>
                    <div class="fbt-product">
                        <a href="<?php echo get_permalink($fbt_product_id); ?>" class='fbt-product-img'><?php echo $fbt_product->get_image(); ?></a>
                        <div class="fbt-content">
                            <input type="checkbox" name="fbt_product_ids[]" value="<?php echo $fbt_product_id; ?>" checked class="check">
                            <a href="<?php echo get_permalink($fbt_product_id); ?>"><?php echo $fbt_product->get_name(); ?></a>
                            <span class="price"><?php echo $fbt_product->get_price_html(); ?></span>
                        </div><br>
                    </div>
                    <?php
                     }
                    ?>
                    </div>
                    <button id="fbt-add-all-to-cart">  <?php echo esc_html__(get_option('fbt_button_text'),'frequently-bought-together');  ?></button>
        </form>
        <div id="fbt-passage"><?php echo esc_html__(get_option('fbt_passage_text'),'frequently-bought-together')  ?></div>
    </div>
    </body>
    </html>
    <?php
}
?>
