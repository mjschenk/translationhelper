<?php

declare(strict_types=1);

namespace WebThings\TranslationHelper\Service\Filter;

/**
 * Interface FilterInterface.
 *
 * @package WebThings\TranslationHelper\Service\Filter
 */
interface FilterInterface
{
    /**
     * Apply specific filter to data.
     *
     * @param array $phrases
     * @param array $filters
     *
     * @return array
     */
    public function apply(array $phrases, array $filters): array;
}
