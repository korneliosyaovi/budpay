<?php
/**
 * Base For Budpay Endpoint.
 *
 * @package    Budpay/WooCommerce/RestApi
 */

/**
 * Budpay Base Endpoint Class.
 */
abstract class Budpay_Base_Rest_Controller extends WP_REST_Controller {
	/**
	 * Endpoint namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'budpay-base/v1';

	/**
	 * Base Route Constructor.
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'create_rest_routes' ) );
	}

	/**
	 * Route Method.
	 */
	public function create_rest_routes() {

		register_rest_route(
			$this->namespace,
			'/hello',
			array(

				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'friendly_response' ),
				'permission_callback' => array( $this, 'get_permission' ),

			)
		);
	}


	/**
	 * Get Current Users Permission.
	 */
	public function get_permission() {
		return current_user_can( 'manage_options' );
	}

	/**
	 * Reply to the request.
	 */
	public function friendly_response(): WP_REST_Response {
		$reply = array(
			'message' => 'Hello from Budpay WooCommerce',
			'version' => BUDPAY_VERSION,
		);

		return new WP_REST_Response( $reply, WP_Http::OK );
	}
}
