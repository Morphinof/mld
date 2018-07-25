<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 25/07/2018
 * Time: 20:46
 */

namespace Mld\Core;

use Mld\Core\Defaults\AbstractDungeon;
use Mld\Core\Defaults\Dungeon as DungeonConfig;
use Mld\Exception\ConfigException;

class Dungeon extends AbstractDungeon
{
    /**
     * Dungeon constructor.
     */
    public function __construct()
    {
        parent::__init();
    }

    /**
     * Generate a dungeon
     *
     * @throws ConfigException
     */
    public function generate(): void
    {
        $this->checkConfig();

        $generatedRooms = 0;
        $numberOfRooms  = round((DungeonConfig::$HEIGHT * DungeonConfig::$WIDTH) * DungeonConfig::$PERCENTAGE_OF_ROOMS);

        while ($generatedRooms < $numberOfRooms) {
            do {
                $x = mt_rand(0, DungeonConfig::$WIDTH - 1);
                $y = mt_rand(0, DungeonConfig::$HEIGHT - 1);
            } while ($this->dungeon[$x][$y] !== DungeonConfig::$EMPTY_TALE);

            $this->dungeon[$x][$y] = DungeonConfig::$ROOM_TALE;

            $generatedRooms++;
        }
    }

    /**
     * Check the dungeon configuration
     *
     * @throws ConfigException
     */
    private function checkConfig(): void
    {
        if (DungeonConfig::$PERCENTAGE_OF_ROOMS > 1 || DungeonConfig::$PERCENTAGE_OF_ROOMS < 0) {
            throw new ConfigException(sprintf('Invalid percentage of rooms %f', DungeonConfig::$PERCENTAGE_OF_ROOMS));
        }
    }
}