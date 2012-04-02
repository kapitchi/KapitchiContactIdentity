<?php
return array(
    'KapitchiContactIdentity' => array(
        'options' => array(
            'plugins' => array(
                'IdentityContact' => array(
                    'class' => 'KapitchiContactIdentity\Plugin\IdentityContact',
                ),
                'Registration' => array(
                    'class' => 'KapitchiContactIdentity\Plugin\Registration',
                )
            )
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
