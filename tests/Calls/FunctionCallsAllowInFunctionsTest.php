<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Rules\Disallowed\Calls;

use PHPStan\File\FileHelper as PHPStanFileHelper;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Spaze\PHPStan\Rules\Disallowed\DisallowedCallFactory;
use Spaze\PHPStan\Rules\Disallowed\DisallowedHelper;
use Spaze\PHPStan\Rules\Disallowed\FileHelper;

class FunctionCallsAllowInFunctionsTest extends RuleTestCase
{

	protected function getRule(): Rule
	{
		return new FunctionCalls(
			new DisallowedHelper(new FileHelper(new PHPStanFileHelper(__DIR__))),
			new DisallowedCallFactory(),
			[
				[
					'function' => 'md*()',
					'allowInFunctions' => [
						'\\Foo\\Bar\\Waldo\\qu*x()',
					],
				],
			]
		);
	}


	public function testRule(): void
	{
		// Based on the configuration above, no errors in this file:
		$this->analyse([__DIR__ . '/../libs/Functions.php'], []);
	}

}
