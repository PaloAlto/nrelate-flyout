<?php
/**
 * nrelate product status
 *
 * Identify all nrelate products that are active
 * 
 * @package nrelate
 * @subpackage Functions
 */

define( 'NRELATE_PRODUCT_STATUS', true );

// Pull the nrelate_products array
$product_status = get_option('nrelate_products');

// Get status of our products
$related_status = isset($product_status["related"]["status"]) ? $product_status["related"]["status"] : null;
$popular_status = isset($product_status["popular"]["status"]) ? $product_status["popular"]["status"] : null;
$flyout_status = isset($product_status["flyout"]["status"]) ? $product_status["flyout"]["status"] : null;
// Set active products to active
if ($related_status == 1) { define( 'NRELATE_RELATED_ACTIVE', true ); }
if ($popular_status == 1) { define( 'NRELATE_POPULAR_ACTIVE', true ); }if ($flyout_status == 1) { define( 'NRELATE_FLYOUT_ACTIVE', true ); }



?>