<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use InvalidArgumentException;

class BackedEnum implements CastsAttributes
{
    protected string $enumClass;

    public function __construct(string $enumClass)
    {
        $enumClass = "App\\Enums\\" . $enumClass;

        if (!enum_exists($enumClass)) {
            throw new InvalidArgumentException("The given class {$enumClass} is not a valid backed enum.");
        }

        $this->enumClass = $enumClass;
    }

    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): object
    {
        $enum = $this->enumClass::from($value);

        return (object)[
            'case' => $enum->name,
            'name' => Str::lower(str_replace('_', ' ', $enum->name)),
            'value' => $enum->value,
        ];
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
