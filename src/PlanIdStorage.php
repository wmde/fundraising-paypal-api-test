<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

interface PlanIdStorage {

	public function getPlanIds(): array;

	public function savePlanIds( array $planIds ): void;
}