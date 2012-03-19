<?php

namespace KapitchiContactIdentity\Model\Mapper;

use     KapitchiBase\Mapper\DbAdapterMapper,
        KapitchiBase\Model\ModelAbstract,
        KapitchiContactIdentity\Model\Mapper\ContactIdentity as Mapper,
        KapitchiContactIdentity\Model\ContactIdentity as Model;

class ContactIdentityZendDb extends DbAdapterMapper implements Mapper {
    protected $tableName = 'contact_identity';
    
    public function persist(ModelAbstract $model) {
        if($model->getId()) {
            $ret = $this->update($model);
        }
        else {
            $ret = $this->insert($model);
        }
        
        return $ret;
    }
    
    protected function insert(ModelAbstract $model) {
        $table = $this->getContactIdentityTable();
        
        $data = $model->toArray();
        
        $ret = $table->insert($data);
        $model->setId((int)$table->getLastInsertId());
        
        return $ret;
    }
    
    protected function update(ModelAbstract $model) {
        $table = $this->getContactIdentityTable();
        
        $data = $model->toArray();
        $ret = $table->update($data, array('id' => $model->getId()));
        
        return $ret;
    }
    
    public function findByPriKey($priKey) {
        $table = $this->getContactIdentityTable();
        $result = $table->select(array('id' => $priKey));
        $data = $result->current();
        if(!$data) {
            return null;
        }
        $model = Model::fromArray($data->getArrayCopy());
        return $model;
    }
    
    public function getPaginatorAdapter(array $params) {
        var_dump($params);
        exit;
    }
    
//    public function findByIdentityId($identityId) {
//        $table = $this->getTableGateway($this->tableName);
//        $result = $table->select(array('identityId' => $identityId));
//        $data = $result->current();
//        if(!$data) {
//            return null;
//        }
//        $model = ContactModel::fromArray($data->getArrayCopy());
//        return $model;
//    }
    
    public function remove(ModelAbstract $contact) {
        var_dump($contact);
        exit;
    }
    
    protected function getContactIdentityTable() {
        return $this->getTableGateway($this->tableName);
    }
    
    public function findByContactId($id) {
        $table = $this->getContactIdentityTable();
        $result = $table->select(array('contactId' => $id));
        $data = $result->current();
        if(!$data) {
            return null;
        }
        $model = Model::fromArray($data);
        return $model;
    }
    
    public function findByIdentityId($identityId) {
        $table = $this->getContactIdentityTable();
        $result = $table->select(array('identityId' => $identityId));
        $data = $result->current();
        if(!$data) {
            return null;
        }
        $model = Model::fromArray($data->getArrayCopy());
        return $model;
    }
}