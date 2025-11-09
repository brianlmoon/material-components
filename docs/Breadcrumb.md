# Breadcrumb

Materialize breadcrumb trail component for page navigation hierarchies.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `wrapper_class` | string | Classes for the inner `.nav-wrapper`. |
| `container_class` | string | Classes for the div wrapping breadcrumb links. |
| `items` | array | Breadcrumb entries; each accepts `label`, `href`, `class`, and `current`. Strings may be used for labels with implicit `#!` href. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `role` | string | ARIA role for the `<nav>` element (defaults to `navigation`). |
| `id`, `class`, `data-*` | mixed | Standard component attributes. |

## Usage

```php
use Moonspot\MaterialComponents\Breadcrumb;

Breadcrumb::render(
    [
        'items' => [
            ['label' => 'Home', 'href' => '/'],
            ['label' => 'Docs', 'href' => '/docs'],
            ['label' => 'Components', 'href' => '/docs/components', 'current' => true],
        ],
    ],
    [
        'id'    => 'docs-breadcrumbs',
        'class' => 'shadowless',
    ]
);
```
