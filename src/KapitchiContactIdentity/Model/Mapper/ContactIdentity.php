<?php

namespace KapitchiContactIdentity\Model\Mapper;

use KapitchiContactIdentity\Model\ContactIdentity as ContactIdentityModel;

interface ContactIdentity {
    public function persist(ContactIdentityModel $model);
    public function remove(ContactIdentityModel $model);
    public function findByContactId($id);
    public function findByIdentityId($id);
    
}