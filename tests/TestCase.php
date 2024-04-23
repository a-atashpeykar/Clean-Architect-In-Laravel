<?php

namespace Tests;

use Domain\User\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

	protected User $loggedInUser;

	protected function setUpLoggedInUser(): void
    {
		$this->loggedInUser = User::factory()->create();

		auth()->login($this->loggedInUser);
	}
}
