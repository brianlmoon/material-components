<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Breadcrumb;
use PHPUnit\Framework\TestCase;

class BreadcrumbTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsEnsuresRole(): void {
        $breadcrumb = new Breadcrumb(
            [
                'items' => [
                    ['label' => 'Home', 'href' => '/'],
                ],
            ],
            [
                'id'   => 'crumbs',
                'role' => '',
            ]
        );

        $breadcrumb->setDefaults();

        ob_start();
        $breadcrumb->markup();
        $markup = ob_get_clean();

        $this->assertStringContainsString('role="navigation"', $markup);
        $this->assertStringContainsString('class="breadcrumb "', $markup);
        $this->assertStringContainsString('href="/"', $markup);
    }

    public function testMarkupMatchesFixture(): void {
        $breadcrumb = new Breadcrumb(
            [
                'wrapper_class'   => 'nav-wrapper teal lighten-1',
                'container_class' => 'col s12 breadcrumbs',
                'items'           => [
                    ['label' => 'Home', 'href' => '/'],
                    ['label' => 'Docs', 'href' => '/docs'],
                    ['label' => 'Components', 'href' => '/docs/components', 'current' => true],
                ],
            ],
            [
                'id'    => 'docs-breadcrumbs',
                'class' => 'shadowless',
            ]
        );

        $breadcrumb->setDefaults();

        ob_start();
        $breadcrumb->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('breadcrumb_full.html'), $markup);
    }
}
