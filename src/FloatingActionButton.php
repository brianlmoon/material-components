<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize floating action button (FAB) component.
 *
 * Provides wrapper markup for fixed FABs, horizontal FABs, or toolbar FABs
 * together with nested action buttons.
 */
class FloatingActionButton extends ComponentAbstract {

    // attributes
    /**
     * Controls the outer wrapper tag (defaults to div).
     */
    protected string $tag = 'div';

    /**
     * Indicates whether the FAB expands horizontally.
     */
    protected bool $horizontal = false;

    /**
     * Indicates whether toolbar styling should be applied.
     */
    protected bool $toolbar = false;

    /**
     * Optional ARIA label for the wrapper element.
     */
    protected string $aria_label = '';

    // settings
    /**
     * Class applied to the wrapper. Automatically ensures `fixed-action-btn`.
     */
    protected string $wrapper_class = 'fixed-action-btn';

    /**
     * Base class fragment appended to the main button (e.g. btn-large).
     */
    protected string $button_size = 'btn-large';

    /**
     * Color class (Materialize palette) for the main button.
     */
    protected string $button_color_class = 'red';

    /**
     * Additional classes for the main button.
     */
    protected string $button_class = '';

    /**
     * Tag used for the main trigger (`a` or `button`).
     */
    protected string $button_tag = 'a';

    /**
     * Href attribute for anchor triggers.
     */
    protected string $button_href = '#!';

    /**
     * Optional main button text (in addition to any icon).
     */
    protected string $button_text = '';

    /**
     * Material icon text for the button.
     */
    protected string $button_icon = '';

    /**
     * Class used for the icon element (defaults to `material-icons`).
     */
    protected string $button_icon_class = 'material-icons';

    /**
     * Optional Icon component used as the trigger content.
     */
    protected Icon|null $button_icon_component = null;

    /**
     * Additional data attributes applied to the main button.
     *
     * @var array<string, string|int|float|bool>
     */
    protected array $button_data = [];

    /**
     * Determines whether the main button is disabled.
     */
    protected bool $button_disabled = false;

    /**
     * Definitions for nested action buttons.
     *
     * @var array<int|string, array<string, mixed>|string>
     */
    protected array $actions = [];

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if (!str_contains($this->class, 'fixed-action-btn')) {
            $this->class = trim("{$this->wrapper_class} {$this->class}");
        }

        if ($this->horizontal && !str_contains($this->class, 'horizontal')) {
            $this->class .= ' horizontal';
        }

        if ($this->toolbar && !str_contains($this->class, 'toolbar')) {
            $this->class .= ' toolbar';
        }
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        $tag     = $this->tag ?: 'div';
        $actions = $this->normalizeActions($this->actions);

        ?>
        <<?=htmlspecialchars($tag)?> <?=$this->attributes()?>>
            <?=$this->renderMainButton()?>
            <?php if (!empty($actions)) { ?>
                <ul>
                    <?php foreach ($actions as $action) { ?>
                        <li>
                            <?=$this->renderAction($action)?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </<?=htmlspecialchars($tag)?>>
        <?php
    }

    /**
     * Renders the main floating action button trigger.
     *
     * @return string
     */
    protected function renderMainButton(): string {
        $tag = $this->button_tag ?: 'a';

        $attributes = [
            'class' => trim("btn-floating {$this->button_size} {$this->button_color_class} {$this->button_class}"),
        ];

        if ($tag === 'a') {
            $attributes['href'] = $this->button_href ?: '#!';
        } elseif ($tag === 'button') {
            $attributes['type'] = 'button';
        }

        if ($this->button_disabled) {
            $attributes['disabled'] = true;
        }

        foreach ($this->button_data as $name => $value) {
            $attributes['data-' . $name] = $value;
        }

        $content = $this->buttonContentMarkup();

        return $this->buildTag($tag, $attributes, $content);
    }

    /**
     * Returns the HTML for the main button content.
     */
    protected function buttonContentMarkup(): string {
        ob_start();
        if ($this->button_icon_component instanceof Icon) {
            $this->button_icon_component->markup();
        } elseif ($this->button_icon !== '') {
            ?>
            <i class="<?=htmlspecialchars($this->button_icon_class)?>"><?=htmlspecialchars($this->button_icon)?></i>
            <?php
        }

        if ($this->button_text !== '') {
            echo htmlspecialchars($this->button_text);
        }

        return trim((string)ob_get_clean());
    }

    /**
     * Renders a single action button.
     *
     * @param array<string, mixed> $action
     *
     * @return string
     */
    protected function renderAction(array $action): string {
        $attributes = [
            'class' => trim("btn-floating {$action['color_class']} {$action['class']}"),
        ];

        if ($action['tag'] === 'a') {
            $attributes['href'] = $action['href'];
        } elseif ($action['tag'] === 'button') {
            $attributes['type'] = 'button';
        }

        if ($action['disabled']) {
            $attributes['disabled'] = true;
        }

        if ($action['target'] !== '') {
            $attributes['target'] = $action['target'];
        }

        if ($action['tooltip'] !== '') {
            $attributes['class'] .= ' tooltipped';
            $attributes['data-tooltip'] = $action['tooltip'];
            if ($action['tooltip_position'] !== '') {
                $attributes['data-position'] = $action['tooltip_position'];
            }
        }

        foreach ($action['data'] as $name => $value) {
            $attributes['data-' . $name] = $value;
        }

        $content = $this->actionContentMarkup($action);

        return $this->buildTag($action['tag'], $attributes, $content);
    }

    /**
     * Returns the HTML contents for an action button.
     *
     * @param array<string, mixed> $action
     *
     * @return string
     */
    protected function actionContentMarkup(array $action): string {
        ob_start();

        if ($action['icon'] !== '') {
            ?>
            <i class="<?=htmlspecialchars($action['icon_class'])?>"><?=htmlspecialchars($action['icon'])?></i>
            <?php
        }

        if ($action['text'] !== '') {
            echo htmlspecialchars($action['text']);
        }

        return trim((string)ob_get_clean());
    }

    /**
     * Normalizes the actions definition to a consistent structure.
     *
     * @param array<int|string, array<string, mixed>|string> $actions
     *
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeActions(array $actions): array {
        $normalized = [];

        foreach ($actions as $key => $action) {
            if (is_array($action)) {
                $tag               = $action['tag']  ?? 'a';
                $href              = $action['href'] ?? '#!';
                $class             = trim((string)($action['class'] ?? ''));
                $color_class       = trim((string)($action['color_class'] ?? ''));
                $text              = (string)($action['text'] ?? '');
                $icon              = (string)($action['icon'] ?? '');
                $icon_class        = trim((string)($action['icon_class'] ?? 'material-icons'));
                $tooltip           = (string)($action['tooltip'] ?? '');
                $tooltip_position  = (string)($action['tooltip_position'] ?? '');
                $disabled          = (bool)($action['disabled'] ?? false);
                $target            = (string)($action['target'] ?? '');
                $data              = (array)($action['data'] ?? []);
            } else {
                $tag              = 'a';
                $href             = is_string($key) ? (string)$key : '#!';
                $class            = '';
                $color_class      = '';
                $text             = (string)$action;
                $icon             = '';
                $icon_class       = 'material-icons';
                $tooltip          = '';
                $tooltip_position = '';
                $disabled         = false;
                $target           = '';
                $data             = [];
            }

            if ($icon === '' && $text === '') {
                continue;
            }

            $normalized[] = [
                'tag'              => $tag,
                'href'             => $href,
                'class'            => $class,
                'color_class'      => $color_class,
                'text'             => $text,
                'icon'             => $icon,
                'icon_class'       => $icon_class,
                'tooltip'          => $tooltip,
                'tooltip_position' => $tooltip_position,
                'disabled'         => $disabled,
                'target'           => $target,
                'data'             => $data,
            ];
        }

        return $normalized;
    }

    /**
     * Builds an HTML tag with attributes and content.
     *
     * @param string $tag
     * @param array<string, string|bool> $attributes
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
        $html .= '>';
        $html .= $content;
        $html .= '</' . htmlspecialchars($tag) . '>';

        return $html;
    }

    /**
     * {@inheritDoc}
     */
    public static function script(): void {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.fixed-action-btn');
            M.FloatingActionButton.init(elems);
        });
        </script>
        <?php
    }
}
