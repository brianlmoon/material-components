<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Footer;
use PHPUnit\Framework\TestCase;

class FooterTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsAppliesPageFooterClassAndRole(): void {
        $footer = new Footer(
            [
                'sections' => [
                    [
                        'title'   => 'Footer Content',
                        'content' => 'Build anything.',
                    ],
                ],
            ],
            [
                'id'    => 'site-footer',
                'class' => 'custom-footer',
                'role'  => '',
            ]
        );

        $footer->setDefaults();

        $this->assertStringContainsString('page-footer', $footer->class);
        $this->assertStringContainsString('custom-footer', $footer->class);
        $this->assertSame('contentinfo', $footer->role);
    }

    public function testMarkupMatchesFixture(): void {
        $footer = new Footer(
            [
                'container_class'   => 'container',
                'section_row_class' => 'row',
                'sections'          => [
                    [
                        'title'         => 'Footer Content',
                        'title_class'   => 'white-text',
                        'content'       => 'Build responsive pages faster.',
                        'content_class' => 'grey-text text-lighten-4',
                        'column_class'  => 'col l6 s12',
                    ],
                    [
                        'title'        => 'Resources',
                        'title_class'  => 'white-text',
                        'column_class' => 'col l4 offset-l2 s12',
                        'links'        => [
                            [
                                'label' => 'Docs',
                                'href'  => '/docs',
                                'class' => 'grey-text text-lighten-3',
                            ],
                            [
                                'label' => 'Blog',
                                'href'  => '/blog',
                                'class' => 'grey-text text-lighten-3',
                            ],
                            'Support',
                        ],
                    ],
                ],
                'copyright'   => '© 2024 Moonspot',
                'right_links' => [
                    [
                        'label' => 'More Links',
                        'href'  => '#more',
                        'class' => 'grey-text text-lighten-4 right',
                    ],
                ],
            ],
            [
                'id'    => 'docs-footer',
                'class' => 'grey darken-3',
            ]
        );

        $footer->setDefaults();

        ob_start();
        $footer->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('footer_full.html'), $markup);
    }
}
