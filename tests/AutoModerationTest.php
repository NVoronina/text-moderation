<?php

namespace Moderation;

use Moderation\Store\StopWordsStore;

class ModerationTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \Moderation\Store\StopWordsStore */
    private $stopWordsMock;

    /** @var  Moderation */
    private $autoCensor;

    public function setUp()
    {
        parent::setUp();
        $this->stopWordsMock = new StopWordsStore(['жопа', 'хрень', 'хрени'], 'ru');
        $this->autoCensor = new Moderation();
        $this->autoCensor->addStopWordsStore($this->stopWordsMock);
    }

    public function testModerateText()
    {
        $enterString = 'Вот же хрень, это полная жопа. Как же найти в этой хрени ясность';
        $result = $this->autoCensor->moderateText($enterString);
        $this->assertEquals('Вот же *****, это полная ****. Как же найти в этой ***** ясность', $result);
        $this->assertEquals(mb_strlen($enterString), mb_strlen($result));
    }
}
