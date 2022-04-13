<?php

declare( strict_types = 1 );

use WMDE\ApiTestKit\ApiFactory;

/**
 * @var ApiFactory $factory
 */
$factory = include_once __DIR__ . '/../src/bootstrap.php';
$logger = $factory->newWebhookLogger();

$data = $logger->getLog( $_GET['id'] );

?>

<html lang="en">
<head>
	<title>PayPal API Test</title>
</head>
<body>

<?php if ( $data ): ?>

	<pre>
		<?php print_r( $data ); ?>
	</pre>

<?php else: ?>

	<p>No Webhook has been logged yet, try reloading.</p>

<?php endif; ?>

</body>
</html>
