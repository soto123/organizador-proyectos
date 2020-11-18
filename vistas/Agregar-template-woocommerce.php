<?php 
//agregar templates de woocommerce por el plugin

/**
 * Filter the cart template path to use our cart.php template instead of the theme's
 */
function csp_locate_template( $template, $template_name, $template_path ) {
 $basename = basename( $template );
 if( $basename == 'variable.php' ) {
 $template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'woocommerce/templates/single-product/add-to-cart/variable.php';
 }
 return $template;
}
add_filter( 'woocommerce_locate_template', 'csp_locate_template', 10, 3 );

 ?>