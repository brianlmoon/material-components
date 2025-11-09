<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Card;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsAddsCardClass(): void {
        $card = new Card(
            [
                'background_color' => 'blue-grey lighten-5',
                'actions'          => [
                    [
                        'href' => '#details',
                        'text' => 'Details',
                    ],
                ],
            ],
            [
                'class' => 'custom-card',
            ]
        );

        $card->setDefaults();

        $this->assertStringContainsString('card', $card->class);
        $this->assertStringContainsString('blue-grey lighten-5', $card->class);
        $this->assertStringContainsString('custom-card', $card->class);
    }

    public function testMarkupMatchesFixture(): void {
        $card = new Card(
            [
                'title'            => 'Starter Kit',
                'color'            => 'teal',
                'background_color' => 'grey lighten-4',
                'image'            => 'https://example.org/kit.jpg',
                'content'          => 'Build interfaces faster.',
                'actions'          => [
                    [
                        'href' => '#learn',
                        'text' => 'Learn More',
                    ],
                    [
                        'href' => '#buy',
                        'text' => 'Buy Now',
                    ],
                ],
            ],
            [
                'id'    => 'starter-card',
                'class' => 'z-depth-2',
            ]
        );

        $card->setDefaults();

        ob_start();
        $card->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('card_with_image_actions.html'), $markup);
    }
}
