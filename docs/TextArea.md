# TextArea

Materialize textarea component with helper text and floating label support.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `value` | string | Default textarea contents. |
| `label` | string | Floating label text. |
| `wrapper_class` | string | Class applied to the `.input-field` wrapper. |
| `helper_text` | string | Helper copy rendered below the control. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `name` | string | Input name (defaults to id). |
| `disabled`, `readonly`, `required` | bool | Standard attributes. |
| `minlength`, `maxlength` | int\|null | Validation limits. |
| `placeholder` | string | Placeholder text. |
| `id`, `class`, `data-*` | mixed | Inherited attributes; component adds `materialize-textarea`. |

## Usage

```php
use Moonspot\MaterialComponents\TextArea;

TextArea::render(
    [
        'label'         => 'Description',
        'helper_text'   => 'Share more info.',
        'wrapper_class' => 'description-field',
        'value'         => "Line one\nLine two",
    ],
    [
        'id'        => 'description',
        'name'      => 'details',
        'maxlength' => 200,
    ]
);
```
