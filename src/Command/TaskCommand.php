<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Service\Count;


class TaskCommand extends Command
{
	protected static $defaultName = 'app:task';

	protected function configure()
	{
		$this->setDescription('Counts numbers')
			 ->setHelp('input - numbers between 1 and 99 999')
			 ->addArgument('numbers', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'numbers between 1 and 99 999 (separate multiple numbers with a space)');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$count = new Count();

		$numbers = $input->getArgument('numbers');
		$result = $count->getResults($numbers);

		$output->writeln([
			'Counts numbers a[i]',
			'',
		]);

		$output->writeln('Input numbers:  '.implode(' ',$input->getArgument('numbers')));
		$output->writeln('Output numbers: '.implode(' ', $result));
	}
}