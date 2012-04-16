<?php

namespace KapitchiContactIdentity\Model\Mapper;

use ZfcBase\Mapper\ModelMapperInterface;

interface ContactIdentityInterface extends ModelMapperInterface {
    public function findByContactId($id);
    public function findByIdentityId($id);
}