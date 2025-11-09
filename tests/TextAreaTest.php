<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\TextArea;
use PHPUnit\Framework\TestCase;

class TextAreaTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsAddsMaterializeClassAndName(): void {
        $text_area = new TextArea(
            [],
            [
                'id' => 'summary',
            ]
        );

        $text_area->setDefaults();

        $this->assertStringContainsString('materialize-textarea', $text_area->class);
        $this->assertSame('summary', $text_area->name);
    }

    public function testMarkupMatchesFixture(): void {
        $text_area = new TextArea(
            [
                'label'         => 'Description',
                'helper_text'   => 'Share additional information.',
                'wrapper_class' => 'description-field',
                'value'         => "Line one\nLine two",
            ],
            [
                'id'          => 'description',
                'name'        => 'details',
                'maxlength'   => 200,
                'placeholder' => 'Start typing',
            ]
        );

        $text_area->setDefaults();

        ob_start();
        $text_area->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('textarea_description_helper.html'), $markup);
    }
}
