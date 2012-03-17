<?php

namespace KapitchiContactIdentity\Model\Mapper;

use     KapitchiBase\Mapper\DbAdapterMapper,
        KapitchiContactIdentity\Model\Mapper\ContactIdentity as ContactIdentityMapper,
        KapitchiContactIdentity\Model\ContactIdentity as ContactIdentityModel;

class ContactIdentityZendDb extends DbAdapterMapper implements ContactIdentityMapper {
    protected $tableName = 'contact_identity';
    
    public function persist(ContactIdentityModel $contactIdentity) {
        var_dump($contact);
        exit;
    }
    
    public function findByContactId($id) {
        $table = $this->getTableGateway($this->tableName);
        $result = $table->select(array('contactId' => $id));
        $data = $result->current();
        if(!$data) {
            return null;
        }
        $model = ContactIdentityModel::fromArray($data);
        return $model;
    }
    
    public function findByIdentityId($identityId) {
        $table = $this->getTableGateway($this->tableName);
        $result = $table->select(array('identityId' => $identityId));
        $data = $result->current();
        if(!$data) {
            return null;
        }
        $model = ContactIdentityModel::fromArray($data->getArrayCopy());
        return $model;
    }
    
    public function remove(ContactIdentityModel $contact) {
        
    }
}