<?php namespace spec\TrigaBackend\Breadcrumbs;

use Illuminate\Routing\Route;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Router;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BreadcrumbsSpec extends ObjectBehavior
{
    function let(Router $router)
    {
        $this->beConstructedWith($router);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TrigaBackend\Breadcrumbs\Breadcrumbs');
    }

    function it_should_fetch_routes_by_names(Router $router, RouteCollection $routeCollection, Route $route1, Route $route2)
    {
        $route1->uri()->willReturn($fooUrl = 'http://dummy.com/foo');
        $route2->uri()->willReturn($barUrl = 'http://dummy.com/foo/bar');

        $routeCollection->getByName('foo')->shouldBeCalled()->willReturn($route1);
        $routeCollection->getByName('bar')->shouldBeCalled()->willReturn($route2);

        $router->getRoutes()->shouldBeCalled()->willReturn($routeCollection);

        $this->setRoute('foo');
        $this->setRoute('bar');

        $expected = [
            'foo' => $fooUrl,
            'bar' => $barUrl,
        ];

        $this->getRegisteredRoutes()->shouldReturn($expected);
    }

    function it_should_throw_exception_when_registering_non_existing_route()
    {

    }

    function it_should_handle_routes_with_params()
    {

    }
}
