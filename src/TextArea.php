<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize textarea component with floating label and helper text.
 */
class TextArea extends ComponentAbstract {

    // attributes
    /**
     * Textarea name attribute (defaults to id).
     */
    public string $name = '';

    /**
     * Disables the control when true.
     */
    public bool $disabled = false;

    /**
     * Applies the `readonly` attribute.
     */
    public bool $readonly = false;

    /**
     * Minimum number of characters allowed.
     *
     * @var int|null
     */
    public int|null $minlength = null;

    /**
     * Maximum number of characters allowed.
     *
     * @var int|null
     */
    public int|null $maxlength = null;

    /**
     * Placeholder text shown when empty.
     */
    public string $placeholder = '';

    /**
     * Marks the field as required.
     */
    public bool $required = false;

    // settings
    /**
     * Default textarea value.
     */
    protected string $value = '';

    /**
     * Floating label text.
     */
    protected string $label = '';

    /**
     * Wrapper class applied to the `.input-field`.
     */
    protected string $wrapper_class = '';

    /**
     * Helper text rendered beneath the textarea.
     */
    protected string $helper_text = '';

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        $this->class .= ' materialize-textarea';
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
          <textarea <?=$this->attributes()?>><?=htmlspecialchars($this->value)?></textarea>
          <label for="<?=htmlspecialchars($this->id)?>"><?=htmlspecialchars($this->label)?></label>
          <?php if ($this->helper_text) { ?>
              <span class="helper-text"><?=htmlspecialchars($this->helper_text)?></span>
          <?php } ?>
        </div>
        <?php
    }

}
