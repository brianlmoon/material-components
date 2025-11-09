<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Badge;
use PHPUnit\Framework\TestCase;

class BadgeTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsAppliesBadgeClasses(): void {
        $badge = new Badge(
            [
                'text'        => '4',
                'color_class' => 'blue',
                'is_new'      => true,
                'pulse'       => true,
                'align_right' => true,
            ],
            [
                'class' => 'custom-badge',
            ]
        );

        $badge->setDefaults();

        $this->assertStringContainsString('badge', $badge->class);
        $this->assertStringContainsString('blue', $badge->class);
        $this->assertStringContainsString('new', $badge->class);
        $this->assertStringContainsString('pulse', $badge->class);
        $this->assertStringContainsString('right', $badge->class);
        $this->assertStringContainsString('custom-badge', $badge->class);
    }

    public function testMarkupMatchesFixture(): void {
        $badge = new Badge(
            [
                'text'        => '8',
                'color_class' => 'red',
                'caption'     => 'notifications',
                'pulse'       => true,
            ],
            [
                'id'    => 'notification-badge',
                'class' => 'extra-class',
                'data'  => [
                    'test' => 'value',
                ],
            ]
        );

        $badge->setDefaults();

        ob_start();
        $badge->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('badge_notifications.html'), $markup);
    }
}
