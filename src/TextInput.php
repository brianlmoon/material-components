<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize single-line text input component.
 */
class TextInput extends ComponentAbstract {

    // attributes
    /**
     * Input name attribute (defaults to id).
     */
    public string $name = '';

    /**
     * Input type attribute (default `text`).
     */
    public string $type = 'text';

    /**
     * Default input value.
     */
    public string $value = '';

    /**
     * Disables the field when true.
     */
    public bool $disabled = false;

    /**
     * Applies `readonly`.
     */
    public bool $readonly = false;

    /**
     * Marks the field as required.
     */
    public bool $required = false;

    /**
     * Minimum length of the input value.
     *
     * @var int|null
     */
    public int|null $minlength = null;

    /**
     * Maximum length of the input value.
     *
     * @var int|null
     */
    public int|null $maxlength = null;

    /**
     * Minimum numeric value constraint.
     *
     * @var int|null
     */
    public int|null $min = null;

    /**
     * Maximum numeric value constraint.
     *
     * @var int|null
     */
    public int|null $max = null;

    /**
     * Regex pattern applied to the input.
     */
    public string $pattern = '';

    /**
     * Placeholder text shown when empty.
     */
    public string $placeholder = '';

    // settings
    /**
     * Floating label text.
     */
    protected string $label = '';

    /**
     * Wrapper class applied to `.input-field`.
     */
    protected string $wrapper_class = '';

    /**
     * Helper text rendered below the input.
     */
    protected string $helper_text = '';

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if (empty($this->name)) {
            $this->name = $this->id;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        ?>
        <div class="input-field <?=htmlspecialchars($this->wrapper_class)?>">
          <input <?=$this->attributes()?> />
          <label class="active" for="<?=htmlspecialchars($this->id)?>"><?=htmlspecialchars($this->label)?></label>
          <?php if ($this->helper_text) { ?>
              <span class="helper-text"><?=htmlspecialchars($this->helper_text)?></span>
          <?php } ?>
        </div>
        <?php
    }
}
