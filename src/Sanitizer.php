<?php

namespace Peeyush\Sanitizer;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Validation\ClosureValidationRule;
use Illuminate\Validation\ValidationRuleParser;
use InvalidArgumentException;
use UnexpectedValueException;
use Peeyush\Sanitizer\Contracts\Filter;

class Sanitizer
{
    /**
     * Data to sanitize.
     *
     * @var array
     */
    protected $data;

    /**
     * Filters to apply.
     *
     * @var array
     */
    protected $filters;

    /**
     * Available filters as [name => classPath].
     *
     * @var array
     */
    protected $availableFilters = [
        'capitalize' => \Peeyush\Sanitizer\Filters\Capitalize::class,
        'cast' => \Peeyush\Sanitizer\Filters\Cast::class,
        'escape' => \Peeyush\Sanitizer\Filters\EscapeHTML::class,
        'format_date' => \Peeyush\Sanitizer\Filters\FormatDate::class,
        'lowercase' => \Peeyush\Sanitizer\Filters\Lowercase::class,
        'uppercase' => \Peeyush\Sanitizer\Filters\Uppercase::class,
        'trim' => \Peeyush\Sanitizer\Filters\Trim::class,
        'strip_tags' => \Peeyush\Sanitizer\Filters\StripTags::class,
        'digit' => \Peeyush\Sanitizer\Filters\Digit::class,
    ];

    /**
     * Create a new sanitizer instance.
     *
     * @param array $data
     * @param array $filters Filters to be applied to each data attribute
     */
    public function __construct(array $data, array $filters)
    {
        $this->data = $data;
        $this->filters = $this->parseFilters($filters);
    }

    /**
     * Register an array of custom filter extensions.
     *
     * @param array $extensions
     * @return void
     */
    public function addExtensions(array $extensions)
    {
        $this->availableFilters = array_merge($this->availableFilters, $extensions);
    }

    /**
     * Parse a filter array.
     *
     * @param array $filters
     * @return array
     */
    protected function parseFilters(array $filters)
    {
        $parsed = [];

        $rawRules = (new ValidationRuleParser($this->data))->explode($filters);

        foreach ($rawRules->rules as $attribute => $attributeRules) {
            foreach (array_filter($attributeRules) as $attributeRule) {
                $parsed[$attribute][] = $this->parseFilter($attributeRule);
            }
        }

        return $parsed;
    }

    /**
     * Parse a filter.
     *
     * @param string|Closure $filter
     * @throws InvalidArgumentException for unsupported filter type
     * @return array|Closure
     */
    protected function parseFilter($filter)
    {
        if (is_string($filter)) {
            return $this->parseFilterString($filter);
        } elseif ($filter instanceof ClosureValidationRule) {
            return $filter->callback;
        } else {
            throw new InvalidArgumentException("Unsupported filter type.");
        }
    }

    /**
     * Parse a filter string formatted as filterName:option1, option2 into an array formatted as [name => filterName, options => [option1, option2]]
     *
     * @param string $filter Formatted as 'filterName:option1, option2' or just 'filterName'
     * @throws InvalidArgumentException for empty filter string
     * @return array Formatted as [name => filterName, options => [option1, option2]]
     */
    protected function parseFilterString($filter)
    {
        if ('' == $filter) {
            throw new InvalidArgumentException("Invalid filter string.");
        }

        if (strpos($filter, ':') !== false) {
            list($name, $options) = explode(':', $filter, 2);
            $options = str_getcsv($options);
        } else {
            $name = $filter;
            $options = [];
        }

        return [
            'name' => $name,
            'options' => $options,
        ];
    }

    /**
     * Apply the given filter to the value.
     *
     * @param array|Closure $filter
     * @param mixed $value
     * @return mixed
     */
    protected function applyFilter($filter, $value)
    {
        if ($filter instanceof Closure) {
            return call_user_func($filter, $value);
        }

        $name = $filter['name'];
        $options = $filter['options'];

        // If the filter does not exist, throw an Exception:
        if (!isset($this->availableFilters[$name])) {
            throw new InvalidArgumentException("Filter [$name] not found.");
        }

        $filter = $this->availableFilters[$name];

        if ($filter instanceof Closure) {
            return call_user_func_array($filter, [$value, $options]);
        } elseif (in_array(Filter::class, class_implements($filter))) {
            return (new $filter)->apply($value, $options);
        } else {
            throw new UnexpectedValueException("Invalid filter [$name] must be a Closure or a class implementing the Peeyush\Sanitizer\Contracts\Filter interface.");
        }
    }

    /**
     * Apply the given filters to the value.
     *
     * @param array $filters
     * @param mixed $value
     * @return mixed
     */
    protected function applyFilters(array $filters, $value)
    {
        foreach ($filters as $filter)
            $value = $this->applyFilter($filter, $value);

        return $value;
    }

    /**
     * Sanitize the given data.
     *
     * @return array
     */
    public function sanitize()
    {
        $sanitized = $this->data;

        foreach ($this->filters as $attr => $filters)
            if (Arr::has($sanitized, $attr))
                Arr::set($sanitized, $attr, $this->applyFilters($filters, Arr::get($sanitized, $attr)));

        return $sanitized;
    }
}
