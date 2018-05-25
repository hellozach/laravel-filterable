<?php
namespace HelloZach\LaravelFilterable\Traits;

trait Filterable
{
    public function scopeFilter($query, $filters)
    {
        if (empty($filters)) {
            return;
        }

        $filters = explode(',', urldecode($filters));
        
        foreach ($filters as $filter) {
            list($key, $value) = explode(':', $filter);
            $values = explode('|', $value);

            if (! empty($this->filterable) && ! in_array($key, $this->filterable)) {
                continue;
            }

            $values = array_map(function ($value) use ($key) {
                if (isset($this->filterableCasts[ $key ])) {
                    $func = $this->filterableCasts[ $key ];
                    return $this->$func($value);
                }

                return $value;
            }, $values);

            $operator = '=';

            if (count($values) > 1) {
                $query->whereIn($key, $values);
                continue;
            }

            if (strpos($key, 'min_') === 0) {
                $operator = '>=';
                $key = str_replace('min_', '', $key);
            } else if (strpos($key, 'max_') === 0) {
                $operator = '<=';
                $key = str_replace('max_', '', $key);
            }

            $query->where($key, $operator, $values[0]);
        }

        return $query;
    }
}
