<?php namespace spec\TrigaBackend\Breadcrumbs;

use Illuminate\Routing\Route;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Router;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BreadcrumbsSpec extends ObjectBehavior
{
    function let(Router $router, RouteCollection $routeCollection)
    {
        $this->beConstructedWith($router);

        $router->getRoutes()->shouldBeCalled()->willReturn($routeCollection);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TrigaBackend\Breadcrumbs\Breadcrumbs');
    }

    function it_should_fetch_routes_by_names(RouteCollection $routeCollection, Route $route1, Route $route2)
    {
        $route1->uri()->willReturn($fooUrl = 'http://dummy.com/foo');
        $route2->uri()->willReturn($barUrl = 'http://dummy.com/foo/bar');

        $routeCollection->getByName('foo')->shouldBeCalled()->willReturn($route1);
        $routeCollection->getByName('bar')->shouldBeCalled()->willReturn($route2);

        $this->setRoute('foo');
        $this->setRoute('bar');

        $expected = [
            'foo' => $fooUrl,
            'bar' => $barUrl,
        ];

        $this->getRegisteredRoutes()->shouldReturn($expected);
    }

    function it_should_throw_exception_when_registering_non_existing_route(RouteCollection $routeCollection)
    {
        $routeCollection->getByName('non-existing')->shouldBeCalled()->willReturn(null);

        $this->setRoute('non-existing');

        $this->shouldThrow(\InvalidArgumentException::class)->during('getRegisteredRoutes');
    }

    function it_should_handle_routes_with_params()
    {

    }
}
