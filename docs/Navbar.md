# Navbar

Responsive Materialize navigation bar with optional fixed positioning and mobile sidenav trigger.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `brand_text` | string | Logo/brand text rendered in `.brand-logo`. |
| `brand_href` | string | URL for the brand link (default `#!`). |
| `wrapper_class` | string | Classes for the inner `.nav-wrapper` container. |
| `color_class` | string | Additional classes appended to `<nav>`. |
| `fixed` | bool | Wraps the nav with `.navbar-fixed`. |
| `show_mobile_trigger` | bool | Toggles the sidenav trigger icon when mobile items exist. |
| `sidenav_id` | string | Overrides the auto-generated sidenav id. |
| `menu_items` | array | Desktop links; accepts strings or arrays with `label`, `href`, `class`, `active`. |
| `mobile_items` | array | Mobile sidenav links; defaults to `menu_items`. |
| `menu_alignment` | string | Classes for the desktop `<ul>` (default `right hide-on-med-and-down`). |
| `mobile_trigger_class` | string | Trigger link classes (default `sidenav-trigger`). |
| `mobile_trigger_icon` | string | Material icon text for the trigger (default `menu`). |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `role` | string | Applies WAI-ARIA role to `<nav>` (defaults to `navigation`). |
| `id`, `class`, `data-*` | mixed | Standard component attributes inherited from the base class. |

## Usage

```php
use Moonspot\MaterialComponents\Navbar;

Navbar::render(
    [
        'brand_text'    => 'Material Docs',
        'brand_href'    => '/',
        'color_class'   => 'teal',
        'menu_items'    => [
            ['label' => 'Components', 'href' => '/components', 'active' => true],
            ['label' => 'CSS', 'href' => '/css'],
        ],
        'mobile_items'  => [
            ['label' => 'Components', 'href' => '/components'],
            'Support',
        ],
        'fixed'         => true,
    ],
    [
        'id'    => 'docs-navbar',
        'class' => 'shadowless',
    ]
);
```
