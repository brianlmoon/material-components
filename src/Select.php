<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize select component with helper text support.
 */
class Select extends ComponentAbstract {

    // attributes
    /**
     * Select name attribute (defaults to component id).
     */
    public string $name = '';

    /**
     * Disables the select when true.
     */
    public bool $disabled = false;

    /**
     * Applies the `readonly` attribute.
     */
    public bool $readonly = false;

    /**
     * Marks the select as required.
     */
    public bool $required = false;

    // settings
    /**
     * Currently selected value.
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
     * Helper text rendered beneath the select.
     */
    protected string $helper_text = '';

    /**
     * Options definition array, each containing `value` and `text`.
     *
     * @var array<int, array{value:string,text:string}>
     */
    protected array $options = [];

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
            <select <?=$this->attributes()?>>
                <?php foreach ($this->options as $option) { ?>
                    <option value="<?=htmlspecialchars($option['value'])?>" <?php if ($option['value'] == $this->value) { ?>selected<?php } ?>><?=htmlspecialchars($option['text'])?></option>
                <?php } ?>
            </select>
          <label for="<?=htmlspecialchars($this->id)?>"><?=htmlspecialchars($this->label)?></label>
          <?php if ($this->helper_text) { ?>
              <span class="helper-text"><?=htmlspecialchars($this->helper_text)?></span>
          <?php } ?>
        </div>
        <?php
    }

    /**
     * {@inheritDoc}
     */
    public static function script() {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
        </script>
        <?php
    }
}
