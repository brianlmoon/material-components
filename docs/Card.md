# Card

Materialize stacked card component with optional image header and actions.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `title` | string | Optional title rendered inside `.card-content`. |
| `color` | string | Text color modifier (default `black`). |
| `background_color` | string | Background CSS class appended to the outer card. |
| `image` | string | URL for a top banner image. |
| `content` | string\|array\|\Closure | Display content; closures are executed during render. |
| `actions` | array | Array of `['href' => '', 'text' => '']` links shown in `.card-action`. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `id`, `class`, `data-*` | mixed | Standard component attributes. |

## Usage

```php
use Moonspot\MaterialComponents\Card;

Card::render(
    [
        'title'            => 'Starter Kit',
        'color'            => 'teal',
        'background_color' => 'grey lighten-4',
        'image'            => 'https://example.com/kit.jpg',
        'content'          => 'Build interfaces faster.',
        'actions'          => [
            ['href' => '#learn', 'text' => 'Learn More'],
            ['href' => '#buy', 'text' => 'Buy Now'],
        ],
    ],
    [
        'id'    => 'starter-card',
        'class' => 'z-depth-2',
    ]
);
```
