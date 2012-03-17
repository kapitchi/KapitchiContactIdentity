<?php

namespace KapitchiContactIdentity\Service;

use KapitchiBase\Service\ServiceAbstract,
    KapitchiContactIdentity\Model\ContactIdentity as ContactIdentityModel;

class ContactIdentity extends ServiceAbstract {
    protected $mapper;
    
    public function get(array $filter) {
        //TODO
        $identityId = $filter['identityId'];
        
        $model = $this->getMapper()->findByIdentityId($identityId);
        return $model;
    }
    
    public function persist(array $params) {
        foreach(array(
            'identityId',
            'contactId',
            ) as $param) {
            if(empty($params[$param])) {
                throw new \InvalidArgumentException("Required param '$param'");
            }
        }
        
        $model = new ContactIdentityModel();
        $model->setContactId($params['contactId']);
        $model->setIdentityId($params['identityId']);
        
        $this->getMapper()->persist($model);
        
        return $model;
    }
    
    public function getMapper() {
        return $this->mapper;
    }

    public function setMapper($mapper) {
        $this->mapper = $mapper;
    }

}