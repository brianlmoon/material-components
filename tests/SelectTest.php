<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Select;
use PHPUnit\Framework\TestCase;

class SelectTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsUsesIdAsName(): void {
        $select = new Select(
            [
                'options' => [
                    [
                        'value' => 'basic',
                        'text'  => 'Basic',
                    ],
                ],
            ],
            [
                'id' => 'plan-selector',
            ]
        );

        $select->setDefaults();

        $this->assertSame('plan-selector', $select->name);
    }

    public function testMarkupMatchesFixture(): void {
        $select = new Select(
            [
                'label'         => 'Choose plan',
                'helper_text'   => 'Select the tier that fits.',
                'wrapper_class' => 'plan-field',
                'options'       => [
                    [
                        'value' => 'basic',
                        'text'  => 'Basic',
                    ],
                    [
                        'value' => 'pro',
                        'text'  => 'Pro',
                    ],
                    [
                        'value' => 'enterprise',
                        'text'  => 'Enterprise',
                    ],
                ],
                'value'         => 'pro',
            ],
            [
                'id'       => 'plan-select',
                'name'     => 'plan',
                'required' => true,
            ]
        );

        $select->setDefaults();

        ob_start();
        $select->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('select_plan_helper.html'), $markup);
    }
}
