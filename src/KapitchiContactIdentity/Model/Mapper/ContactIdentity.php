<?php

namespace KapitchiContactIdentity\Model\Mapper;

use     KapitchiBase\Mapper\ModelMapper;

interface ContactIdentity extends ModelMapper {
    public function findByContactId($id);
    public function findByIdentityId($id);
}