<?php

namespace Moderation;

use Moderation\Store\StopWordsStore;
use Moderation\Store\StoreCollection;

class Moderation
{

    /** @var StoreCollection  */
    private $stopWordsCollection;

    /**
     * Moderation constructor.
     */
    public function __construct()
    {
        $this->stopWordsCollection = new StoreCollection();
    }

    /**
     * Add StopWords for localization
     * @param StopWordsStore $stopWordsStore
     */
    public function addStopWordsStore(StopWordsStore $stopWordsStore): void
    {
        $this->stopWordsCollection->addToStoreCollection($stopWordsStore);
    }

    /**
     * Main moderate text method
     * @param string $text
     * @param string $replaceTo
     * @return string
     */
    public function moderateText(string $text, string $replaceTo = '*'): string
    {
        if ($this->stopWordsCollection === []) {
            return $text;
        }
        $foundWords = $this->findStopWords($text, true);
        if ($foundWords !== []) {
            $text = $this->replaceWorld($foundWords, $text, $replaceTo);
        }
        return $text;
    }

    /**
     * @param array $foundWords
     * @param string $text
     * @param string $replaceTo
     * @return string
     */
    private function replaceWorld(array $foundWords, string $text, string $replaceTo = '*'): string
    {
        $foundWordsCount = count($foundWords);
        for($i = 0; $i < $foundWordsCount; $i++) {
            if (is_array($foundWords[$i])) {
                $text = preg_replace("/{$foundWords[$i][0]}/", str_pad('', mb_strlen($foundWords[$i]), $replaceTo), $text);
            } else {
                $text = preg_replace("/{$foundWords[$i]}/", str_pad('', mb_strlen($foundWords[$i]), $replaceTo), $text);
            }
        }
        return $text;
    }

    /**
     * @param string $text
     * @param bool $findOffset
     * @return array
     */
    private function findStopWords(string $text, bool $findOffset = false): array
    {
        $collectionCount = count($this->stopWordsCollection->getCollection());
        $regexpStr = '/';
        for($i = 0; $i < $collectionCount; $i++){
            /** @var StopWordsStore $stopWords */
            $stopWords = $this->stopWordsCollection->getCollection()[$i];
            $regexpStr .= implode('|', $stopWords->getStopWords());
        }
        if ($findOffset) {
            preg_match_all($regexpStr . '/i', $text, $resultArray, PREG_OFFSET_CAPTURE);
        } else {
            preg_match_all($regexpStr . '/i', $text, $resultArray);
        }
        return $resultArray[0] ?? [];
    }
}