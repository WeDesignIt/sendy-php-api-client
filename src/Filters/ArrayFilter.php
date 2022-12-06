<?php

namespace WeDesignIt\Sendy\Filters;

class ArrayFilter implements \ArrayAccess {

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->filters;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->filters);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->filters[$offset] ?? null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->filters[$offset] = $value;
    }

    /**
     * @param string $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->filters[$offset]);
    }
}