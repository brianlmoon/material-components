# TextInput

Materialize text input component for single-line fields with helper text.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `label` | string | Floating label text. |
| `wrapper_class` | string | Class for the `.input-field` wrapper. |
| `helper_text` | string | Helper copy below the input. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `name` | string | Input name (defaults to id). |
| `type` | string | Input type (default `text`). |
| `value` | string | Default value. |
| `disabled`, `readonly`, `required` | bool | Standard attributes. |
| `minlength`, `maxlength`, `min`, `max` | int\|null | Validation limits. |
| `pattern` | string | Regex pattern. |
| `placeholder` | string | Placeholder text. |
| `id`, `class`, `data-*` | mixed | Inherited attributes. |

## Usage

```php
use Moonspot\MaterialComponents\TextInput;

TextInput::render(
    [
        'label'       => 'Email',
        'helper_text' => 'We never share your email.',
    ],
    [
        'id'       => 'email',
        'name'     => 'email',
        'type'     => 'email',
        'required' => true,
    ]
);
```
