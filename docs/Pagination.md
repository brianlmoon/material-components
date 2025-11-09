# Pagination

Materialize pagination component that renders navigation links with active/disabled states and icon support.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `list_class` | string | Classes applied to the `<ul>` element (defaults to `pagination`). |
| `aria_label` | string | Accessible label describing the pagination region. |
| `items` | array | Pagination entries. Each entry may define `label`, `href`, `active`, `disabled`, `icon`, `class`, `link_class`, `aria_label`, `tag`, `target`, and `data`. Strings may be used for labels with default links. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `container_tag` | string | Tag for the wrapper (defaults to `nav`). |
| `role` | string | ARIA role for the wrapper (defaults to `navigation`). |
| `id`, `class`, `data-*` | mixed | Standard component attributes. |

## Usage

```php
use Moonspot\MaterialComponents\Pagination;

Pagination::render(
    [
        'aria_label' => 'Pagination navigation',
        'items'      => [
            ['icon' => 'chevron_left', 'href' => '/page/1', 'aria_label' => 'Previous page', 'disabled' => true],
            ['label' => '1', 'href' => '/page/1', 'active' => true],
            ['label' => '2', 'href' => '/page/2'],
            ['icon' => 'chevron_right', 'href' => '/page/2', 'aria_label' => 'Next page'],
        ],
    ],
    [
        'id'    => 'docs-pagination',
        'class' => 'center-align',
    ]
);
```
