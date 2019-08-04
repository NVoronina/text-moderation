<?php

namespace Moderation\Store;

class StopWordsStore
{
    const LOCALIZATION_NONE = 'none';
    /** @var  string */
    private $localization;
    /** @var  array */
    private $stopWords;

    /**
     * StopWordsStore constructor.
     * @param array $stopWords example ['bad', 'word', 'f*ck']
     * @param string $localization example 'en'
     */
    public function __construct(array $stopWords = [], string $localization = self::LOCALIZATION_NONE)
    {
        if ($localization === '') {
            $localization = self::LOCALIZATION_NONE;
        }
        $this->setLocalization($localization);
        $this->setStopWords($stopWords);
    }

    /**
     * @return string
     */
    public function getLocalization(): string
    {
        return $this->localization;
    }

    /**
     * @param string $localization
     */
    public function setLocalization(string $localization)
    {
        $this->localization = $localization;
    }

    /**
     * @return array
     */
    public function getStopWords(): array
    {
        return $this->stopWords;
    }

    /**
     * @param array $stopWords
     */
    public function setStopWords(array $stopWords)
    {
        $this->stopWords = $stopWords;
    }
}