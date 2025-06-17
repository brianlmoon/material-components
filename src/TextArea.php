<?php

namespace Moonspot\MaterialComponents;

class TextArea extends \Moonspot\Component\ComponentAbstract {

    // attributes
    public bool     $disabled    = false;
    public bool     $readonly    = false;
    public int|null $minlength   = null;
    public int|null $maxlength   = null;
    public string   $placeholder = '';
    public bool     $required    = false;

    // settings
    protected string $value         = '';
    protected string $label         = '';
    protected string $wrapper_class = '';
    protected string $helper_text   = '';

    public function markup() {
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
