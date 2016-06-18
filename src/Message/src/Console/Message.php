<?php
declare(strict_types = 1);

namespace Message\Console;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Message Console
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
class Message extends Command
{
    /**
     * Show helper
     *
     * @return void
     */
    public function configure()
    {
        $this->setTitle('messages:list')->setDescription('List all messages');
    }

    /**
     * Execute command
     *
     * @param  InputInterface $input
     * @param  OutputInterface $output
     * @return string
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        /* @var $consoleApp \Knp\Console\Application */
        $consoleApp = $this->getApplication();

        /* @var $app \Bootstrap */
        $app = $consoleApp->getSilexApplication();

        $result = $app['message.service']->listAll();

        /* @var $message \Message\Entity\MessageInterface */
        array_Walk($result, function($message) use($output) {
            $output->writeln($message->getTitle() . ' - ' . $message->getText());
        });

        return true;
    }
}
