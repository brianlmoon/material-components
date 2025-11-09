<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Button;
use Moonspot\MaterialComponents\Icon;
use PHPUnit\Framework\TestCase;

class ButtonTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsBuildsButtonClasses(): void {
        $button = new Button(
            [
                'text'     => 'Save',
                'color'    => 'red',
                'flat'     => true,
                'size'     => 'large',
                'floating' => true,
            ],
            [
                'class' => 'custom-class',
            ]
        );

        $button->setDefaults();

        $this->assertStringContainsString('btn waves-effect waves-light red', $button->class);
        $this->assertStringContainsString('btn-flat', $button->class);
        $this->assertStringContainsString('btn-large', $button->class);
        $this->assertStringContainsString('btn-floating', $button->class);
        $this->assertStringContainsString('custom-class', $button->class);
    }

    public function testMarkupMatchesFixture(): void {
        $icon = new Icon(
            [
                'name' => 'send',
                'side' => 'left',
            ],
            [
                'id' => 'send-icon',
            ]
        );
        $icon->setDefaults();

        $button = new Button(
            [
                'text'  => 'Send Message',
                'color' => 'blue',
                'icon'  => $icon,
                'size'  => 'large',
            ],
            [
                'id'    => 'send-button',
                'type'  => 'submit',
                'class' => 'extra-class',
            ]
        );

        $button->setDefaults();

        ob_start();
        $button->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('button_icon_submit.html'), $markup);
    }
}
