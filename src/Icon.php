<?php

namespace Moonspot\MaterialComponents;

class Icon extends \Moonspot\Component\ComponentAbstract {

    // settings
    protected string $name = '';
    protected string $size = '';
    protected string $side = '';

    public function setDefaults() {
        $this->class .= " material-icons {$this->side}";
    }

    public function markup() {
        ?><i <?=$this->attributes()?>><?=htmlspecialchars($this->name)?></i><?php
    }

}
