<?php

namespace Moderation\Store;

class StopWordsStoreTest extends \PHPUnit_Framework_TestCase
{
    public function testGetStopWordsStore()
    {
        $objFirst = new StopWordsStore(['жопа', 'хрень'], 'ru');
        $objSecond = new StopWordsStore();
        $objThird = new StopWordsStore([], '');

        $this->assertEquals(['жопа', 'хрень'], $objFirst->getStopWords());
        $this->assertEquals('ru', $objFirst->getLocalization());

        $this->assertEquals([], $objSecond->getStopWords());
        $this->assertEquals('none', $objSecond->getLocalization());

        $this->assertEquals([], $objThird->getStopWords());
        $this->assertEquals('none', $objThird->getLocalization());
    }
}
