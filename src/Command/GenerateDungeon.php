<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 12/04/2018
 * Time: 20:53
 */

namespace Mld\Command;

use Mld\Core\Defaults\Dungeon as DungeonConfig;
use Mld\Core\Dungeon;
use ReflectionProperty;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class GenerateDungeon extends ContainerAwareCommand
{
    const NAME = 'mld:generate:dungeon';
    const DESCRIPTION = 'Generates a basic dungeon, see help for more details';

    const ARG_WIDTH = 'arg-width';
    const DSC_WIDTH = 'Determinate the dungeon width, default value is %d';

    const ARG_HEIGHT = 'arg-height';
    const DSC_HEIGHT = 'Determinate the dungeon height, default value is %d';

    const ARG_PERCENTAGE_OF_ROOMS ='arg-percentage-of-rooms';
    const DSC_PERCENTAGE_OF_ROOMS = 'Determinate the percentage of rooms within the dungeon size';

    /** @var InputInterface $input */
    protected $input;

    /** @var OutputInterface $output */
    protected $output;

    /** @var Dungeon $dungeon */
    protected $dungeon;

    /**
     * GreetCommand constructor.
     *
     * @param null|string $name
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setName(self::NAME)
            ->setDescription(sprintf(self::DESCRIPTION))
            ->addArgument(
                self::ARG_WIDTH,
                InputArgument::OPTIONAL,
                sprintf(self::DSC_WIDTH, DungeonConfig::$WIDTH)
            )
            ->addArgument(
                self::ARG_HEIGHT,
                InputArgument::OPTIONAL,
                sprintf(self::DSC_HEIGHT, DungeonConfig::$HEIGHT)
            )
            ->addArgument(
                self::ARG_PERCENTAGE_OF_ROOMS,
                InputArgument::OPTIONAL,
                sprintf(self::DSC_PERCENTAGE_OF_ROOMS, DungeonConfig::$PERCENTAGE_OF_ROOMS)
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    private function init(InputInterface $input, OutputInterface $output)
    {
        ini_set('memory_limit', -1);
        set_time_limit(0);

        $this->input  = $input;
        $this->output = $output;
    }

    /**
     * Execute the command
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws \Mld\Exception\ConfigException
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->init($input, $output);

        $this->getArguments();

        $this->generate();

        $this->output->writeln(sprintf('Dungeon generated (with : %d rooms) !', $this->dungeon->cRooms));
    }

    /**
     * Generate a dungeon
     *
     * @throws \Mld\Exception\ConfigException
     */
    protected function generate(): void
    {
        $this->dungeon = new Dungeon();

        $this->dungeon->generate();

        echo $this->dungeon;
    }

    /**
     * Get the command arguments
     */
    protected function getArguments(): void
    {
        if ($this->input->getArgument(self::ARG_WIDTH) !== null) {
            DungeonConfig::$WIDTH = $this->input->getArgument(self::ARG_WIDTH);
        }

        if ($this->input->getArgument(self::ARG_HEIGHT) !== null) {
            DungeonConfig::$HEIGHT = $this->input->getArgument(self::ARG_HEIGHT);
        }

        if ($this->input->getArgument(self::ARG_PERCENTAGE_OF_ROOMS) !== null) {
            DungeonConfig::$PERCENTAGE_OF_ROOMS = $this->input->getArgument(self::ARG_PERCENTAGE_OF_ROOMS);
        }
    }
}