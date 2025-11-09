# Select

Materialize select component with label, helper text, and script initialization.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `value` | string | Currently selected option value. |
| `label` | string | Floating label text. |
| `wrapper_class` | string | Class applied to the `.input-field` wrapper. |
| `helper_text` | string | Helper copy rendered below the select. |
| `options` | array | Array of `['value' => '', 'text' => '']` option definitions. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `name` | string | Select name (defaults to id). |
| `disabled`, `readonly`, `required` | bool | Standard attributes passed through. |
| `id`, `class`, `data-*` | mixed | Inherited attributes. |

## Usage

```php
use Moonspot\MaterialComponents\Select;

Select::render(
    [
        'label'       => 'Plan',
        'helper_text' => 'Choose wisely.',
        'options'     => [
            ['value' => 'basic', 'text' => 'Basic'],
            ['value' => 'pro', 'text' => 'Pro'],
        ],
        'value'       => 'pro',
    ],
    [
        'id'   => 'plan-select',
        'name' => 'plan',
    ]
);
```
