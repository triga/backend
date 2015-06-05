<?php

namespace spec\TrigaBackend\RecordList;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TrigaBackend\RecordList\QueryBuilder;
use TrigaBackend\RecordList\Filter;
use TrigaBackend\RecordList\Sorting;
use TrigaBackend\RecordList\Url;
use Illuminate\View\Factory as View;

class RecordListSpec extends ObjectBehavior
{
    function let(QueryBuilder $queryBuilder, Filter $filterManager, Sorting $sorting, Url $url, View $view)
    {
        $this->beConstructedWith($queryBuilder, $filterManager, $sorting, $url, $view);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TrigaBackend\RecordList\RecordList');
        $this->shouldHaveType('TrigaBackend\Contract\RenderInterface');
    }

    public function it_should_allow_to_set_custom_view()
    {
        $this->setViewPath('foo.bar');

        $this->getViewPath()->shouldBe('foo.bar');
    }
}
