<?php

namespace Domain\Tag\Observers;

use Domain\Tag\Models\Tag;

class TagObserver
{
	public function creating(Tag $tag): void
	{
		$tag->created_by = auth()->id();
    }
	
	public function updating(Tag $tag): void
	{
		$tag->updated_by = auth()->id();
	}
}
