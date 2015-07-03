<?php

namespace spec\TrigaBackend\RecordList;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DecoratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('TrigaBackend\RecordList\Decorator');
    }

    function it_should_decorate_selected_values()
    {
        $records = [
            (object)[
                'id' => 'foo',
                'name' => 'John',
            ],
        ];

        $this->registerFieldDecorator('name', function ($record)
        {
            return sprintf('%s-%s', $record->id, $record->name);
        });

        $result = $this->decorate($records);

        $result[0]->name->shouldBe('foo-John');
    }
}
