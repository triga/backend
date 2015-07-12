<?php namespace spec\TrigaBackend\Breadcrumbs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ItemSpec extends ObjectBehavior
{
    protected $title = 'Foo bar';
    protected $url = 'http://foo.bar';
    protected $icon = 'fa-foo-icon';

    function let()
    {
        $this->beConstructedWith($this->title, $this->url, $this->icon);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TrigaBackend\Breadcrumbs\Item');
    }

    function it_should_have_proper_getters()
    {
        $this->isCurrent()->shouldBe(true);

        $this->setAsCurrent(false);

        $this->isCurrent()->shouldBe(false);

        $this->getTitle()->shouldBe($this->title);
        $this->getUrl()->shouldBe($this->url);
        $this->getIcon()->shouldBe($this->icon);
    }
}
