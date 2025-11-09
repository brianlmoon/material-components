# Radio

Materialize radio button group supporting helper text and mobile-friendly markup.

## Settings

| Setting | Type | Description |
| --- | --- | --- |
| `label` | string | Optional heading displayed above the group. |
| `wrapper_class` | string | Class applied to the outer `.radio-group` div. |
| `helper_text` | string | Group-level helper text below all options. |
| `options` | array | Option definitions; accepts strings or arrays with `label`, `value`, `helper_text`, `class`, `id`, `disabled`, `checked`. |

## Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| `name` | string | Shared name attribute (defaults to id). |
| `type` | string | Always `radio`. |
| `value` | string | Selected value for matching options. |
| `disabled`, `required` | bool | Affect all radios (required applied to first input). |
| `class` | string | Base class merged with option-specific classes. |

## Usage

```php
use Moonspot\MaterialComponents\Radio;

Radio::render(
    [
        'label'       => 'Choose a plan',
        'helper_text' => 'Pick the option that fits best.',
        'options'     => [
            ['label' => 'Basic', 'value' => 'basic', 'helper_text' => 'Essential features'],
            ['label' => 'Premium', 'value' => 'premium'],
            ['label' => 'Enterprise', 'value' => 'enterprise', 'disabled' => true],
        ],
    ],
    [
        'id'       => 'plan-radio',
        'name'     => 'plan',
        'value'    => 'premium',
        'class'    => 'with-gap',
        'required' => true,
    ]
);
```
