# Icon

Materialize icon wrapper for the `material-icons` font.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `name` | string | Icon name/text rendered inside the `<i>`. |
| `size` | string | Optional size class (`tiny`, `small`, `medium`, `large`). |
| `side` | string | Adds alignment helper such as `left` or `right`. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `id`, `class`, `data-*` | mixed | Standard attributes combined with Materialize classes. |

## Usage

```php
use Moonspot\MaterialComponents\Icon;

Icon::render(
    [
        'name' => 'menu',
        'side' => 'right',
    ],
    [
        'id'    => 'nav-icon',
        'class' => 'blue-text',
    ]
);
```
