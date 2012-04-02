<?php

namespace KapitchiContactIdentity;

use Zend\Module\Manager,
    Zend\Mvc\AppContext as Application,
    KapitchiBase\Module\ModuleAbstract;

class Module extends ModuleAbstract
{
    public function bootstrap(Manager $moduleManager, Application $app) {
        $locator      = $app->getLocator();
    }
    
    public function getDir() {
        return __DIR__;
    }
    
    public function getNamespace() {
        return __NAMESPACE__;
    }
}
