<?php

namespace Moonspot\MaterialComponents;

class TextInput extends \Moonspot\Component\ComponentAbstract {

    // attributes
    public string   $name        = '';
    public string   $type        = 'text';
    public string   $value       = '';
    public bool     $disabled    = false;
    public bool     $readonly    = false;
    public bool     $required    = false;
    public int|null $minlength   = null;
    public int|null $maxlength   = null;
    public int|null $min         = null;
    public int|null $max         = null;
    public string   $pattern     = '';
    public string   $placeholder = '';

    // settings
    protected string $label         = '';
    protected string $wrapper_class = '';
    protected string $helper_text   = '';

    public function setDefaults() {
        if (empty($this->name)) {
            $this->name = $this->id;
        }
    }

    public function markup() {
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
