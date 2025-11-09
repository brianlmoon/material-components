# Tabs

Materialize tabs component for switching between sections of content.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `tabs_class` | string | Classes applied to the `<ul>` containing the tabs (`tabs` is added by default). |
| `tab_item_class` | string | Extra classes appended to each `<li class="tab">`. |
| `items` | array | Tab definitions. Each tab supports `label`, `href`, `class`, `anchor_class`, `active`, `disabled`, `icon`, `icon_position`, `target`. Strings are treated as labels with default hrefs. |
| `content_sections` | array | Optional sections rendered underneath the tab list. Each section accepts `id`, `class`, and `content` (string or `callable`). |
| `content_class` | string | Default class for tab content containers (`col s12`). |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `container_tag` | string | Wrapper tag used for the component (defaults to `div`). |
| `role` | string | ARIA role for the wrapper (defaults to `navigation`). |
| `id`, `class`, `data-*` | mixed | Standard component attributes. |

## Usage

```php
use Moonspot\MaterialComponents\Tabs;

Tabs::render(
    [
        'items' => [
            ['label' => 'Overview', 'href' => '#overview', 'active' => true],
            ['label' => 'Usage', 'href' => '#usage'],
            ['label' => 'API', 'href' => '#api', 'disabled' => true],
        ],
        'content_sections' => [
            ['id' => 'overview', 'content' => 'Overview content'],
            ['id' => 'usage', 'content' => 'Usage details'],
            ['id' => 'api', 'content' => 'API docs'],
        ],
    ],
    [
        'id' => 'docs-tabs',
    ]
);
```
