<?php namespace spec\TrigaBackend\Breadcrumbs;

use Illuminate\Routing\UrlGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TrigaBackend\Breadcrumbs\Item;

class BreadcrumbsSpec extends ObjectBehavior
{
    function let(UrlGenerator $urlGenerator)
    {
        $this->beConstructedWith($urlGenerator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TrigaBackend\Breadcrumbs\Breadcrumbs');
    }

    function it_should_register_routes(UrlGenerator $urlGenerator)
    {
        $fooUrl = 'http://dummy.com/foo';

        $urlGenerator->route('foo', [])->willReturn($fooUrl);

        $this->setRoute('foo', $title = 'Title foo');

        $expected = [
            new Item($title, $fooUrl),
        ];

        $this->getRoutes()->shouldBeLike($expected);
    }
}
