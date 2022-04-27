<?php

declare( strict_types = 1 );

use WMDE\ApiTestKit\ApiFactory;

/**
 * @var ApiFactory $factory
 */
$factory = include_once __DIR__ . '/../src/bootstrap.php';
$directoryList = $factory->newIpnDirectoryList();

$data = $directoryList->getFiles();

?>

<html lang="en">
<head>
	<title>PayPal API Test</title>
</head>
<body>

<?php if ( $data ): ?>
	<ul>
		<?php foreach ( $data as $filename ): ?>
			<li><a href="/ipn.php?timestamp=<?= str_replace( '.json', '', $filename ) ?>"><?= $filename ?></a></li>
		<?php endforeach; ?>
	</ul>
<?php else: ?>

	<p>No IPNS have been logged yet, try reloading.</p>

<?php endif; ?>

</body>
</html>