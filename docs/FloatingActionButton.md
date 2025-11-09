# Floating Action Button

Materialize floating action button (FAB) component for primary actions with optional secondary shortcuts.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `wrapper_class` | string | Base wrapper classes; `fixed-action-btn` is added automatically. |
| `horizontal` | bool | Adds `horizontal` class for sideways expansion. |
| `toolbar` | bool | Adds `toolbar` class for toolbar-styled FABs. |
| `button_size` | string | Main button size class (e.g. `btn-large`). |
| `button_color_class` | string | Color class for the trigger (e.g. `red`). |
| `button_class` | string | Additional classes for the trigger. |
| `button_tag` | string | Tag for the trigger (`a` or `button`). |
| `button_href` | string | Href for anchor triggers. |
| `button_text` | string | Optional text label inside the trigger. |
| `button_icon` | string | Material icon text for the trigger. |
| `button_icon_class` | string | Icon element class (`material-icons` by default). |
| `button_icon_component` | `Icon|null` | Optional icon component rendered instead of text. |
| `button_data` | array | Extra `data-*` attributes for the trigger. |
| `button_disabled` | bool | Disables the trigger. |
| `actions` | array | Secondary buttons; each action may define `href`, `tag`, `color_class`, `class`, `icon`, `icon_class`, `text`, `tooltip`, `tooltip_position`, `target`, `disabled`, and `data`. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `tag` | string | Wrapper tag (`div` by default). |
| `aria_label` | string | ARIA label for the wrapper. |
| `id`, `class`, `data-*` | mixed | Standard component attributes. |

## Usage

```php
use Moonspot\MaterialComponents\FloatingActionButton;

FloatingActionButton::render(
    [
        'button_icon'       => 'mode_edit',
        'button_icon_class' => 'large material-icons',
        'actions'           => [
            ['href' => '#chart', 'color_class' => 'red', 'icon' => 'insert_chart'],
            ['href' => '#quote', 'color_class' => 'yellow darken-1', 'icon' => 'format_quote'],
            ['href' => '#publish', 'color_class' => 'green', 'icon' => 'publish', 'tooltip' => 'Publish'],
            ['href' => '#attach', 'color_class' => 'blue', 'icon' => 'attach_file'],
        ],
    ],
    [
        'id'         => 'fab-compose',
        'aria_label' => 'Compose actions',
    ]
);
```
