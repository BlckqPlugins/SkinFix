<?php

namespace SkinFix\skin;
use pocketmine\entity\Skin;
use pocketmine\network\mcpe\convert\LegacySkinAdapter;
use pocketmine\network\mcpe\protocol\types\skin\SkinData;


/**
 * Class BetterSkinAdapter
 * @package Core\Core\network\mcpe\protocol\types
 * @author Florian H.
 * @date 12.08.2020 - 00:10
 * @project Core
 */
class BetterSkinAdapter extends LegacySkinAdapter{
	/** @var SkinData[] */
	private $personaSkins = [];

    /**
     * @throws \Exception
     */
    public function fromSkinData(SkinData $data): Skin{
		if ($data->isPersona()) {
			$id = $data->getSkinId();
			$this->personaSkins[$id] = $data;
			return new Skin($id, str_repeat(random_bytes(3) . "\xff", 2048));
		}
		return parent::fromSkinData($data);
	}

	public function toSkinData(Skin $skin): SkinData{
		return $this->personaSkins[$skin->getSkinId()] ?? parent::toSkinData($skin);
	}
}
