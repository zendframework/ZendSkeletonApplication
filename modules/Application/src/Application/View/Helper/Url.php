<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zend\Mvc\Router\RouteStack;

class Url extends AbstractHelper
{
    protected $router;

    public function setRouter(RouteStack $router)
    {
        $this->router = $router;
    }

    public function __invoke($params = array(), $options = array())
    {
        if (null === $this->router) {
            return '';
        }

        // Remove trailing '/index' from generated URLs.
        $url = $this->router->assemble($params, $options);
        if ((6 <= strlen($url)) && '/index' == substr($url, -6)) {
            $url = substr($url, 0, strlen($url) - 6);
        }

        return $url;
    }
}
