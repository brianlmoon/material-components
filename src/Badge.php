<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize badge component for numeric counts or text pills.
 */
class Badge extends ComponentAbstract {

    // attributes
    /**
     * HTML tag used for rendering the badge element.
     */
    public string $tag = 'span';

    /**
     * Adds the `new` class when true.
     */
    public bool $is_new = false;

    /**
     * Adds the `pulse` animation class when true.
     */
    public bool $pulse = false;

    /**
     * Adds the `left` class for alignment.
     */
    public bool $align_left = false;

    /**
     * Adds the `right` class for alignment.
     */
    public bool $align_right = false;

    // settings
    /**
     * Visible badge text.
     */
    protected string $text = '';

    /**
     * Materialize color class (e.g. `blue`, `red lighten-1`).
     */
    protected string $color_class = '';

    /**
     * Optional caption displayed when using `data-badge-caption`.
     */
    protected string $caption = '';

    /**
     * Whether the badge should include the default `badge` class.
     */
    protected bool $auto_badge_class = true;

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if ($this->auto_badge_class && !str_contains($this->class, 'badge')) {
            $this->class = trim('badge ' . $this->class);
        }

        if ($this->color_class) {
            $this->class = trim($this->class . ' ' . $this->color_class);
        }

        if ($this->is_new) {
            $this->class = trim($this->class . ' new');
        }

        if ($this->pulse) {
            $this->class = trim($this->class . ' pulse');
        }

        if ($this->align_left) {
            $this->class = trim($this->class . ' left');
        }

        if ($this->align_right) {
            $this->class = trim($this->class . ' right');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        $tag = $this->tag ?: 'span';
        ?>
        <<?=htmlspecialchars($tag)?> <?=$this->attributes()?><?php if ($this->caption !== '') { ?> data-badge-caption="<?=htmlspecialchars($this->caption)?>"<?php } ?>><?=htmlspecialchars($this->text)?></<?=htmlspecialchars($tag)?>>
        <?php
    }
}
