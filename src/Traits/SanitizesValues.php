<?php

namespace Philcross\Itc\Traits;

trait SanitizesValues
{
    /**
     * @param null|string $value
     *
     * @return null|string
     */
    protected function sanitizeString(?string $value)
    {
        if (!$value) {
            return $value;
        }

        // Remove HTML tags, and the content within it
        $value = preg_replace('/<[^>]*>[^<]*<[^>]*>/im', '', $value);

        // Trim undesirable characters from the start and end of values
        $value = trim($value, ' "\'');

        return $value;
    }

    protected function sanitizeArray(?array $values)
    {
        if (!$values) {
            return $values;
        }

        return array_map(function ($value) {
            return $this->sanitizeString($value);
        }, $values);
    }
}
