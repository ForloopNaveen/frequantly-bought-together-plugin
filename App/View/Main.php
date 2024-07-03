<?php
global $post;
?>

    <div id="fbt_product_data" class="panel woocommerce_options_panel">
    <div class="options_group">
        <p><?php  esc_html_e('Select the products that are frequently bought together with this product:','frequently-bought-together') ?></p>
        <select name="fbt_products[]" multiple="multiple">
            <?php
            $fbt_products = get_post_meta($post->ID, '_fbt_products', true);
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1
            );
            $products = get_posts($args);
            foreach ($products as $product) {
                echo '<option value="' . $product->ID . '" ' . (is_array($fbt_products) && in_array($product->ID, $fbt_products) ? 'selected' : '') . '>' . get_the_title($product->ID) . '</option>';
            }
            ?>
        </select>
    </div>
</div>
