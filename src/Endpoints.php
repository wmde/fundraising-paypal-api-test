<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

class Endpoints {

	public const AUTH = 'https://api-m.sandbox.paypal.com/v1/oauth2/token';
	public const ORDERS = 'https://api-m.sandbox.paypal.com/v2/checkout/orders';
	public const PLANS = 'https://api-m.sandbox.paypal.com/v1/billing/plans';
	public const PRODUCTS = 'https://api-m.sandbox.paypal.com/v1/catalogs/products';
	public const SUBSCRIPTIONS = 'https://api-m.sandbox.paypal.com/v1/billing/subscriptions';
}
