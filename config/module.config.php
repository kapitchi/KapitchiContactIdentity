<?php
return array(
    'di' => array(
        'instance' => array(
            //services
            'KapitchiContactIdentity\Service\ContactIdentity' => array(
                'parameters' => array(
                    'mapper' => 'KapitchiContactIdentity\Model\Mapper\ContactIdentityZendDb'
                )
            ),
            
            //mapper
            'KapitchiContactIdentity\Model\Mapper\ContactIdentityZendDb' => array(
                'parameters' => array(
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                ),
            ),
        ),
    ),
);
