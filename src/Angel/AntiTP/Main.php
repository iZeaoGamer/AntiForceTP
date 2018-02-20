<?php

namespace Angel\AntiTP;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use pocketmine\event\player\PlayerCommandPreprocessEvent;

class Main extends PluginBase implements Listener{
  
  public $tper = [];
  public $essentialspe;
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  $this->essentialspe = $this->getServer()->getPluginManager()->getPlugin("EssentialsPE");
        if (!$this->essentialspe) {
            $this->getLogger()->info("Add EssentialsPE to disable the /god feature upon teleport.");
        }
  public function antiTP(PlayerCommandPreprocessEvent $ev){
    $p = $ev->getPlayer();
    $command = strtolower(explode(" ", $ev->getMessage())[0]);
    if($p->isOp() or $p->hasPermission("pocketmine.command.teleport")){
      if($command == "./tp" || $command == "/tp"){
        $p->setGamemode(3);
        $this->tper[strtolower($p->getName())] = strtolower($p->getName());
      }
      if($this->plugin->essentialsPE->isGod($e->getPlayer())){
        $e->setCancelled(true);
      // cancels event if force tped and run blocked force tp command
      if(isset($this->tper[strtolower($p->getName())])){
        if($command == "/sethome" || $command == "./sethome" || $command == "/god" || $command == "./god"){
          $ev->setCancelled(true);
          $p->sendMessage("This Command is Disabled Since You Force Tped! , Remove this by tping to spawn!");
        }
      }
      
      if($command == "/spawn" || $command == "./spawn"){
        unset($this->tper[strtolower($p->getName())]);
        $p->sendMessage("Forced TPed removed!");
        $p->setGamemode(0);
      }
    }
  }
}
