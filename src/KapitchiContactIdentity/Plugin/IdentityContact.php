<?php

namespace KapitchiContactIdentity\Plugin;

use ZfcBase\Model\ModelAbstract,
    KapitchiBase\Plugin\ModelPlugin;

class IdentityContact extends ModelPlugin {
    protected $modelServiceClass = 'KapitchiIdentity\Service\Identity';
    protected $modelFormClass = 'KapitchiIdentity\Form\Identity';
    protected $extName = 'Contact';
    
    public function getModel(ModelAbstract $model) {
        $service = $this->getLocator()->get('KapitchiContactIdentity\Service\ContactIdentity');
        $contactIdentity = $service->get(array(
            'identityId' => $model->getId()
        ));
        
        $service = $this->getLocator()->get('KapitchiContact\Service\Contact');
        $contact = $service->get(array(
            'priKey' => $contactIdentity->getContactId()
        ));
        
        return $contact;
    }
    
    public function getForm() {
        $form = $this->getLocator()->get('KapitchiContact\Form\Contact');
        return $form;
    }
    
    public function persistModel(ModelAbstract $model, array $data, $extData) {
        if(!empty($extData)) {
            $service = $this->getLocator()->get('KapitchiContact\Service\Contact');
            $ret = $service->persist($extData);
            $contact = $ret['model'];
            
            $contactIdentityService = $this->getLocator()->get('KapitchiContactIdentity\Service\ContactIdentity');
            try {
                $contactIdentity = $contactIdentityService->get(array(
                    'identityId' => $model->getId()
                ));
                if($contactIdentity->getContactId() != $contact->getId()) {
                    throw new Exception("Contact/identity mishmash!");
                }
            } catch(\ZfcBase\Service\Exception\ModelNotFoundException $e) {
                $contactIdentityService->persist(array(
                    'identityId' => $model->getId(),
                    'contactId' => $contact->getId(),
                ));
            }
            
            return $contact;
        }
    }
    
    public function removeModel(ModelAbstract $model) {
        var_dump($model);
        exit;
    }
    
}