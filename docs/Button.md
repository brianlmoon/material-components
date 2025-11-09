# Button

Materialize button component that wraps the `btn` classes and optional icons.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `text` | string | Visible button label. |
| `color` | string | Materialize color class (e.g. `blue`). |
| `icon` | `Moonspot\MaterialComponents\Icon` | Optional icon rendered before the text. |
| `flat` | bool | Adds `btn-flat` class. |
| `size` | string | Size suffix (`small`, `large`, etc.). |
| `disabled` | bool | Adds the disabled attribute. |
| `href` | string | When set, renders an `<a>` instead of `<button>`. |
| `floating` | bool | Adds `btn-floating`. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `type` | string | Button type attribute (ignored when `href` present). |
| `id`, `class`, `data-*` | mixed | Inherited from `ComponentAbstract`. |

## Usage

```php
use Moonspot\MaterialComponents\Button;
use Moonspot\MaterialComponents\Icon;

$icon = new Icon(['name' => 'send', 'side' => 'left']);

Button::render(
    [
        'text'  => 'Send',
        'color' => 'teal',
        'icon'  => $icon,
        'size'  => 'large',
    ],
    [
        'id'   => 'send-btn',
        'type' => 'submit',
    ]
);
```
