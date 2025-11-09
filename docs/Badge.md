# Badge

Materialize badge component for counts, notifications, or contextual labels.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `text` | string | Visible badge text content. |
| `color_class` | string | Materialize color class appended to the badge. |
| `caption` | string | Sets `data-badge-caption` for chip-style captions. |
| `auto_badge_class` | bool | When true (default) prepends the `badge` class. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `tag` | string | HTML tag used for the badge (`span` by default). |
| `is_new` | bool | Adds the `new` class. |
| `pulse` | bool | Adds the `pulse` animation class. |
| `align_left` / `align_right` | bool | Adds alignment helpers. |
| `id`, `class`, `data-*` | mixed | Standard component attributes. |

## Usage

```php
use Moonspot\MaterialComponents\Badge;

Badge::render(
    [
        'text'        => '4',
        'color_class' => 'red',
        'caption'     => 'notifications',
        'pulse'       => true,
    ],
    [
        'id'    => 'notification-badge',
        'class' => 'extra-class',
    ]
);
```
