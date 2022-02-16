<?php

namespace KBNT\Framework\Helpers;

class ReflectionPropertyExtractor
{

	/**
	 * Extract private or protected property
	 * @param object $object Object to retrieve property from.
	 * @param string $propertyName Property name.
	 * @return mixed
	 * @throws ReflectionException
	 */
	public function extractProperty($object, $propertyName)
	{
		$r = new \ReflectionObject($object);
		$p = $r->getProperty($propertyName);
		$p->setAccessible(true);

		return $p->getValue($object);
	}
}
