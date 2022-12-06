<?php declare(strict_types=1);

namespace App\Quote;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class QuoteCommand extends Command
{
    /**
     * @var Quote
     */
    private $qouteService;

    /**
     * @var string
     */
    protected static $defaultName = 'app:get-quote';

    /**
     * QuoteCommand constructor.
     * @param Quote $quoteService
     */
    public function __construct(Quote $quoteService)
    {
        $this->qouteService = $quoteService;
        parent::__construct(null);
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setDescription('This command gets a random quote from quotable.io.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'A doze of inspiration to power your day',
            '========================================',
            '',
        ]);
        $quoteSection = $output->section();

        while (true) {
            $quote = $this->qouteService->getQuote();
            $quoteSection->overwrite($quote);
            sleep(5);
        }

    }
}
