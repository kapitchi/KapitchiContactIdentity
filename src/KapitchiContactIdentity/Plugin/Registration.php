<?php

namespace KapitchiContactIdentity\Plugin;

use ZfcBase\Model\ModelAbstract,
    KapitchiBase\Module\Plugin\ModelPlugin;

class Registration extends ModelPlugin {
    protected $modelServiceClass = 'KapitchiIdentity\Service\Registration';
    protected $modelFormClass = 'KapitchiIdentity\Form\Registration';
    protected $extName = 'Contact';
    
    public function getModel(ModelAbstract $model) {
        throw new \Exception('N/I');
        $service = $this->getLocator()->get('KapitchiContactIdentity\Service\ContactIdentity');
        $model = $service->get(array(
            'identityId' => $model->getId()
        ));
        
        $service = $this->getLocator()->get('KapitchiContact\Service\Contact');
        $model = $service->get(array(
            'id' => $model->getContactId()
        ));
        
        return $model;
    }
    
    public function getForm() {
        $form = $this->getLocator()->get('KapitchiContact\Form\ContactBasic');
        return $form;
    }
    
    public function persistModel(ModelAbstract $model, array $data, $extData) {
        if(!empty($extData)) {
            $service = $this->getLocator()->get('KapitchiContact\Service\Contact');
            $ret = $service->persist($extData);
            $contact = $ret['model'];
            
            $contactIdentityService = $this->getLocator()->get('KapitchiContactIdentity\Service\ContactIdentity');
            $contactIdentityService->persist(array(
                'identityId' => $model->ext('Identity')->getId(),
                'contactId' => $contact->getId(),
            ));
            
            return $contact;
        }
    }
    
    public function removeModel(ModelAbstract $model) {
        var_dump($model);
        exit;
    }
    
}