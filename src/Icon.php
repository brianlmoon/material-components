<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize icon component for the `material-icons` font.
 */
class Icon extends ComponentAbstract {

    // settings
    /**
     * Icon name rendered inside the `<i>` tag.
     */
    protected string $name = '';

    /**
     * Optional size helper class.
     */
    protected string $size = '';

    /**
     * Alignment helper such as `left` or `right`.
     */
    protected string $side = '';

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        $this->class .= " material-icons {$this->side}";
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        ?><i <?=$this->attributes()?>><?=htmlspecialchars($this->name)?></i><?php
    }

}
