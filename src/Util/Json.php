<?php

namespace Concis\Util;

class Json
{
	public static function decode(string $string, bool $assoc = false, int $depth = 512, int $options = 0)
	{
		$json = @json_decode($string, $assoc, $depth, $options);
		if (json_last_error() !== JSON_ERROR_NONE) {
			throw new \RuntimeException('Could not parse request body: ' . json_last_error_msg());
		}

		return $json;
	}
}
