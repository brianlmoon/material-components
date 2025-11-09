<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize tabs component.
 *
 * Provides the tab list markup and optional content containers for each tab.
 */
class Tabs extends ComponentAbstract {

    // attributes
    /**
     * Tag used for the wrapper surrounding the tabs.
     */
    public string $container_tag = 'div';

    /**
     * ARIA role for the tabs navigation element.
     */
    public string $role = 'navigation';

    // settings
    /**
     * Classes applied to the <ul> that contains the tabs.
     */
    protected string $tabs_class = 'tabs';

    /**
     * Additional class applied to each <li> tab element.
     */
    protected string $tab_item_class = '';

    /**
     * Defines the tabs displayed in the list.
     *
     * Each tab supports:
     *  - label (string)
     *  - href (string)
     *  - class (string)
     *  - anchor_class (string)
     *  - active (bool)
     *  - disabled (bool)
     *  - icon (string)
     *  - icon_position (string: left|right)
     *
     * @var array<int|string, array<string, mixed>|string>
     */
    protected array $items = [];

    /**
     * Optional content sections rendered after the tab list.
     *
     * @var array<int, array<string, mixed>>
     */
    protected array $content_sections = [];

    /**
     * Class applied to each tab content container.
     */
    protected string $content_class = 'col s12';

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if (empty($this->role)) {
            $this->role = 'navigation';
        }

        if (!str_contains($this->tabs_class, 'tabs')) {
            $this->tabs_class = trim('tabs ' . $this->tabs_class);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        $tabs = $this->normalizeItems($this->items);
        $sections = $this->normalizeContentSections($this->content_sections);

        if (empty($tabs)) {
            return;
        }

        $container_tag = $this->container_tag ?: 'div';
        ?>
        <<?=htmlspecialchars($container_tag)?> <?=$this->attributes()?> role="<?=htmlspecialchars($this->role)?>">
            <ul class="<?=htmlspecialchars($this->tabs_class)?>">
                <?php foreach ($tabs as $tab) { ?>
                    <li class="tab <?=htmlspecialchars($this->tab_item_class)?> <?=htmlspecialchars($tab['class'])?>">
                        <?=$this->renderTabAnchor($tab)?>
                    </li>
                <?php } ?>
            </ul>

            <?php foreach ($sections as $section) { ?>
                <div id="<?=htmlspecialchars($section['id'])?>" class="<?=htmlspecialchars($section['class'])?>">
                    <?php
                    if (is_callable($section['content'])) {
                        call_user_func($section['content']);
                    } else {
                        echo $section['content'];
                    }
                    ?>
                </div>
            <?php } ?>
        </<?=htmlspecialchars($container_tag)?>>
        <?php
    }

    /**
     * Renders a tab anchor element.
     *
     * @param array<string, mixed> $tab
     *
     * @return string
     */
    protected function renderTabAnchor(array $tab): string {
        $classes = trim($tab['anchor_class'] . ($tab['disabled'] ? ' disabled' : ''));
        $attrs = [
            'href'  => $tab['href'],
            'class' => $classes,
        ];
        if ($tab['target']) {
            $attrs['target'] = $tab['target'];
        }

        $content = $this->tabContentMarkup($tab);

        return $this->buildTag('a', $attrs, $content);
    }

    /**
     * Builds the inner HTML for a tab anchor.
     *
     * @param array<string, mixed> $tab
     *
     * @return string
     */
    protected function tabContentMarkup(array $tab): string {
        ob_start();
        if ($tab['icon'] !== '') {
            ?>
            <i class="material-icons <?=htmlspecialchars($tab['icon_position'])?>"><?=htmlspecialchars($tab['icon'])?></i>
            <?php
        }
        echo htmlspecialchars($tab['label']);

        return trim((string)ob_get_clean());
    }

    /**
     * Normalizes the tabs collection.
     *
     * @param array<int|string, array<string, mixed>|string> $items
     *
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeItems(array $items): array {
        $normalized = [];

        foreach ($items as $key => $item) {
            if (is_array($item)) {
                $label        = (string)($item['label'] ?? $item['text'] ?? '');
                $href         = (string)($item['href'] ?? ($item['target_id'] ?? ''));
                $class        = trim((string)($item['class'] ?? ''));
                $anchor_class = trim((string)($item['anchor_class'] ?? ''));
                $active       = (bool)($item['active'] ?? false);
                $disabled     = (bool)($item['disabled'] ?? false);
                $icon         = (string)($item['icon'] ?? '');
                $icon_position= trim((string)($item['icon_position'] ?? ''));
                $target       = (string)($item['target'] ?? '');
                $target_id    = (string)($item['id'] ?? '');
            } else {
                $label        = (string)$item;
                $href         = is_string($key) ? (string)$key : '';
                $class        = '';
                $anchor_class = '';
                $active       = false;
                $disabled     = false;
                $icon         = '';
                $icon_position= '';
                $target       = '';
                $target_id    = '';
            }

            if ($label === '') {
                continue;
            }

            if ($href === '' && $target_id !== '') {
                $href = '#' . ltrim($target_id, '#');
            }

            if ($href === '') {
                $href = '#';
            }

            if ($active && !str_contains($anchor_class, 'active')) {
                $anchor_class = trim($anchor_class . ' active');
            }

            $normalized[] = [
                'label'        => $label,
                'href'         => $href,
                'class'        => $class,
                'anchor_class' => $anchor_class,
                'disabled'     => $disabled,
                'icon'         => $icon,
                'icon_position'=> $icon_position,
                'target'       => $target,
            ];
        }

        return $normalized;
    }

    /**
     * Normalizes optional tab content sections.
     *
     * @param array<int, array<string, mixed>> $sections
     *
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeContentSections(array $sections): array {
        $normalized = [];

        foreach ($sections as $section) {
            if (empty($section['id'])) {
                continue;
            }

            $content = $section['content'] ?? '';
            if (!is_callable($content)) {
                $content = htmlspecialchars((string)$content);
            }

            $normalized[] = [
                'id'      => (string)$section['id'],
                'class'   => trim((string)($section['class'] ?? $this->content_class)),
                'content' => $content,
            ];
        }

        return $normalized;
    }

    /**
     * Builds an HTML tag string with attributes.
     *
     * @param string $tag
     * @param array<string, string> $attributes
     * @param string $content
     *
     * @return string
     */
    protected function buildTag(string $tag, array $attributes, string $content): string {
        $html = '<' . htmlspecialchars($tag);
        foreach ($attributes as $name => $value) {
            if ($value === '') {
                continue;
            }
            $html .= ' ' . htmlspecialchars($name) . '="' . htmlspecialchars($value) . '"';
        }

        return $html . '>' . $content . '</' . htmlspecialchars($tag) . '>';
    }

    /**
     * {@inheritDoc}
     */
    public static function script(): void {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.tabs');
            M.Tabs.init(elems);
        });
        </script>
        <?php
    }
}
