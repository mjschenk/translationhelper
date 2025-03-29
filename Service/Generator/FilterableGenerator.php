<?php

declare(strict_types=1);

namespace WebThings\TranslationHelper\Service\Generator;

use Magento\Setup\Module\I18n\Dictionary\Generator;
use Magento\Setup\Module\I18n\Dictionary\Options;
use Magento\Setup\Module\I18n\Factory;
use Magento\Setup\Module\I18n\ParserInterface;
use Magento\Framework\Module\Manager;
use WebThings\TranslationHelper\Service\Filter\FilterInterface;
use UnexpectedValueException;

/**
 * Class FilterableGenerator.
 *
 * @package WebThings\TranslationHelper\Service\Generator
 */
class FilterableGenerator extends Generator
{
    /**
     * @var Manager
     */
    protected $moduleManager;

    /**
     * @var FilterInterface[]
     */
    protected $filters;

    /**
     * FilterableGenerator constructor.
     *
     * @param ParserInterface $parser
     * @param ParserInterface $contextualParser
     * @param Factory $factory
     * @param Options\ResolverFactory $optionsResolver
     * @param array $filters
     */
    public function __construct(
        ParserInterface $parser,
        ParserInterface $contextualParser,
        Factory $factory,
        Options\ResolverFactory $optionsResolver,
        Manager $moduleManager,
        array $filters = [],

    ) {
        parent::__construct($parser, $contextualParser, $factory, $optionsResolver);
        $this->moduleManager = $moduleManager;
        $this->filters = $filters;
    }

    /**
     * Generate dictionary.
     *
     * @param string $directory
     * @param string $outputFilename
     * @param bool $withContext
     * @param array $filters
     * @throws UnexpectedValueException
     *
     * @return void
     */
    public function generate($directory, $outputFilename, $withContext = false, $filters = []): void
    {
        $optionResolver = $this->optionResolverFactory->create($directory, $withContext);

        $parser = $this->getActualParser($withContext);
        $parser->parse($optionResolver->getOptions());

        $phraseList = $this->applyFilters($parser->getPhrases(), $filters);

        if (!count($phraseList)) {
            throw new UnexpectedValueException('No phrases found in the specified dictionary file.');
        }
        foreach ($phraseList as $phrase) {
            $contextType = $phrase->getContextType();
            $contextValue = (array) $phrase->getContextValue();
            if ($contextType == 'module' && $contextValue) {
                $enabledModules = array_filter($contextValue, function ($moduleName) {
                    return $this->moduleManager->isEnabled($moduleName);
                });
                if (!empty($enabledModules)) {
                    $this->getDictionaryWriter($outputFilename)->write($phrase);
                }
            }
            else {
                $this->getDictionaryWriter($outputFilename)->write($phrase);
            }
        }
        $this->writer = null;
    }

    /**
     * Filter phrases.
     *
     * @param array $phraseList
     * @param array $filters
     *
     * @return array
     */
    protected function applyFilters(array $phraseList, array $filters): array
    {
        foreach ($this->filters as $filter) {
            $phraseList = $filter->apply($phraseList, $filters);
        }

        return $phraseList;
    }
}
