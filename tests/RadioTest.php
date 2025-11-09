<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Radio;
use PHPUnit\Framework\TestCase;

class RadioTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsEnsuresNameAndType(): void {
        $radio = new Radio(
            [
                'options' => [
                    [
                        'label' => 'Yes',
                        'value' => 'yes',
                    ],
                ],
            ],
            [
                'id' => 'consent-radio',
            ]
        );

        $radio->setDefaults();

        $this->assertSame('consent-radio', $radio->name);
        $this->assertSame('radio', $radio->type);
    }

    public function testMarkupOutputsMultipleRadiosWithGroupHelperText(): void {
        $radio = new Radio(
            [
                'label'         => 'Choose a plan',
                'helper_text'   => 'Pick the option that fits best.',
                'wrapper_class' => 'plan-wrapper',
                'options'       => [
                    [
                        'label'       => 'Basic',
                        'value'       => 'basic',
                        'helper_text' => 'Essential features',
                    ],
                    [
                        'label' => 'Premium',
                        'value' => 'premium',
                    ],
                    [
                        'label'    => 'Enterprise',
                        'value'    => 'enterprise',
                        'disabled' => true,
                    ],
                ],
            ],
            [
                'id'       => 'plan-radio',
                'name'     => 'plan',
                'value'    => 'premium',
                'required' => true,
                'class'    => 'with-gap',
            ]
        );

        $radio->setDefaults();

        ob_start();
        $radio->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('radio_plan_group.html'), $markup);
    }
}
