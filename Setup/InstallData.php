<?php
namespace Magenest\CodeOptimize\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $rasameeEntityFactory;

    public function __construct(
        \Magenest\CodeOptimize\Setup\RasameeEntitySetupFactory $rasameeEntitySetupFactory
    ) {
        $this->rasameeEntityFactory = $rasameeEntitySetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $menuEntityEntity = \Magenest\CodeOptimize\Model\RasameeEntity::ENTITY;
        $menuEntitySetup = $this->rasameeEntityFactory->create(array('setup' => $setup));
        $menuEntitySetup->installEntities();
        $menuEntitySetup->addAttribute(
            $menuEntityEntity,
            'title',
            array('type' => 'varchar')
        );
        $menuEntitySetup->addAttribute(
            $menuEntityEntity,
            'level',
            array('type' => 'int')
        );
    }
}
