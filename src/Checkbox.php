<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize checkbox component.
 *
 * Renders a checkbox using Materialize CSS markup, supporting helper text and
 * the "filled-in" variant.
 */
class Checkbox extends ComponentAbstract {

    // attributes
    public string $name     = '';
    public string $type     = 'checkbox';
    public string $value    = '1';
    public bool   $checked  = false;
    public bool   $disabled = false;
    public bool   $required = false;

    // settings
    protected string $label         = '';
    protected string $wrapper_class = '';
    protected string $helper_text   = '';
    protected bool   $filled_in     = false;

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if (empty($this->name)) {
            $this->name = $this->id;
        }

        // Always enforce checkbox type.
        $this->type = 'checkbox';

        if ($this->filled_in && (empty($this->class) || !str_contains($this->class, 'filled-in'))) {
            $this->class = trim('filled-in ' . $this->class);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        ?>
        <p class="<?=htmlspecialchars($this->wrapper_class)?>">
            <label for="<?=htmlspecialchars($this->id)?>">
                <input <?=$this->attributes()?> />
                <span><?=htmlspecialchars($this->label)?></span>
            </label>
            <?php if ($this->helper_text) { ?>
                <span class="helper-text"><?=htmlspecialchars($this->helper_text)?></span>
            <?php } ?>
        </p>
        <?php
    }
}
