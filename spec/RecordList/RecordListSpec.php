<?php

namespace spec\TrigaBackend\RecordList;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TrigaBackend\RecordList\Paginator;
use TrigaBackend\RecordList\QueryBuilder;
use TrigaBackend\RecordList\Filter;
use TrigaBackend\RecordList\Sorting;
use TrigaBackend\RecordList\Url;
use Illuminate\View\Factory as View;

class RecordListSpec extends ObjectBehavior
{
    function let(QueryBuilder $queryBuilder, Filter $filterManager, Sorting $sorting, Url $url, View $view, Paginator $paginator)
    {
        $this->beConstructedWith($queryBuilder, $filterManager, $sorting, $url, $view, $paginator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TrigaBackend\RecordList\RecordList');
        $this->shouldHaveType('TrigaBackend\Contract\RenderInterface');
    }

    function it_should_allow_to_set_custom_view()
    {
        $this->setViewPath('foo.bar');

        $this->getViewPath()->shouldBe('foo.bar');
    }

    function it_should_register_filters(Filter $filterManager)
    {
        $callbackFoo = function () {};
        $callbackBar = function () {};

        $filterManager->registerFilter('foo', $callbackFoo)->shouldBeCalled();
        $filterManager->registerFilter('bar', $callbackBar)->shouldBeCalled();

        $this->filter('foo', $callbackFoo);
        $this->filter('bar', $callbackBar);
    }
}
