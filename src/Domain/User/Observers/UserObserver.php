<?php

namespace Domain\User\Observers;

use Domain\User\Models\User;

class UserObserver
{
	public function creating(User $user): void
	{
		$user->created_by = auth()->id();
    }
	
	public function updating(User $user): void
	{
		$user->updated_by = auth()->id();
	}
}
