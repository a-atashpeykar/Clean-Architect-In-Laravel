<?php

namespace Support\Abstracts;

interface DtoInterface
{
	public static function fromArray(array $data): self;
}