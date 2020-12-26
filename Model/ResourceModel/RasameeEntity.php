<?php
namespace Magenest\CodeOptimize\Model\ResourceModel;

use Magenest\CodeOptimize\Model\RasameeEntity as RasameeEntityModel;
use Magento\Eav\Model\Entity\AbstractEntity;

class RasameeEntity extends AbstractEntity
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_read =  'magenest_menu_read';
        $this->_write =     'magenest_menu_write';
    }

    /**
     * @inheritdoc
     */
    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(RasameeEntityModel::ENTITY);
        }

        return  parent::getEntityType();
    }
}
