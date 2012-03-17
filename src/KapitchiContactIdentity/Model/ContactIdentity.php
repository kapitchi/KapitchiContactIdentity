<?php

namespace KapitchiContactIdentity\Model;

use KapitchiBase\Model\ModelAbstract;

class ContactIdentity extends ModelAbstract {
    protected $identityId;
    protected $contactId;
    
    public function getIdentityId() {
        return $this->identityId;
    }

    public function setIdentityId($identityId) {
        $this->identityId = $identityId;
    }

    public function getContactId() {
        return $this->contactId;
    }

    public function setContactId($contactId) {
        $this->contactId = $contactId;
    }

}