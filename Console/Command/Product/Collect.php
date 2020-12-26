<?php
namespace Magenest\CodeOptimize\Console\Command\Product;

use Magenest\CodeOptimize\Model\RasameeEntityFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\State as StateAppFramework;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\Model\ResourceModel\Iterator as IteratorResourceModel;

/**
 * Class Collect
 * @package Magenest\CodeOptimize\Console\Command\Product
 */
class Collect extends Command
{
    const CLI_NAME = 'time:issue';
    const ISSUE_NUMBER = 'issue_number';
    const ISSUE_NUMBER_1 = 'issue1';
    const ISSUE_NUMBER_2 = 'issue2';
    const ISSUE_NUMBER_3 = 'issue3';
    const ISSUE_NUMBER_4 = 'issue4';
    const ISSUE_NUMBER_5 = 'issue5';
    const ISSUE_NUMBER_6 = 'issue6';


    /** @var StateAppFramework  */
    protected $appState;

    /** @var ProductRepositoryInterface  */
    protected $productRepository;

    /** @var ProductCollectionFactory  */
    protected $productCollectionFactory;

    protected $total = 0;

    /** @var IteratorResourceModel  */
    protected $_resourceIterator;

    /** @var RasameeEntityFactory  */
    protected $_rasameeEntityFactory;

    /**
     * Collect constructor.
     * @param StateAppFramework $appState
     * @param ProductRepositoryInterface $productRepository
     * @param ProductCollectionFactory $productCollectionFactory
     * @param IteratorResourceModel $resourceIterator
     * @param RasameeEntityFactory $rasameeEntityFactory
     * @param string|null $name
     */
    public function __construct(
        StateAppFramework $appState,
        ProductRepositoryInterface $productRepository,
        ProductCollectionFactory $productCollectionFactory,
        IteratorResourceModel $resourceIterator,
        RasameeEntityFactory $rasameeEntityFactory,
        string $name = null
    ) {
        $this->appState = $appState;
        $this->productRepository = $productRepository;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->_resourceIterator = $resourceIterator;
        $this->_rasameeEntityFactory = $rasameeEntityFactory;
        parent::__construct($name);
    }

    protected function configure()
    {
        $options = [
            new InputOption(
                self::ISSUE_NUMBER_1,
                null,
                InputOption::VALUE_NONE,
                'run issue number 1'
            ),
            new InputOption(
                self::ISSUE_NUMBER_2,
                null,
                InputOption::VALUE_NONE,
                'run issue number 2'
            ),
            new InputOption(
                self::ISSUE_NUMBER_3,
                null,
                InputOption::VALUE_NONE,
                'run issue number 3'
            ),
            new InputOption(
                self::ISSUE_NUMBER_4,
                null,
                InputOption::VALUE_NONE,
                'run issue number 4'
            ),
            new InputOption(
                self::ISSUE_NUMBER_5,
                null,
                InputOption::VALUE_NONE,
                'run issue number 5'
            ),
            new InputOption(
                self::ISSUE_NUMBER_6,
                null,
                InputOption::VALUE_NONE,
                'run issue number 6'
            )
        ];

        $this->setName(self::CLI_NAME)->setDescription('Run issue with number')->setDefinition($options);
        parent::configure();;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->appState->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);
            $output->writeln("Begin: ...");
            if($input->getOption(self::ISSUE_NUMBER_1)){
               $this->runIssues1($output);
            }
            if($input->getOption(self::ISSUE_NUMBER_2)){
                $this->runIssues2($output);
            }
            if($input->getOption(self::ISSUE_NUMBER_3)){
                $this->runIssues3($output);
            }
            if($input->getOption(self::ISSUE_NUMBER_4)){
                $this->runIssues4($output);
            }
            if($input->getOption(self::ISSUE_NUMBER_5)){
                $this->runIssues5($output);
            }
            if($input->getOption(self::ISSUE_NUMBER_6)){
                $this->runIssues6($output);
            }
            $output->writeln("Completed!");
        } catch (\Exception $exception){
            $output->writeln($exception->getMessage());
        }
    }

    /**
     * example about the count() function with for loop in php
     * @param $output
     * @throws \Exception
     */
    private function runIssues1($output)
    {
        try {
            $startTime = microtime(true);
            $productCollection = $this->productCollectionFactory->create();
            $productCollection->load();
            $count = 0;
//            $a = count($productCollection);
            for ($i = 0; $i < count($productCollection); $i++) {
                $count++;
            }
            $endTime = microtime(true);
            $time = $endTime - $startTime;
            $output->writeln("Execute time: ".$time);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * example about the Redundant data set utilization issue
     * @param $output
     * @throws \Exception
     */
    private function runIssues2($output)
    {
        try {
            $startTime = microtime(true);
//            $productCollection = $this->productCollectionFactory->create()->setPageSize(1)->setCurPage(1)->getFirstItem();
            $productCollection = $this->productCollectionFactory->create()->getFirstItem();
            $productCollection->getSku();
            $endTime = microtime(true);
            $time = $endTime - $startTime;
            $output->writeln("Execute time issue 2: ".$time);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param $output
     * @throws \Exception
     */
    private function runIssues3($output)
    {
        try {
            $startTime = microtime(true);
            $productCollection = $this->productCollectionFactory->create();
            $count = 0;
            foreach ($productCollection as $product) {
                $count++;
            }
            $endTime = microtime(true);
            $time = $endTime - $startTime;
            $output->writeln("Execute time issue 3: ".$time);
            $output->writeln("Total product load: ".$count);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param $output
     * @throws \Exception
     */
    private function runIssues4($output)
    {
        try {
            $startTime = microtime(true);
            $productCollection = $this->productCollectionFactory->create();
            $productCollection->walk([$this, 'callBack']);
            $endTime = microtime(true);
            $time = $endTime - $startTime;
            $output->writeln("Execute time issue 4: ".$time);
            $output->writeln("Total product load: ".$this->total);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    private function runIssues5($output)
    {
        try {
            $startTime = microtime(true);
            $productCollection = $this->productCollectionFactory->create();
            $this->_resourceIterator->walk(
                $productCollection->getSelect(),
                [[$this, 'callBack']],
                []
            );
            $endTime = microtime(true);
            $time = $endTime - $startTime;
            $output->writeln("Execute time issue 5: ".$time);
            $output->writeln("Total product load: ".$this->total);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param $row
     */
    public function callBack($row){
        $this->total += 1;
    }

    public function runIssues6($output)
    {
        try {
            $rasamee = $this->_rasameeEntityFactory->create();
            $rasamee->addData(
                [
                    'id' => 1,
                    'name' => 'nguyen',
                    'title' => 'test',
                    'level' => 10
                ]
            )->save();
        }catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
