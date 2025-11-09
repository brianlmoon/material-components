# Checkbox

Materialize checkbox component supporting helper text and `filled-in` styling.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `label` | string | Text displayed next to the checkbox. |
| `wrapper_class` | string | Class applied to the surrounding `<p>`. |
| `helper_text` | string | Helper copy rendered below the control. |
| `filled_in` | bool | Adds Materialize `filled-in` variant. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `name` | string | Input name (defaults to id). |
| `type` | string | Always forced to `checkbox`. |
| `value` | string | Submitted value (default `1`). |
| `checked` | bool | Pre-checks the control. |
| `disabled`, `required` | bool | Standard input attributes. |

## Usage

```php
use Moonspot\MaterialComponents\Checkbox;

Checkbox::render(
    [
        'label'       => 'Subscribe',
        'helper_text' => 'Email me updates',
        'filled_in'   => true,
    ],
    [
        'id'      => 'subscribe',
        'name'    => 'subscribe',
        'checked' => true,
    ]
);
```
