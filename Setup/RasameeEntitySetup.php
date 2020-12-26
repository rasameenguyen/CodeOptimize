<?php
namespace Magenest\CodeOptimize\Setup;

use Magento\Eav\Setup\EavSetup;

class RasameeEntitySetup extends EavSetup
{
    public function getDefaultEntities()
    {
        /*	#snippet1	*/
        $menuEntityEntity =     \Magenest\CodeOptimize\Model\RasameeEntity::ENTITY;
        $entities =     [
            $menuEntityEntity   =>  [
                'entity_model'  =>  'Magenest\CodeOptimize\Model\ResourceModel\RasameeEntity',
                'attributes'    =>  [
                    'id'   =>  [
                        'type'  =>  'static',
                    ],
                    'name'    =>  [
                        'type'  =>  'static',
                    ]
                ],
            ],
        ];
        return  $entities;
        //end
    }
}
