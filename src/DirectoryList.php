<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

class DirectoryList {

	private string $directoryPath;

	public function __construct( string $directoryPath ) {
		$this->directoryPath = $directoryPath;
	}

	public function getFiles(): array {
		$fileList = [];

		if ( $handle = opendir( $this->directoryPath ) ) {
			while ( false !== ( $file = readdir( $handle ) ) ) {
				if ( !str_contains( $file, 'json' ) ) {
					continue;
				}

				$fileList[] = $file;
			}
			closedir( $handle );
		}

		return $fileList;
	}

}
