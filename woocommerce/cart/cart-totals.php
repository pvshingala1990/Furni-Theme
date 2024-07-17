<?php

/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

?>
<div class="col-md-7 cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

	<?php do_action('woocommerce_before_cart_totals'); ?>
	<div class="row">
		<div class="col-md-12 text-right border-bottom mb-5">
			<h3 class="text-black h4 text-uppercase"><?php esc_html_e('Cart totals', 'woocommerce'); ?></h3>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-6">
			<span class="text-black"><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
		</div>
		<div class="col-md-6 text-right" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
			<strong class="text-black"><?php wc_cart_totals_subtotal_html(); ?></strong>
		</div>
	</div>

	<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
		<div class="row mb-3 coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
			<div class="col-md-6">
				<span class="text-black"><?php wc_cart_totals_coupon_label($coupon); ?></span>
			</div>
			<div class="col-md-6 text-right" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>">
				<strong class="text-black"><?php wc_cart_totals_coupon_html($coupon); ?></strong>
			</div>
		</div>
	<?php endforeach; ?>

	<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

		<?php do_action('woocommerce_cart_totals_before_shipping'); ?>

		<?php wc_cart_totals_shipping_html(); ?>

		<?php do_action('woocommerce_cart_totals_after_shipping'); ?>

	<?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>
		<div class="row mb-3">
			<div class="col-md-6">
				<span class="text-black"><?php esc_html_e('Shipping', 'woocommerce'); ?></span>
			</div>
			<div class="col-md-6 text-right" data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>">
				<strong class="text-black"><?php woocommerce_shipping_calculator(); ?></strong>
			</div>
		</div>

	<?php endif; ?>

	<?php foreach (WC()->cart->get_fees() as $fee) : ?>
		<div class="row mb-6">
			<div class="col-md-6"><span class="text-black"><?php echo esc_html($fee->name); ?></span></div>
			<div class="col-md-6 text-right" data-title="<?php echo esc_attr($fee->name); ?>"><strong class="text-black"><?php wc_cart_totals_fee_html($fee); ?></strong></div>
		</div>
	<?php endforeach; ?>

	<?php
	if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
		$taxable_address = WC()->customer->get_taxable_address();
		$estimated_text  = '';

		if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
			/* translators: %s location. */
			$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
		}

		if ('itemized' === get_option('woocommerce_tax_total_display')) {
			foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	?>
				<div class="row mb-6 tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
					<div class="col-md-6">
						<span class="text-black"><?php echo esc_html($tax->label) . $estimated_text; ?></span>
					</div>
					<div class="col-md-6 text-right" data-title="<?php echo esc_attr($tax->label); ?>"><strong class="text-black"><?php echo wp_kses_post($tax->formatted_amount); ?></strong></div>
				</div>
			<?php
			}
		} else {
			?>
			<div class="row mb-6">
				<div class="col-md-6">
					<span class="text-black"><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; ?></span>
				</div>
				<div class="col-md-6 text-right" data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><strong class="text-black"><?php wc_cart_totals_taxes_total_html(); ?></strong></div>
			</div>
	<?php
		}
	}
	?>

	<?php do_action('woocommerce_cart_totals_before_order_total'); ?>

	<div class="row mb-5 order-total">
		<div class="col-md-6">
			<span class="text-black"><?php esc_html_e('Total', 'woocommerce'); ?></span>
		</div>
		<div class="col-md-6 text-right" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>"><strong class="text-black"><?php wc_cart_totals_order_total_html(); ?></strong></div>
	</div>

	<?php do_action('woocommerce_cart_totals_after_order_total'); ?>

	<div class="wc-proceed-to-checkout">
		<?php do_action('woocommerce_proceed_to_checkout'); ?>
	</div>

	<?php do_action('woocommerce_after_cart_totals'); ?>

</div>