<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize card component featuring optional image, content, and actions.
 */
class Card extends ComponentAbstract {

    // settings
    /**
     * Optional heading displayed inside the card content.
     */
    protected string $title = '';

    /**
     * Text color modifier (defaults to `black`).
     */
    protected string $color = 'black';

    /**
     * Background color class appended to the outer card.
     */
    protected string $background_color = 'white';

    /**
     * Optional image URL rendered in `.card-image`.
     */
    protected string $image = '';

    /**
     * Card content string, array (preformatted HTML), or closure.
     *
     * @var string|array|\Closure
     */
    protected string|array|\Closure $content = '';

    /**
     * List of actions, each requiring an `href` and `text`.
     *
     * @var array<int, array{href:string,text:string}>
     */
    protected array $actions = [];

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        $this->class .= " card {$this->background_color}";

        foreach ($this->actions as $action) {
            if (!count($action) === 2 || empty($action['href']) || empty($action['text'])) {
                throw new \LogicException("Invalid action", 1);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        ?>
        <div <?=$this->attributes()?>>
            <?php if ($this->image) { ?>
                <div class="card-image">
                    <img src="<?=htmlspecialchars($this->image)?>" />
                </div>
            <?php } ?>
            <div class="card-stacked">
                <div class="card-content <?=$this->color?>-text">
                    <?php if ($this->title) { ?>
                        <span class="card-title"><?=htmlspecialchars($this->title)?></span>
                    <?php } ?>
                    <?php
                    if (is_callable($this->content)) {
                        call_user_func($this->content);
                    } else {
                        echo $this->content;
                    }
                    ?>
                </div>
                <?php if (!empty($this->actions)) { ?>
                    <div class="card-action">
                        <?php foreach ($this->actions as $action) { ?>
                            <a href="<?=htmlspecialchars($action['href'])?>"><?=htmlspecialchars($action['text'])?></a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

}
