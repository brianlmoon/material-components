<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize pagination component.
 *
 * Renders a pagination nav with active/disabled states and icon support.
 */
class Pagination extends ComponentAbstract {

    // attributes
    /**
     * Tag used for the outer container (defaults to nav).
     */
    public string $container_tag = 'nav';

    /**
     * WAI-ARIA role applied to the outer container.
     */
    public string $role = 'navigation';

    // settings
    /**
     * Class applied to the inner list wrapper.
     */
    protected string $list_class = 'pagination';

    /**
     * Items describing each pagination link.
     *
     * @var array<int|string, array<string, mixed>|string>
     */
    protected array $items = [];

    /**
     * Optional label describing the pagination for assistive tech.
     */
    protected string $aria_label = '';

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if (empty($this->role)) {
            $this->role = 'navigation';
        }

        if (!str_contains($this->list_class, 'pagination')) {
            $this->list_class = trim('pagination ' . $this->list_class);
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

        $container_tag = $this->container_tag ?: 'nav';
        ?>
        <<?=htmlspecialchars($container_tag)?> <?=$this->attributes()?><?php if ($this->aria_label !== '') { ?> aria-label="<?=htmlspecialchars($this->aria_label)?>"<?php } ?>>
            <ul class="<?=htmlspecialchars($this->list_class)?>">
                <?php foreach ($items as $item) { ?>
                    <li class="<?=htmlspecialchars($item['li_class'])?>">
                        <?=$this->renderItemLink($item)?>
                    </li>
                <?php } ?>
            </ul>
        </<?=htmlspecialchars($container_tag)?>>
        <?php
    }

    /**
     * Renders the anchor/button for a pagination item.
     *
     * @param array<string, mixed> $item
     *
     * @return string
     */
    protected function renderItemLink(array $item): string {
        $tag = $item['tag'];

        $attributes = [
            'class' => trim($item['link_class']),
        ];

        if ($tag === 'a') {
            $attributes['href'] = $item['href'];
        } elseif ($tag === 'button') {
            $attributes['type'] = 'button';
        }

        if ($item['aria_label'] !== '') {
            $attributes['aria-label'] = $item['aria_label'];
        }

        if ($item['target'] !== '') {
            $attributes['target'] = $item['target'];
        }

        if ($item['disabled']) {
            $attributes['tabindex'] = -1;
            $attributes['aria-disabled'] = 'true';
        }

        foreach ($item['data'] as $name => $value) {
            $attributes['data-' . $name] = $value;
        }

        $content = $this->buildItemContent($item);

        return $this->buildTag($tag, $attributes, $content);
    }

    /**
     * Generates the inner HTML for a pagination item.
     *
     * @param array<string, mixed> $item
     *
     * @return string
     */
    protected function buildItemContent(array $item): string {
        ob_start();
        if ($item['icon'] !== '') {
            ?>
            <i class="material-icons"><?=htmlspecialchars($item['icon'])?></i>
            <?php
        }

        if ($item['label'] !== '') {
            echo htmlspecialchars($item['label']);
        }

        return trim((string)ob_get_clean());
    }

    /**
     * Normalizes pagination items.
     *
     * @param array<int|string, array<string, mixed>|string> $items
     *
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeItems(array $items): array {
        $normalized = [];

        foreach ($items as $key => $item) {
            if (is_array($item)) {
                $label      = (string)($item['label'] ?? $item['text'] ?? '');
                $href       = (string)($item['href'] ?? '#!');
                $class      = trim((string)($item['class'] ?? ''));
                $link_class = trim((string)($item['link_class'] ?? ''));
                $active     = (bool)($item['active'] ?? false);
                $disabled   = (bool)($item['disabled'] ?? false);
                $icon       = (string)($item['icon'] ?? '');
                $aria_label = (string)($item['aria_label'] ?? '');
                $tag        = (string)($item['tag'] ?? 'a');
                $target     = (string)($item['target'] ?? '');
                $data       = (array)($item['data'] ?? []);
            } else {
                $label      = (string)$item;
                $href       = is_string($key) ? (string)$key : '#!';
                $class      = '';
                $link_class = '';
                $active     = false;
                $disabled   = false;
                $icon       = '';
                $aria_label = '';
                $tag        = 'a';
                $target     = '';
                $data       = [];
            }

            if ($label === '' && $icon === '') {
                continue;
            }

            $li_class_parts = [];
            if ($active) {
                $li_class_parts[] = 'active';
            } elseif ($disabled) {
                $li_class_parts[] = 'disabled';
            } else {
                $li_class_parts[] = 'waves-effect';
            }
            if ($class !== '') {
                $li_class_parts[] = $class;
            }

            $link_class = trim($link_class);

            $normalized[] = [
                'label'      => $label,
                'href'       => $href,
                'icon'       => $icon,
                'tag'        => $tag,
                'active'     => $active,
                'disabled'   => $disabled,
                'aria_label' => $aria_label,
                'target'     => $target,
                'data'       => $data,
                'li_class'   => implode(' ', $li_class_parts),
                'link_class' => $link_class,
            ];
        }

        return $normalized;
    }

    /**
     * Builds an HTML tag string.
     *
     * @param string $tag
     * @param array<string, string|int|bool> $attributes
     * @param string $content
     *
     * @return string
     */
    protected function buildTag(string $tag, array $attributes, string $content): string {
        $html = '<' . htmlspecialchars($tag);
        foreach ($attributes as $name => $value) {
            if ($value === '' || $value === null) {
                continue;
            }

            if (is_bool($value)) {
                if ($value) {
                    $html .= ' ' . htmlspecialchars($name);
                }
                continue;
            }

            $html .= ' ' . htmlspecialchars($name) . '="' . htmlspecialchars((string)$value) . '"';
        }
        $html .= '>' . $content . '</' . htmlspecialchars($tag) . '>';

        return $html;
    }
}
