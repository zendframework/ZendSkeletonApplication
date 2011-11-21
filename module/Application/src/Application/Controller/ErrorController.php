<?php

namespace Application\Controller;

use Zend\Mvc\Controller\ActionController;

class ErrorController extends ActionController
{
    const ERROR_NO_ROUTE = 404;
    const ERROR_NO_CONTROLLER = 404;

    public function indexAction()
    {
        $error = $this->request->getMetadata('error', false);
        if (!$error) {
            $error = array(
                'type'    => 404,
                'message' => 'Page not found',
            );
        }
        
        switch ($error['type']) {
            case self::ERROR_NO_ROUTE:
            case self::ERROR_NO_CONTROLLER:
            default:
                // 404 error -- controller or action not found
                $this->response->setStatusCode(404);
                break;
        }
        
        return array('message' => $error['message']);
    }
}
