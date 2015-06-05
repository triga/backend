<?php

namespace spec\TrigaBackend\RecordList;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FilterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('TrigaBackend\RecordList\Filter');
    }

    function it_should_register_filters()
    {
        $this->registerFilter('email', function ($query, $value) {
            $query->where('email', '=', $value);
        });

        $this->registerFilter('email', function ($query, $value) {
            $query->where('email', '!=', $value);
        });

        $this->registerFilter('name', function ($query, $value) {
            $query->where('name', '=', $value);
        });

        $this->getFilters()->shouldHaveCount(2);
        $this->getFilters()->shouldHaveKey('email');
        $this->getFilters()->shouldHaveKey('name');
    }
}
