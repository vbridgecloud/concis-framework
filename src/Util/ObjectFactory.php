<?php

namespace Concis\Util;

/**
 * Simple factory to generate objects from a JSON string
 */
class ObjectFactory
{
	public static function fromString(string $data, string $className)
	{
		return self::fromArray(Json::decode($data, true), $className);
	}

	public static function fromArray(array $data, string $className)
	{
		$instance = new $className();

		// Some params will need mapping. For example a string that needs to be converted to a \DateTime
		// Each target class can defined such a map, exposed through its static getObjectFactoryMap function
		$objectMap = [];
		if (\method_exists($instance, 'getObjectFactoryMap')) {
			$objectMap = $instance::getObjectFactoryMap();
		}

		// Set all values, using a mapper function if defined
		foreach ($data as $key => $value) {
			if (isset($objectMap[$key])) {
				$instance->$key = $objectMap[$key]($value, $data);
			} else {
				$instance->$key = $value;
			}
		}

		return $instance;
	}
}
