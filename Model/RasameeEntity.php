<?php
namespace Magenest\CodeOptimize\Model;

class RasameeEntity extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'Rasamee';

    /**
     * @inheritdoc
     */
    public function _construct()
    {
        $this->_init('Magenest\CodeOptimize\Model\ResourceModel\RasameeEntity');
    }
}
