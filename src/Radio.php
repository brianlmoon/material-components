<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize radio button component.
 *
 * Renders one or more radio buttons using the Materialize CSS markup while
 * supporting group labels, helper text, and per-option overrides.
 */
class Radio extends ComponentAbstract {

    // attributes
    /**
     * Shared name attribute for the radio group.
     */
    public string $name = '';

    /**
     * Input type (always forced to "radio").
     */
    public string $type = 'radio';

    /**
     * Currently selected value.
     */
    public string $value = '';

    /**
     * Disables all radios in the group when true.
     */
    public bool $disabled = false;

    /**
     * Marks the radio group as required when true.
     */
    public bool $required = false;

    // settings
    /**
     * Optional label rendered above the radio group.
     */
    protected string $label = '';

    /**
     * Optional wrapper class applied to the container element.
     */
    protected string $wrapper_class = '';

    /**
     * Helper text rendered underneath the entire group.
     */
    protected string $helper_text = '';

    /**
     * Radio options definition.
     *
     * Each option may contain:
     *  - label (string, required)
     *  - value (string, defaults to label/content)
     *  - helper_text (string, optional)
     *  - class (string, optional)
     *  - id (string, optional)
     *  - disabled (bool, optional)
     *  - checked (bool, optional)
     *
     * @var array<int|string, array<string, mixed>|string>
     */
    protected array $options = [];

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if (empty($this->name)) {
            $this->name = $this->id;
        }

        $this->type = 'radio';
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        $options = $this->normalizeOptions();

        if (empty($options)) {
            return;
        }
        ?>
        <div class="radio-group <?=htmlspecialchars($this->wrapper_class)?>">
            <?php if ($this->label) { ?>
                <span class="radio-group-label"><?=htmlspecialchars($this->label)?></span>
            <?php } ?>

            <?php foreach ($options as $index => $option) { ?>
                <?php $option_id = $option['id'] ?: $this->id . '-' . ($index + 1); ?>
                <p class="radio-option">
                    <label for="<?=htmlspecialchars($option_id)?>">
                        <input <?=$this->optionAttributes($option, $option_id, $index === 0)?> />
                        <span><?=htmlspecialchars($option['label'])?></span>
                    </label>
                    <?php if (!empty($option['helper_text'])) { ?>
                        <span class="helper-text"><?=htmlspecialchars($option['helper_text'])?></span>
                    <?php } ?>
                </p>
            <?php } ?>

            <?php if ($this->helper_text) { ?>
                <span class="helper-text"><?=htmlspecialchars($this->helper_text)?></span>
            <?php } ?>
        </div>
        <?php
    }

    /**
     * Normalizes the options settings into a consistent structure.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeOptions(): array {
        $normalized = [];

        foreach ($this->options as $key => $option) {
            if (is_array($option)) {
                $label       = (string)($option['label'] ?? ($option['text'] ?? ''));
                $value       = array_key_exists('value', $option) ? (string)$option['value'] : (string)($label !== '' ? $label : $key);
                $helper_text = (string)($option['helper_text'] ?? '');
                $class       = (string)($option['class'] ?? '');
                $id          = (string)($option['id'] ?? '');
                $disabled    = (bool)($option['disabled'] ?? false);
                $checked     = (bool)($option['checked'] ?? false);
            } else {
                $label       = (string)$option;
                $value       = is_string($key) ? (string)$key : $label;
                $helper_text = '';
                $class       = '';
                $id          = '';
                $disabled    = false;
                $checked     = false;
            }

            if ($label === '') {
                continue;
            }

            $normalized[] = [
                'label'       => $label,
                'value'       => $value,
                'helper_text' => $helper_text,
                'class'       => $class,
                'id'          => $id,
                'disabled'    => $disabled,
                'checked'     => $checked,
            ];
        }

        return $normalized;
    }

    /**
     * Builds the attribute string for an individual radio option.
     *
     * @param array<string, mixed> $option
     * @param string               $option_id
     * @param bool                 $is_first_option
     *
     * @return string
     */
    protected function optionAttributes(array $option, string $option_id, bool $is_first_option): string {
        $attributes = [
            'type'  => 'radio',
            'id'    => $option_id,
            'name'  => $this->name,
            'value' => $option['value'],
        ];

        $class_list = trim($this->class . ' ' . $option['class']);
        if ($class_list !== '') {
            $attributes['class'] = $class_list;
        }

        if ($this->disabled || $option['disabled']) {
            $attributes['disabled'] = true;
        }

        if ($is_first_option && $this->required) {
            $attributes['required'] = true;
        }

        $value_matches = (string)$option['value'] === (string)$this->value;
        if ($option['checked'] || $value_matches) {
            $attributes['checked'] = true;
        }

        return $this->stringifyAttributes($attributes);
    }

    /**
     * Converts an attributes array to an HTML string.
     *
     * @param array<string, string|bool> $attributes
     *
     * @return string
     */
    protected function stringifyAttributes(array $attributes): string {
        $markup = '';

        foreach ($attributes as $name => $value) {
            if (is_string($value)) {
                if ($name === 'class') {
                    $value = trim($value);
                    if ($value === '') {
                        continue;
                    }
                }
                $markup .= $this->attribute($name, $value);
                continue;
            }

            if (is_bool($value) && $value) {
                $markup .= $this->attribute($name, true);
            }
        }

        return trim($markup);
    }
}
