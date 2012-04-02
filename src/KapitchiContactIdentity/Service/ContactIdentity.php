<?php

namespace KapitchiContactIdentity\Service;

use ZfcBase\Service\ModelServiceAbstract,
    KapitchiContactIdentity\Model\ContactIdentity as ContactIdentityModel;

class ContactIdentity extends ModelServiceAbstract {
    protected function attachDefaultListeners() {
        parent::attachDefaultListeners();
        
        $instance = $this;
        $events = $this->events();
        $mapper = $this->getMapper();
        
        //get
        $events->attach('get.load', function($e) use ($mapper) {
            if($e->getParam('identityId')) {
                return $mapper->findByIdentityId($e->getParam('identityId'));
            }
        });
    }
}