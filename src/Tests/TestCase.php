<?php

namespace KBNT\Framework\Tests;

class TestCase extends \WP_Mock\Tools\TestCase
{
	public function setUp(): void
	{
		\WP_Mock::setUp();
	}

	public function tearDown(): void
	{
		\WP_Mock::tearDown();
	}
}
