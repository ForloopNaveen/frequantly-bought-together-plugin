<?php
defined("ABSPATH") or die();
global $product;
$fbt_products = get_post_meta($product->get_id(), '_fbt_products', true);
if (!empty($fbt_products)) {
    ?>
    <html>
    <head>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
    <div class="fbt-products">
        <div class="notification"></div>
        <h2 class="fbt-title"><?php echo esc_html__('Frequently Bought Together','frequently-bought-together') ?></h2>
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
<!--                            --><?php //if(!empty($value = apply_filters('change_product_description', '', $fbt_product))) { ?>
<!--                                <p>--><?php //= $value ?><!--</p>-->
<!--                            --><?php //} ?>
                        </div>

                    </div>

                    <?php
                }
                ?>
            </div>
            <button type="button" id="fbt-add-all-to-cart" class="button"><?php echo apply_filters('fbt_change_button_name', __('Add all to cart','frequently-bought-together')) ?></button>
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>
