<?php

namespace GetWith\CoffeeMachine\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use GetWith\CoffeeMachine\Models\Coffee;
use GetWith\CoffeeMachine\Models\Tea;
use GetWith\CoffeeMachine\Models\Chocolate;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'app:order-drink';

    public function __construct()
    {
        parent::__construct(MakeDrinkCommand::$defaultName);
    }

    protected function configure(): void
    {
        $this->addArgument(
            'drink-type',
            InputArgument::REQUIRED,
            'The type of the drink. (Tea, Coffee or Chocolate)'
        );

        $this->addArgument(
            'money',
            InputArgument::REQUIRED,
            'The amount of money given by the user'
        );

        $this->addArgument(
            'sugars',
            InputArgument::OPTIONAL,
            'The number of sugars you want. (0, 1, 2)',
            0
        );

        $this->addOption(
            'extra-hot',
            'e',
            InputOption::VALUE_NONE,
            $description = 'If the user wants to make the drink extra hot'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $drink = null;
        $message = '';

        $drinkType = strtolower($input->getArgument('drink-type'));
        $money = $input->getArgument('money');
        $sugars = $input->getArgument('sugars');
        $extraHot = $input->getOption('extra-hot');

        try {

            switch ($drinkType) {
                case 'tea':
                    $drink = new Tea;
                    break;
                case 'coffee':
                    $drink = new Coffee;
                    break;
                case 'chocolate':
                    $drink = new Chocolate;
                    break;
                default:
                    throw new \WrongDrinkTypeException('The drink type should be tea, coffee or chocolate.');
            }

            $message .= $drink->buyDrink($money);
            $message .= $drink->addExtraHot($extraHot);
            $message .= $drink->addSugar($sugars);
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            return 0;
        }

        $output->writeln($message);

        return 0;
    }
}
