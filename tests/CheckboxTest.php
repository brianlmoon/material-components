<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Checkbox;
use PHPUnit\Framework\TestCase;

class CheckboxTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsEnsuresNameAndType(): void {
        $checkbox = new Checkbox(['label' => 'Agree to terms'], ['id' => 'terms-checkbox']);

        $checkbox->setDefaults();

        $this->assertSame('terms-checkbox', $checkbox->name);
        $this->assertSame('checkbox', $checkbox->type);
    }

    public function testMarkupOutputsFilledInCheckboxWithHelperText(): void {
        $checkbox = new Checkbox(
            [
                'label'       => 'Subscribe',
                'helper_text' => 'Get email updates',
                'filled_in'   => true,
            ],
            [
                'id'      => 'subscribe-checkbox',
                'name'    => 'subscribe',
                'checked' => true,
            ]
        );

        $checkbox->setDefaults();

        ob_start();
        $checkbox->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('checkbox_filled_helper.html'), $markup);
    }
}
