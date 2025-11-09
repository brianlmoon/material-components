# Footer

Materialize footer component that renders the standard page footer layout with optional sections and copyright bar.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `wrapper_class` | string | Base class appended to the `<footer>` (defaults to `page-footer`). |
| `container_class` | string | Class for the content container inside the footer. |
| `section_row_class` | string | Class for the row wrapping section columns. |
| `sections` | array | List of column definitions, each supporting `title`, `title_class`, `content`, `content_class`, `column_class`, `links`, and `links_class`. |
| `copyright` | string | Text shown inside the lower copyright bar. |
| `right_links` | array | Links rendered to the right in the copyright bar; each link accepts `label`, `href`, and `class`. |
| `copyright_wrapper_class` | string | Class for the copyright wrapper div. |
| `copyright_container_class` | string | Class for the inner container. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `role` | string | ARIA role for the `<footer>` element (defaults to `contentinfo`). |
| `id`, `class`, `data-*` | mixed | Standard component attributes. |

## Usage

```php
use Moonspot\MaterialComponents\Footer;

Footer::render(
    [
        'sections' => [
            [
                'title'         => 'Footer Content',
                'title_class'   => 'white-text',
                'content'       => 'Build responsive pages faster.',
                'content_class' => 'grey-text text-lighten-4',
                'column_class'  => 'col l6 s12',
            ],
            [
                'title'        => 'Resources',
                'title_class'  => 'white-text',
                'column_class' => 'col l4 offset-l2 s12',
                'links'        => [
                    ['label' => 'Docs', 'href' => '/docs', 'class' => 'grey-text text-lighten-3'],
                    ['label' => 'Blog', 'href' => '/blog', 'class' => 'grey-text text-lighten-3'],
                ],
            ],
        ],
        'copyright' => '© 2024 Moonspot',
        'right_links' => [
            ['label' => 'More Links', 'href' => '#more', 'class' => 'grey-text text-lighten-4 right'],
        ],
    ],
    [
        'id'    => 'docs-footer',
        'class' => 'grey darken-3',
    ]
);
```
