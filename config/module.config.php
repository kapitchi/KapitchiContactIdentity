<?php
return array(
    'KapitchiContactIdentity' => array(
        'plugin_broker' => array(
            'bootstrap_plugins' => array(
                'IdentityContact' => true,
                'Registration' => true,
            ),
            'specs' => array(
                'IdentityContact' => array(
                    
                ),
                'Registration' => array(
                    
                ),
            ),
        )
    ),
    'di' => array(
        'instance' => array(
            //services
            'KapitchiContactIdentity\Service\ContactIdentity' => array(
                'parameters' => array(
                    'mapper' => 'KapitchiContactIdentity\Model\Mapper\ContactIdentityDbAdapter',
                    'modelPrototype' => 'KapitchiContactIdentity\Model\ContactIdentity'
                )
            ),
            
            //mapper
            'KapitchiContactIdentity\Model\Mapper\ContactIdentityDbAdapter' => array(
                'parameters' => array(
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                ),
            ),
        ),
    ),
);
