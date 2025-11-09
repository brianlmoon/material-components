<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize breadcrumbs component.
 *
 * Renders a navigation trail using Materialize breadcrumb links.
 */
class Breadcrumb extends ComponentAbstract {

    // attributes
    /**
     * ARIA role applied to the outer <nav>.
     */
    public string $role = 'navigation';

    // settings
    /**
     * Class names for the inner nav wrapper.
     */
    protected string $wrapper_class = 'nav-wrapper';

    /**
     * Class names for the container that holds breadcrumb links.
     */
    protected string $container_class = 'col s12';

    /**
     * Breadcrumb item definitions.
     *
     * Each item supports:
     *  - label (string, required)
     *  - href (string, defaults to #!)
     *  - class (string, optional)
     *  - current (bool, renders a <span> instead of <a>)
     *
     * @var array<int|string, array<string, mixed>|string>
     */
    protected array $items = [];

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if (empty($this->role)) {
            $this->role = 'navigation';
        }
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        $items = $this->normalizeItems($this->items);

        if (empty($items)) {
            return;
        }
        ?>
        <nav <?=$this->attributes()?>>
            <div class="<?=htmlspecialchars($this->wrapper_class)?>">
                <div class="<?=htmlspecialchars($this->container_class)?>">
                    <?php foreach ($items as $item) { ?>
                        <?php if ($item['current']) { ?>
                            <span class="breadcrumb <?=htmlspecialchars($item['class'])?>"><?=htmlspecialchars($item['label'])?></span>
                        <?php } else { ?>
                            <a href="<?=htmlspecialchars($item['href'])?>" class="breadcrumb <?=htmlspecialchars($item['class'])?>"><?=htmlspecialchars($item['label'])?></a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </nav>
        <?php
    }

    /**
     * Normalizes breadcrumb definitions.
     *
     * @param array<int|string, array<string, mixed>|string> $items
     *
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeItems(array $items): array {
        $normalized = [];

        foreach ($items as $key => $item) {
            if (is_array($item)) {
                $label   = (string)($item['label'] ?? $item['text'] ?? '');
                $href    = (string)($item['href'] ?? '#!');
                $class   = trim((string)($item['class'] ?? ''));
                $current = (bool)($item['current'] ?? false);
            } else {
                $label   = (string)$item;
                $href    = is_string($key) ? (string)$key : '#!';
                $class   = '';
                $current = false;
            }

            if ($label === '') {
                continue;
            }

            $normalized[] = [
                'label'   => $label,
                'href'    => $href,
                'class'   => $class,
                'current' => $current,
            ];
        }

        return $normalized;
    }
}
