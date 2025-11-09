<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Tabs;
use PHPUnit\Framework\TestCase;

class TabsTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsEnsuresRoleAndTabsClass(): void {
        $tabs = new Tabs(
            [
                'items' => [
                    ['label' => 'Tab One', 'href' => '#tab-1'],
                    ['label' => 'Tab Two', 'href' => '#tab-2'],
                ],
            ],
            [
                'id'    => 'primary-tabs',
                'class' => 'custom-wrapper',
                'role'  => '',
            ]
        );

        $tabs->setDefaults();

        ob_start();
        $tabs->markup();
        $markup = ob_get_clean();

        $this->assertStringContainsString('role="navigation"', $markup);
        $this->assertStringContainsString('class="tabs"', $markup);
        $this->assertStringContainsString('custom-wrapper', $markup);
    }

    public function testMarkupMatchesFixture(): void {
        $tabs = new Tabs(
            [
                'tabs_class'      => 'tabs teal lighten-4',
                'tab_item_class'  => 'col s3',
                'items'           => [
                    [
                        'label'        => 'Overview',
                        'href'         => '#overview',
                        'icon'         => 'insert_chart',
                        'icon_position'=> 'left',
                        'active'       => true,
                    ],
                    [
                        'label' => 'Usage',
                        'href'  => '#usage',
                    ],
                    [
                        'label'    => 'API',
                        'href'     => '#api',
                        'disabled' => true,
                    ],
                ],
                'content_sections' => [
                    [
                        'id'      => 'overview',
                        'content' => 'Overview content',
                    ],
                    [
                        'id'      => 'usage',
                        'content' => 'Usage details',
                    ],
                    [
                        'id'      => 'api',
                        'content' => 'API docs',
                    ],
                ],
            ],
            [
                'id'    => 'docs-tabs',
                'class' => 'tabs-wrapper',
            ]
        );

        $tabs->setDefaults();

        ob_start();
        $tabs->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('tabs_full.html'), $markup);
    }
}
