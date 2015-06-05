<?php

namespace spec\TrigaBackend\RecordList;

use Illuminate\Http\Request;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TrigaBackend\RecordList\Sorting;

class UrlSpec extends ObjectBehavior
{
    function let(Request $request)
    {
        $this->beConstructedWith($request);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TrigaBackend\RecordList\Url');
    }

    function it_should_append_sorting_data(Request $request)
    {
        $request->url()->willReturn('http://foo.dev');

        $expectedResult = sprintf('http://foo.dev/?%s=%s&%s=%s', Sorting::ORDER_BY_KEY, 'name', Sorting::ORDER_DIR_KEY, Sorting::ORDER_DESC);

        $this->get('name', Sorting::ORDER_DESC)->shouldReturn($expectedResult);
    }
}
