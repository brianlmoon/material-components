# Collection

Materialize collection component for list groups, menus, and link lists.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `wrapper_class` | string | Base class applied to the wrapper (defaults to `collection`). |
| `header_tag` | string | Tag used when rendering header items (defaults to `h5`). |
| `items` | array | Collection entries. Items may define `label`, `href`, `class`, `active`, `disabled`, `avatar`, `avatar_alt`, `body`, `badge`, `badge_class`, `secondary`, `secondary_icon`, `secondary_href`, `secondary_class`, `header`, `divider`, or `type`. Strings are treated as labels with default links. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `tag` | string | HTML tag for the wrapper (`ul` by default). |
| `role` | string | ARIA role for the wrapper (defaults to `list`). |
| `id`, `class`, `data-*` | mixed | Standard component attributes. |

## Usage

```php
use Moonspot\MaterialComponents\Collection;

Collection::render(
    [
        'items' => [
            ['label' => 'Collections', 'header' => true],
            ['label' => 'Inbox', 'href' => '/inbox', 'badge' => '4', 'badge_class' => 'new'],
            [
                'label'          => 'Reports',
                'href'           => '/reports',
                'body'           => "Q1 summary\nUpdated weekly",
                'secondary_icon' => 'send',
                'secondary_href' => '/reports/share',
            ],
            ['divider' => true],
            [
                'label'      => 'Teal Avatars',
                'avatar'     => 'https://example.com/avatar.jpg',
                'body'       => 'Tap to view profile',
                'secondary'  => 'View',
                'secondary_href' => '/profile',
            ],
        ],
    ],
    [
        'id'    => 'dashboard-collection',
        'class' => 'z-depth-1',
    ]
);
```
