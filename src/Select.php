<?php

namespace Moonspot\MaterialComponents;

class Select extends \Moonspot\Component\ComponentAbstract {

    // attributes
    public bool     $disabled    = false;
    public bool     $readonly    = false;
    public bool     $required    = false;

    // settings
    protected string $value         = '';
    protected string $label         = '';
    protected string $wrapper_class = '';
    protected string $helper_text   = '';
    protected array  $options       = [];

    public function markup() {
        ?>
        <div class="input-field <?=htmlspecialchars($this->wrapper_class)?>">
            <select>
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

}
