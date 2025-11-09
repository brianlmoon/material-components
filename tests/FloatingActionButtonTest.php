<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\FloatingActionButton;
use PHPUnit\Framework\TestCase;

class FloatingActionButtonTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsAddsWrapperClasses(): void {
        $fab = new FloatingActionButton(
            [
                'horizontal' => true,
            ],
            [
                'id'    => 'fab',
                'class' => 'custom-wrapper',
            ]
        );

        $fab->setDefaults();

        $this->assertStringContainsString('fixed-action-btn', $fab->class);
        $this->assertStringContainsString('horizontal', $fab->class);
        $this->assertStringContainsString('custom-wrapper', $fab->class);
    }

    public function testMarkupMatchesFixture(): void {
        $fab = new FloatingActionButton(
            [
                'button_color_class' => 'red',
                'button_size'        => 'btn-large',
                'button_icon'        => 'mode_edit',
                'button_icon_class'  => 'large material-icons',
                'button_href'        => '#compose',
                'button_data'        => [
                    'tooltip' => 'Create',
                ],
                'actions' => [
                    [
                        'href'        => '#insert-chart',
                        'color_class' => 'red',
                        'icon'        => 'insert_chart',
                    ],
                    [
                        'href'        => '#format-quote',
                        'color_class' => 'yellow darken-1',
                        'icon'        => 'format_quote',
                    ],
                    [
                        'href'        => '#publish',
                        'color_class' => 'green',
                        'icon'        => 'publish',
                        'tooltip'     => 'Publish',
                        'tooltip_position' => 'left',
                    ],
                    [
                        'href'        => '#attach-file',
                        'color_class' => 'blue',
                        'icon'        => 'attach_file',
                        'target'      => '_blank',
                    ],
                ],
            ],
            [
                'id'          => 'fab-compose',
                'class'       => 'fixed',
                'aria_label'  => 'Compose actions',
            ]
        );

        $fab->setDefaults();

        ob_start();
        $fab->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('floating_action_button_full.html'), $markup);
    }
}
