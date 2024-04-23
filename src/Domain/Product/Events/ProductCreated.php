<?php

namespace Domain\Product\Events;

use Domain\Product\Models\Product;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ProductCreated
{
	use Dispatchable,
		InteractsWithSockets,
		SerializesModels;
	
	public function __construct(private readonly Product $product) {}
	
	public function broadcastOn(): array
	{
		return [
			new PrivateChannel('channel-name'),
		];
	}
}
