<?php

namespace KBNT\Framework\Abstracts;

abstract class Data {

	/**
	 * Return only allowed values and trigger a warning if doesnt
	 * @param mixed $used
	 * @param array $allowed
	 * @return mixed
	 */
	protected function allowedValue($used, array $allowed) {

        if( \is_string($used)) {
            $used = trim($used);
        }

		// Trigger a warning, if something unsupported passed.
        if (!\in_array($used, $allowed, true)) {
            trigger_error('Unsupported value: ' . $used . '. Check it out.', E_USER_WARNING);
            return;
        }

		// Return only allowed values.
		return $used;
	}

	/**
	 * Return only allowed values form an array and trigger a warning if doesnt
	 * @param array $used
	 * @param array $allowed
	 * @return mixed
	 */
	protected function arrayOnlyAllowedValues(array $used, array $allowed) {

		// Trigger a warning, if something unsupported passed.
		$unsupported_values = \array_diff($used,$allowed);
		if (!empty($unsupported_values)) {
			trigger_error('Unsupported values in the array: ' . implode(', ', $unsupported_values) . '. Check them out.', E_USER_WARNING);
		}

		// Return only allowed values.
		return \array_intersect($allowed, $used);
	}

}
