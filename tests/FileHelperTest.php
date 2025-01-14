<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Rules\Disallowed;

use Generator;
use PHPStan\File\FileHelper as PHPStanFileHelper;
use PHPUnit\Framework\TestCase;

class FileHelperTest extends TestCase
{

	/** @var FileHelper */
	private $fileHelper;


	protected function setUp(): void
	{
		$this->fileHelper = new FileHelper(new PHPStanFileHelper(__DIR__));
	}


	/**
	 * @param string $input
	 * @param string $output
	 * @dataProvider pathProvider
	 */
	public function testAbsolutizePath(string $input, string $output): void
	{
		$this->assertSame($output, $this->fileHelper->absolutizePath($input));
	}


	public function pathProvider(): Generator
	{
		yield ['src', __DIR__ . '/src'];
		yield ['src/*', __DIR__ . '/src/*'];
		yield ['../src/*', str_replace(basename(__DIR__) . '/../', '', __DIR__ . '/../src/*')];
		yield ['src/foo/../*', __DIR__ . '/src/*'];
		yield ['*/src', '*/src'];
		yield ['*/../src', '*/../src'];
	}

}
