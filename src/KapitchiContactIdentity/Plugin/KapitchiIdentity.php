<?php

namespace KapitchiContactIdentity\Plugin;

use Zend\Module\Manager,
    Zend\Mvc\AppContext as Application,
    Zend\EventManager\StaticEventManager,
    Zend\Di\Locator,
    KapitchiIdentity\Form\Identity as IdentityForm;;

class KapitchiIdentity  implements \Zend\Mvc\LocatorAware {
    protected $extName = 'KapitchiContact_Contact';
    
    public function bootstrap(Manager $moduleManager, Application $app) {
        $events = StaticEventManager::getInstance();
        $events->attach('KapitchiIdentity\Service\Identity', 'persist.post', array($this, 'createPost'));
        $events->attach('KapitchiIdentity\Service\Identity', 'persist.pre', array($this, 'createPre'));
        $events->attach('KapitchiIdentity\Service\Identity', array('get.ext.' . $this->extName, 'get.exts'), array($this, 'getIdentity'));
        $events->attach('di', 'newInstance', array($this, 'createForm'));
    }
    
    public function createPre($e) {
        //$params = $e->getParams();
        //$params['identity']->setCreated('xxx');
        return array();
    }
    
    public function getIdentity($e) {
        $identity = $e->getParam('model');
        $contactIdentityService = $this->getLocator()->get('KapitchiContactIdentity\Service\ContactIdentity');
        $model = $contactIdentityService->get(array(
            'identityId' => $identity->getId()
        ));
        
        if($model) {
            $contactService = $this->getLocator()->get('KapitchiContact\Service\Contact');
            $contact = $contactService->get(array(
                'priKey' => $model->getContactId()
            ));
            $identity->ext($this->extName, $contact);
        }
    }
    
    public function createPost($e) {
        $data = $e->getParam('data');
        if(!empty($data['ext'][$this->extName])) {
            $service = $this->getLocator()->get('KapitchiContact\Service\Contact');
            $ret = $service->persist($data['ext']['KapitchiContact_Contact']);
            $identity = $e->getParam('model');
            $identity->ext('KapitchiContact_Contact', $ret['model']);
            //return $ret;
        }
    }
    
    public function createForm($e) {
        $instance = $e->getParam('instance');
        if($instance instanceof IdentityForm) {
            $newForm = $this->getLocator()->get('KapitchiContact\Form\Contact');
            $instance->addExtSubForm($newForm, $this->extName);
        }
    }
    
    public function setLocator(Locator $locator) {
        $this->locator = $locator;
    }
    
    public function getLocator() {
        return $this->locator;
    }
}