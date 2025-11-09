<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\Pagination;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsEnsuresRoleAndListClass(): void {
        $pagination = new Pagination(
            [
                'items' => [
                    ['label' => '1', 'href' => '/page/1'],
                    ['label' => '2', 'href' => '/page/2'],
                ],
            ],
            [
                'id'    => 'pager',
                'class' => 'custom-container',
                'role'  => '',
            ]
        );

        $pagination->setDefaults();

        ob_start();
        $pagination->markup();
        $markup = ob_get_clean();

        $this->assertStringContainsString('role="navigation"', $markup);
        $this->assertStringContainsString('class="pagination"', $markup);
        $this->assertStringContainsString('custom-container', $markup);
    }

    public function testMarkupMatchesFixture(): void {
        $pagination = new Pagination(
            [
                'aria_label' => 'Pagination navigation',
                'items'      => [
                    [
                        'icon'       => 'chevron_left',
                        'href'       => '/page/1',
                        'aria_label' => 'Previous page',
                        'disabled'   => true,
                    ],
                    [
                        'label'  => '1',
                        'href'   => '/page/1',
                        'active' => true,
                    ],
                    [
                        'label' => '2',
                        'href'  => '/page/2',
                    ],
                    [
                        'label' => '3',
                        'href'  => '/page/3',
                    ],
                    [
                        'label' => '4',
                        'href'  => '/page/4',
                    ],
                    [
                        'label' => '5',
                        'href'  => '/page/5',
                    ],
                    [
                        'icon'       => 'chevron_right',
                        'href'       => '/page/2',
                        'aria_label' => 'Next page',
                    ],
                ],
            ],
            [
                'id'    => 'docs-pagination',
                'class' => 'center-align',
            ]
        );

        $pagination->setDefaults();

        ob_start();
        $pagination->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('pagination_full.html'), $markup);
    }
}
