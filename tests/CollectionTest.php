<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsAddsCollectionClasses(): void {
        $collection = new Collection(
            [
                'items' => [
                    ['label' => 'First'],
                    ['label' => 'Second'],
                ],
            ],
            [
                'id'    => 'menu',
                'class' => 'custom-class',
                'role'  => '',
            ]
        );

        $collection->setDefaults();

        $this->assertSame('list', $collection->role);
        $this->assertStringContainsString('collection', $collection->class);
        $this->assertStringContainsString('custom-class', $collection->class);
    }

    public function testMarkupMatchesFixture(): void {
        $collection = new Collection(
            [
                'items' => [
                    [
                        'label'  => 'Collections',
                        'header' => true,
                    ],
                    [
                        'label'       => 'Inbox',
                        'href'        => '/inbox',
                        'badge'       => '4',
                        'badge_class' => 'new',
                    ],
                    [
                        'label'          => 'Reports',
                        'href'           => '/reports',
                        'body'           => "Q1 summary\nUpdated weekly",
                        'secondary_icon' => 'send',
                        'secondary_href' => '/reports/share',
                    ],
                    [
                        'divider' => true,
                    ],
                    [
                        'label'          => 'Teal Avatars',
                        'avatar'         => 'https://example.com/avatar.jpg',
                        'avatar_alt'     => 'Avatar',
                        'body'           => 'Tap to view profile',
                        'secondary'      => 'View',
                        'secondary_href' => '/profile',
                    ],
                ],
            ],
            [
                'id'    => 'dashboard-collection',
                'class' => 'z-depth-1',
            ]
        );

        $collection->setDefaults();

        ob_start();
        $collection->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('collection_full.html'), $markup);
    }
}
