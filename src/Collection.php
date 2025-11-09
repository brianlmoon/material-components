<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize collection component for lists, menus, and navs.
 */
class Collection extends ComponentAbstract {

    // attributes
    /**
     * HTML tag used for the outer collection wrapper.
     */
    public string $tag = 'ul';

    /**
     * ARIA role applied to the outer wrapper.
     */
    public string $role = 'list';

    // settings
    /**
     * Ensures the wrapper includes the Materialize `collection` class.
     */
    protected string $wrapper_class = 'collection';

    /**
     * Heading tag used for header items.
     */
    protected string $header_tag = 'h5';

    /**
     * Collection entries.
     *
     * Each item may define:
     *  - label (string)
     *  - href (string)
     *  - class (string)
     *  - active (bool)
     *  - disabled (bool)
     *  - avatar (string image URL)
     *  - avatar_alt (string)
     *  - body (string)
     *  - badge (string)
     *  - badge_class (string)
     *  - secondary (string)
     *  - secondary_icon (string)
     *  - secondary_href (string)
     *  - secondary_class (string)
     *  - header (bool)
     *  - divider (bool)
     *  - type (string: item|header|divider)
     *
     * @var array<int|string, array<string, mixed>|string>
     */
    protected array $items = [];

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if (empty($this->role)) {
            $this->role = 'list';
        }

        if (!str_contains($this->class, 'collection')) {
            $this->class = trim("{$this->wrapper_class} {$this->class}");
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

        $tag = $this->tag ?: 'ul';
        ?>
        <<?=htmlspecialchars($tag)?> <?=$this->attributes()?>>
            <?php foreach ($items as $item) { ?>
                <?php $this->renderItem($item); ?>
            <?php } ?>
        </<?=htmlspecialchars($tag)?>>
        <?php
    }

    /**
     * Renders an individual collection entry.
     *
     * @param array<string, mixed> $item
     */
    protected function renderItem(array $item): void {
        switch ($item['type']) {
            case 'header':
                $header_tag = $this->header_tag ?: 'h5';
                ?>
                <li class="collection-header <?=htmlspecialchars($item['class'])?>">
                    <<?=htmlspecialchars($header_tag)?>><?=htmlspecialchars($item['label'])?></<?=htmlspecialchars($header_tag)?>>
                </li>
                <?php
                return;
            case 'divider':
                ?>
                <li class="divider <?=htmlspecialchars($item['class'])?>" role="separator"></li>
                <?php
                return;
        }

        $base_class = 'collection-item';
        if ($item['avatar']) {
            $base_class .= ' avatar';
        }
        if ($item['active']) {
            $base_class .= ' active';
        }
        if ($item['disabled']) {
            $base_class .= ' disabled';
        }
        $base_class = trim($base_class . ' ' . $item['class']);

        if ($item['href'] && !$item['avatar']) {
            ?>
            <a class="<?=htmlspecialchars($base_class)?>" href="<?=htmlspecialchars($item['href'])?>">
                <?php $this->renderItemContent($item); ?>
            </a>
            <?php
        } else {
            ?>
            <li class="<?=htmlspecialchars($base_class)?>">
                <?php $this->renderItemContent($item); ?>
            </li>
            <?php
        }
    }

    /**
     * Renders the content for a collection entry.
     *
     * @param array<string, mixed> $item
     */
    protected function renderItemContent(array $item): void {
        if ($item['avatar']) {
            ?>
            <img src="<?=htmlspecialchars($item['avatar'])?>" alt="<?=htmlspecialchars($item['avatar_alt'])?>" class="circle" />
            <?php
        }

        if ($item['label'] !== '') {
            if ($item['avatar']) {
                ?>
                <span class="title"><?=htmlspecialchars($item['label'])?></span>
                <?php
            } else {
                echo htmlspecialchars($item['label']);
            }
        }

        if ($item['badge'] !== '') {
            ?>
            <span class="badge <?=htmlspecialchars($item['badge_class'])?>"><?=htmlspecialchars($item['badge'])?></span>
            <?php
        }

        if ($item['body'] !== '') {
            ?>
            <p><?=nl2br(htmlspecialchars($item['body']))?></p>
            <?php
        }

        if ($item['secondary_icon'] !== '' || $item['secondary'] !== '') {
            $secondary_tag = $item['secondary_href'] ? 'a' : 'span';
            ?>
            <<?= $secondary_tag ?> class="secondary-content <?=htmlspecialchars($item['secondary_class'])?>" <?php if ($item['secondary_href']) { ?>href="<?=htmlspecialchars($item['secondary_href'])?>"<?php } ?>>
                <?php if ($item['secondary_icon'] !== '') { ?>
                    <i class="material-icons"><?=htmlspecialchars($item['secondary_icon'])?></i>
                <?php } ?>
                <?php if ($item['secondary'] !== '') { ?>
                    <?=htmlspecialchars($item['secondary'])?>
                <?php } ?>
            </<?=$secondary_tag?>>
            <?php
        }
    }

    /**
     * Normalizes item definitions.
     *
     * @param array<int|string, array<string, mixed>|string> $items
     *
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeItems(array $items): array {
        $normalized = [];
        $has_header = false;

        foreach ($items as $key => $item) {
            if (is_array($item)) {
                $type = $item['type'] ?? '';
                if (!empty($item['header'])) {
                    $type = 'header';
                } elseif (!empty($item['divider'])) {
                    $type = 'divider';
                }
                $label          = (string)($item['label'] ?? $item['text'] ?? '');
                $href           = (string)($item['href'] ?? '#!');
                $class          = trim((string)($item['class'] ?? ''));
                $active         = (bool)($item['active'] ?? false);
                $disabled       = (bool)($item['disabled'] ?? false);
                $avatar         = (string)($item['avatar'] ?? '');
                $avatar_alt     = (string)($item['avatar_alt'] ?? '');
                $body           = (string)($item['body'] ?? '');
                $badge          = (string)($item['badge'] ?? '');
                $badge_class    = trim((string)($item['badge_class'] ?? ''));
                $secondary      = (string)($item['secondary'] ?? '');
                $secondary_icon = (string)($item['secondary_icon'] ?? '');
                $secondary_href = (string)($item['secondary_href'] ?? '');
                $secondary_class= trim((string)($item['secondary_class'] ?? ''));
            } else {
                $type           = '';
                $label          = (string)$item;
                $href           = is_string($key) ? (string)$key : '#!';
                $class          = '';
                $active         = false;
                $disabled       = false;
                $avatar         = '';
                $avatar_alt     = '';
                $body           = '';
                $badge          = '';
                $badge_class    = '';
                $secondary      = '';
                $secondary_icon = '';
                $secondary_href = '';
                $secondary_class= '';
            }

            if ($type === 'divider') {
                $normalized[] = [
                    'type'  => 'divider',
                    'class' => $class,
                ];
                continue;
            }

            if ($type === 'header') {
                $has_header = true;
                if ($label === '') {
                    continue;
                }
                $normalized[] = [
                    'type'  => 'header',
                    'label' => $label,
                    'class' => $class,
                ];
                continue;
            }

            if ($label === '' && !$avatar && $body === '') {
                continue;
            }

            $normalized[] = [
                'type'            => 'item',
                'label'           => $label,
                'href'            => $href,
                'class'           => $class,
                'active'          => $active,
                'disabled'        => $disabled,
                'avatar'          => $avatar,
                'avatar_alt'      => $avatar_alt,
                'body'            => $body,
                'badge'           => $badge,
                'badge_class'     => $badge_class,
                'secondary'       => $secondary,
                'secondary_icon'  => $secondary_icon,
                'secondary_href'  => $secondary_href,
                'secondary_class' => $secondary_class,
            ];
        }

        if ($has_header && !str_contains($this->class, 'with-header')) {
            $this->class .= ' with-header';
        }

        return $normalized;
    }
}
