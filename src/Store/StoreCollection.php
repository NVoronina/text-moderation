<?php

namespace Moderation\Store;


class StoreCollection
{
    /** @var  array */
    private $collection = [];

    /**
     * Add new object to collection
     * @param StopWordsStore $stopWordsStore
     */
    public function addToStoreCollection(StopWordsStore $stopWordsStore)
    {
        array_push($this->collection, $stopWordsStore);
    }
    /**
     * @return array
     */
    public function getCollection(): array
    {
        return $this->collection;
    }
}