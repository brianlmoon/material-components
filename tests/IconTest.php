<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Icon;
use PHPUnit\Framework\TestCase;

class IconTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsAppendsMaterialIconClasses(): void {
        $icon = new Icon(
            [
                'name' => 'menu',
                'side' => 'right',
            ],
            [
                'class' => 'custom-icon',
            ]
        );

        $icon->setDefaults();

        $this->assertStringContainsString('material-icons', $icon->class);
        $this->assertStringContainsString('right', $icon->class);
        $this->assertStringContainsString('custom-icon', $icon->class);
    }

    public function testMarkupMatchesFixture(): void {
        $icon = new Icon(
            [
                'name' => 'menu',
                'side' => 'right',
            ],
            [
                'id'    => 'nav-icon',
                'class' => 'blue-text',
            ]
        );

        $icon->setDefaults();

        ob_start();
        $icon->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('icon_menu_right.html'), $markup);
    }
}
