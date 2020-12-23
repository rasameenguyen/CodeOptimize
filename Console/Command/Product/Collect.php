<?php
namespace Magenest\CodeOptimize\Console\Command\Product;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\State as StateAppFramework;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;

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


    /** @var StateAppFramework  */
    protected $appState;

    /** @var ProductRepositoryInterface  */
    protected $productRepository;

    /** @var ProductCollectionFactory  */
    protected $productCollectionFactory;

    public function __construct(
        StateAppFramework $appState,
        ProductRepositoryInterface $productRepository,
        ProductCollectionFactory $productCollectionFactory,
        string $name = null
    ) {
        $this->appState = $appState;
        $this->productRepository = $productRepository;
        $this->productCollectionFactory = $productCollectionFactory;
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
            if($input->getOption(self::ISSUE_NUMBER_1) ){
               $this->runIssues1($output);
            }
            if($input->getOption(self::ISSUE_NUMBER_4)){
                $this->runIssues4($output);
            }
            $output->writeln("Completed!");
        } catch (\Exception $exception){
            $output->writeln($exception->getMessage());
        }
    }

    /**
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

    private function runIssues4($output)
    {
        try {
            $startTime = microtime(true);
//            $productCollection = $this->productCollectionFactory->create()->setPageSize(1)->setCurPage(1)->getFirstItem();
            $productCollection = $this->productCollectionFactory->create()->getFirstItem();
            $productCollection->getSku();
            $endTime = microtime(true);
            $time = $endTime - $startTime;
            $output->writeln("Execute time issue 4: ".$time);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
