<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Navbar;
use PHPUnit\Framework\TestCase;

class NavbarTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsProvideRoleAndSidenavFallback(): void {
        $navbar = new Navbar(
            [
                'brand_text' => 'Site',
                'color_class' => 'blue lighten-1',
                'menu_items' => [
                    [
                        'label' => 'Home',
                        'href'  => '/',
                        'active'=> true,
                    ],
                ],
            ],
            [
                'id'    => 'primary-nav',
                'class' => 'custom-nav',
                'role'  => '',
            ]
        );

        $navbar->setDefaults();

        ob_start();
        $navbar->markup();
        $markup = ob_get_clean();

        $this->assertStringContainsString('role="navigation"', $markup);
        $this->assertStringContainsString('class="custom-nav blue lighten-1"', $markup);
        $this->assertStringContainsString('data-target="primary-nav-sidenav"', $markup);
        $this->assertStringContainsString('id="primary-nav-sidenav"', $markup);
        $this->assertStringContainsString('<a href="/" class="active">Home</a>', $markup);
    }

    public function testMarkupMatchesFixture(): void {
        $navbar = new Navbar(
            [
                'brand_text'          => 'Material Docs',
                'brand_href'          => '/',
                'color_class'         => 'teal',
                'wrapper_class'       => 'nav-wrapper container',
                'fixed'               => true,
                'menu_alignment'      => 'right hide-on-med-and-down',
                'menu_items'          => [
                    [
                        'label' => 'Components',
                        'href'  => '/components',
                        'active'=> true,
                    ],
                    [
                        'label' => 'CSS',
                        'href'  => '/css',
                    ],
                    [
                        'label' => 'JavaScript',
                        'href'  => '/javascript',
                    ],
                ],
                'mobile_items'        => [
                    [
                        'label' => 'Components',
                        'href'  => '/components',
                    ],
                    [
                        'label' => 'CSS',
                        'href'  => '/css',
                    ],
                    'Support',
                ],
                'mobile_trigger_icon' => 'menu',
            ],
            [
                'id'    => 'docs-navbar',
                'class' => 'shadowless',
            ]
        );

        $navbar->setDefaults();

        ob_start();
        $navbar->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('navbar_full.html'), $markup);
    }
}
