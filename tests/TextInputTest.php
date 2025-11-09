<?php

namespace Moonspot\MaterialComponents\Test;

use DealNews\TestHelpers\Fixtures;
use Moonspot\MaterialComponents\TextInput;
use PHPUnit\Framework\TestCase;

class TextInputTest extends TestCase {

    use Fixtures;

    public function testSetDefaultsUsesIdForName(): void {
        $input = new TextInput(
            [],
            [
                'id' => 'username',
            ]
        );

        $input->setDefaults();

        $this->assertSame('username', $input->name);
    }

    public function testMarkupMatchesFixture(): void {
        $input = new TextInput(
            [
                'label'         => 'Email',
                'helper_text'   => 'We never share your email.',
                'wrapper_class' => 'email-field',
            ],
            [
                'id'          => 'email',
                'name'        => 'email',
                'type'        => 'email',
                'value'       => 'user@example.com',
                'required'    => true,
                'placeholder' => 'name@example.com',
            ]
        );

        $input->setDefaults();

        ob_start();
        $input->markup();
        $markup = ob_get_clean();

        $this->assertSame(self::getFixtureData('textinput_email_helper.html'), $markup);
    }
}
