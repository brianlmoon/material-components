<?php

namespace Moonspot\MaterialComponents;

class Button extends \Moonspot\Component\ComponentAbstract {

    // attributes
    public $type = '';

    // settings
    protected string    $text     = '';
    protected string    $color    = '';
    protected Icon|null $icon     = null;
    protected bool      $flat     = false;
    protected string    $size     = '';
    protected bool      $disabled = false;
    protected string    $href     = '';
    protected bool      $floating = false;

    public function setDefaults() {
        $this->class = "btn waves-effect waves-light {$this->color} {$this->class}";
        if ($this->flat) {
            $this->class .= " btn-flat";
        }
        if ($this->size) {
            $this->class .= " btn-{$this->size}";
        }
        if ($this->floating) {
            $this->class .= " btn-floating";
        }
    }

    public function markup() {
        if ($this->href) {
            $tag = 'a';
        } else {
            $tag = 'button';
        }
        ?><<?=$tag?> <?php if ($this->href) {?>href="<?=$this->href?>"<?php } ?> <?=$this->attributes()?>><?php if ($this->icon) $this->icon->markup();?><?=htmlspecialchars($this->text)?></<?=$tag?>><?php
    }
}
