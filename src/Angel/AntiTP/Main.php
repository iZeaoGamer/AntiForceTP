<?php

namespace Angel\AntiTP;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;


use pocketmine\event\player\PlayerCommandPreprocessEvent;

class Main extends PluginBase implements Listener{
  
  public $tped = [];
  
  public $antiTP = [];
  public $blocked = [];
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    
    $cmds = [
      "/tp",
      "./tp",
      "/god",
      "./god",
        ];
        foreach($cmds as $cmd){
            $this->antiTP[$cmd]=1;
        }
    
        $cmds = [
      "/sethome",
      "./sethome",
        ];
        foreach($cmds as $cmd){
            $this->blocked[$cmd]=1;
        }
  }
  
  public function antiTP(PlayerCommandPreprocessEvent $ev){
    $command = strtolower(explode(" ", $ev->getMessage())[0]);
    if($ev->getPlayer()->isOp() or $event->getPlayer()->hasPermission("pocketmine.command.teleport")){
      if(isset($this->antiTP[$command])){
        $this->tped[strtolower($ev->getPlayer()->getName())] = strtolower($ev->getPlayer()->getName());
      }
      // checks for the blocked commands on force tp
      if(isset($this->tped[strtolower($ev->getPlayer()->getName())])){
        if(isset($this->blocked[$command])){
          $ev->setCancelled(true);
          $ev->getPLayer()->sendMessage("This Command is Disabled Since You Force Tped!");
        }
      }
      
      if($command == "/spawn" || $command == "./spawn"){
        unset($this->tped[strtolower($ev->getPlayer()->getName())]);
      }
    }
  }
          
      
      
          
