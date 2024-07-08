<div class="wrap">
    <h1><?php esc_html_e('Change your text whatever you want', 'frequently-bought-together'); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('fbt_settings_group');
        do_settings_sections('frequently-bought-together');
        submit_button();
        ?>
    </form>
</div>