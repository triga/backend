<?php

namespace spec\TrigaBackend\RecordList;

use Illuminate\Http\Request;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SortingSpec extends ObjectBehavior
{
    function let(Request $request)
    {
        $this->beConstructedWith($request);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TrigaBackend\RecordList\Sorting');
    }

    function it_should_return_the_current_sorting_direction(Request $request)
    {
        $request->get('order_dir')->willReturn('DESC');

        $this->getOrderDir()->shouldReturn('desc');

        $request->get('order_dir')->willReturn('asc');

        $this->getOrderDir()->shouldReturn('asc');
    }

    function it_should_return_default_sorting_dir_if_not_set(Request $request)
    {
        $request->get('order_dir')->willReturn(null);

        $this->getOrderDir()->shouldReturn('asc');
    }

    function it_should_return_default_sorting_dir_if_set_invalid(Request $request)
    {
        $request->get('order_dir')->willReturn('foo+bar');

        $this->getOrderDir()->shouldReturn('asc');
    }

    function it_should_return_the_opposite_sorting_dir(Request $request)
    {
        $request->get('order_dir')->willReturn('desc');

        $this->getOppositeOrderDir()->shouldReturn('asc');

        $request->get('order_dir')->willReturn('asc');

        $this->getOppositeOrderDir()->shouldReturn('desc');
    }

    function it_should_return_the_current_sorting_column(Request $request)
    {
        $request->get('order_by')->willReturn('email');

        $this->getOrderColumn()->shouldReturn('email');
    }

    function it_should_return_the_default_sorting_column_if_not_set(Request $request)
    {
        $request->get('order_by')->willReturn(null);

        $this->getOrderColumn()->shouldReturn('id');
    }
}
