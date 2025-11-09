<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize navbar component.
 *
 * Builds a responsive navigation bar with optional brand text, desktop menu,
 * and mobile sidenav trigger/output following the Materialize guidelines.
 */
class Navbar extends ComponentAbstract {

    // attributes
    /**
     * WAI-ARIA role applied to the <nav> element.
     */
    public string $role = 'navigation';

    // settings
    /**
     * Text displayed for the brand link.
     */
    protected string $brand_text = '';

    /**
     * URL used for the brand link.
     */
    protected string $brand_href = '#!';

    /**
     * Optional CSS classes added inside the nav wrapper.
     */
    protected string $wrapper_class = 'nav-wrapper';

    /**
     * Additional classes applied directly to the <nav> element.
     */
    protected string $color_class = '';

    /**
     * Determines if the navbar is wrapped in the .navbar-fixed container.
     */
    protected bool $fixed = false;

    /**
     * Controls whether the mobile trigger is rendered when sidenav items exist.
     */
    protected bool $show_mobile_trigger = true;

    /**
     * ID used for the sidenav list. Defaults to "{$id}-sidenav".
     */
    protected string $sidenav_id = '';

    /**
     * Desktop navigation items configuration.
     *
     * Each item supports:
     *  - label (string, required)
     *  - href (string, defaults to #!)
     *  - class (string, optional)
     *  - active (bool, optional)
     *
     * @var array<int|string, array<string, mixed>|string>
     */
    protected array $menu_items = [];

    /**
     * Mobile sidenav items; defaults to the desktop items when empty.
     *
     * Same structure as $menu_items.
     *
     * @var array<int|string, array<string, mixed>|string>
     */
    protected array $mobile_items = [];

    /**
     * Class attribute applied to the desktop <ul>.
     */
    protected string $menu_alignment = 'right hide-on-med-and-down';

    /**
     * CSS class applied to the mobile trigger link.
     */
    protected string $mobile_trigger_class = 'sidenav-trigger';

    /**
     * Icon text for the mobile trigger.
     */
    protected string $mobile_trigger_icon = 'menu';

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if (empty($this->role)) {
            $this->role = 'navigation';
        }

        if (!empty($this->color_class)) {
            $this->class = trim($this->class . ' ' . $this->color_class);
        }

        if (empty($this->sidenav_id)) {
            $this->sidenav_id = $this->id . '-sidenav';
        }

        if (empty($this->mobile_items)) {
            $this->mobile_items = $this->menu_items;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        $nav_renderer = function (): void {
            ?>
            <nav <?=$this->attributes()?>>
                <div class="<?=htmlspecialchars($this->wrapper_class)?>">
                    <?php if ($this->brand_text !== '') { ?>
                        <a href="<?=htmlspecialchars($this->brand_href)?>" class="brand-logo"><?=htmlspecialchars($this->brand_text)?></a>
                    <?php } ?>

                    <?php if ($this->show_mobile_trigger && !empty($this->mobile_items)) { ?>
                        <a href="#" data-target="<?=htmlspecialchars($this->sidenav_id)?>" class="<?=htmlspecialchars($this->mobile_trigger_class)?>">
                            <i class="material-icons"><?=htmlspecialchars($this->mobile_trigger_icon)?></i>
                        </a>
                    <?php } ?>

                    <?php $this->renderMenuList($this->menu_items, $this->menu_alignment); ?>
                </div>
            </nav>
            <?php
        };

        if ($this->fixed) {
            ?>
            <div class="navbar-fixed">
                <?php $nav_renderer(); ?>
            </div>
            <?php
        } else {
            $nav_renderer();
        }

        if (!empty($this->mobile_items)) {
            $this->renderMenuList($this->mobile_items, 'sidenav', true);
        }
    }

    /**
     * Renders a <ul> list for navigation items.
     *
     * @param array<int|string, array<string, mixed>|string> $items
     * @param string                                         $classes
     * @param bool                                           $is_mobile
     *
     * @return void
     */
    protected function renderMenuList(array $items, string $classes, bool $is_mobile = false): void {
        $normalized = $this->normalizeItems($items);

        if (empty($normalized)) {
            return;
        }
        ?>
        <ul class="<?=htmlspecialchars(trim($classes))?>" <?php if ($is_mobile) { ?>id="<?=htmlspecialchars($this->sidenav_id)?>"<?php } ?>>
            <?php foreach ($normalized as $item) { ?>
                <li class="<?=htmlspecialchars(trim($item['class']))?>">
                    <a href="<?=htmlspecialchars($item['href'])?>" <?php if ($item['active']) { ?>class="active"<?php } ?>><?=htmlspecialchars($item['label'])?></a>
                </li>
            <?php } ?>
        </ul>
        <?php
    }

    /**
     * Normalizes menu items into a uniform structure.
     *
     * @param array<int|string, array<string, mixed>|string> $items
     *
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeItems(array $items): array {
        $normalized = [];

        foreach ($items as $key => $item) {
            if (is_array($item)) {
                $label  = (string)($item['label'] ?? $item['text'] ?? '');
                $href   = (string)($item['href'] ?? '#!');
                $class  = (string)($item['class'] ?? '');
                $active = (bool)($item['active'] ?? false);
            } else {
                $label  = (string)$item;
                $href   = is_string($key) ? (string)$key : '#!';
                $class  = '';
                $active = false;
            }

            if ($label === '') {
                continue;
            }

            $normalized[] = [
                'label'  => $label,
                'href'   => $href,
                'class'  => trim($class),
                'active' => $active,
            ];
        }

        return $normalized;
    }

    /**
     * {@inheritDoc}
     */
    public static function script(): void {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            M.Sidenav.init(elems);
        });
        </script>
        <?php
    }
}
