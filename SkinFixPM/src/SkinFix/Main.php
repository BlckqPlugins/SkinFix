<?php

namespace SkinFix;

use pocketmine\network\mcpe\convert\LegacySkinAdapter;
use pocketmine\network\mcpe\convert\SkinAdapterSingleton;
use pocketmine\plugin\PluginBase;
use SkinFix\skin\BetterSkinAdapter;

class Main extends PluginBase {

    /** @var null|LegacySkinAdapter */
    private $originalAdaptor = null;

    public function onEnable(): void
    {
        $this->originalAdaptor = SkinAdapterSingleton::get();
        SkinAdapterSingleton::set(new BetterSkinAdapter());
    }

    public function onDisable(): void
    {
        if ($this->originalAdaptor !== null) {
            SkinAdapterSingleton::set($this->originalAdaptor);
        }
    }
}
