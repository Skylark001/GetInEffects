<?php
namespace TDroidd\GetInEffects;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;
use pocketmine\entity\InstantEffect;
class Main extends PluginBase implements Listener {
	/**
	 * OnEnable
	 *
	 * (non-PHPdoc)
	 * 
	 * @see \pocketmine\plugin\PluginBase::onEnable()
	 */	
	 public function onEnable(){
		$this->saveDefaultConfig();
		$this->reloadConfig();
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info("§eGetInEffects By §bTDroidd 1.3 §aEnabled!");
}
		public function onJoin(PlayerJoinEvent $event) {
		if($event->getPlayer()->hasPermission("gieffects.effect")) {
		$cfg=$this->getConfig();
			$effectid=$cfg->get("Effect-ID");
			$duration=$cfg->get("Duration");
			$particles=$cfg->get("Particles");
			$amplifier=$cfg->get("Amplifier");
			$msgtype=$cfg->get("Message-Type");
			$msg=$cfg->get("Join-Effect-Message");
			$health=$cfg->get("Fill-Player-Health");
		$p = $event->getPlayer();
	$effect = Effect::getEffect($effectid); //Effect ID
	$effect->setVisible($particles); //Particles
	$effect->setAmplifier($amplifier);
	$effect->setDuration($duration); //Ticks
	$p->addEffect($effect);
     if($health === true){
		$p->setHealth(20);
	}
		if($msgtype === "Tip"){
			$p->sendTip($msg);
		}elseif($msgtype === "PopUp"){
			$p->sendPopup($msg);
		}elseif($msgtype === "Chat"){
			$p->sendMessage($msg);
		}
	}
}
	/**
	 * OnDisable 
	 * (non-PHPdoc)
	 * 
	 * @see \pocketmine\plugin\PluginBase::onDisable()
	 */
	public function onDisable() {
		$this->getLogger()->info("§eGetInEffects By §bTDroidd §av1.3 §4Unloaded!");
	}
}
