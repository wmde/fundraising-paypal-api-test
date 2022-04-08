<?php

namespace WMDE\ApiTestKit;

interface TokenCache {

	public function getToken(): ?string;
	public function storeToken( string $token, int $expiry ): void;
}