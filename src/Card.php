<?php

namespace Moonspot\MaterialComponents;

class Card extends \Moonspot\Component\ComponentAbstract {

    // settings
    protected string                $title            = '';
    protected string                $color            = 'black';
    protected string                $background_color = 'white';
    protected string                $image            = '';
    protected string|array|\Closure $content          = '';
    protected array                 $actions          = [];

    public function setDefaults() {
        $this->class .= " card {$this->background_color}";

        foreach ($this->actions as $action) {
            if (!count($action) === 2 || empty($action['href']) || empty($action['text'])) {
                throw new \LogicException("Invalid action", 1);
            }
        }
    }

    public function markup() {
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
