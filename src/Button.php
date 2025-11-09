<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize button component for rendering `<button>` or `<a>` elements.
 */
class Button extends ComponentAbstract {

    // attributes
    /**
     * Button type attribute applied when rendering a `<button>`.
     *
     * @var string
     */
    public string $type = '';

    // settings
    /**
     * Visible button label.
     */
    protected string $text = '';

    /**
     * Materialize color class (e.g. `blue`).
     */
    protected string $color = '';

    /**
     * Optional icon rendered before the label.
     */
    protected Icon|null $icon = null;

    /**
     * Adds the `btn-flat` class when true.
     */
    protected bool $flat = false;

    /**
     * Size suffix appended as `btn-{size}`.
     */
    protected string $size = '';

    /**
     * Indicates whether the button is disabled.
     */
    protected bool $disabled = false;

    /**
     * When provided, renders the component as an `<a>` tag.
     */
    protected string $href = '';

    /**
     * Adds the `btn-floating` class when true.
     */
    protected bool $floating = false;

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        $this->class = "btn waves-effect waves-light {$this->color} {$this->class}";
        if ($this->flat) {
            $this->class .= ' btn-flat';
        }
        if ($this->size) {
            $this->class .= " btn-{$this->size}";
        }
        if ($this->floating) {
            $this->class .= ' btn-floating';
        }
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        if ($this->href) {
            $tag = 'a';
        } else {
            $tag = 'button';
        }
        ?><<?=$tag?> <?php if ($this->href) {?>href="<?=$this->href?>"<?php } ?> <?=$this->attributes()?>><?php if ($this->icon) {
            $this->icon->markup();
        }?><?=htmlspecialchars($this->text)?></<?=$tag?>><?php
    }
}
