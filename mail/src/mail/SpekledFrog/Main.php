<?php 

namespace mail\SpekledFrog; 

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;


class Main extends PluginBase implements Listener {
  
   public function onEnable(){
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
      @mkdir($this->getDataFolder());
      $this->saveDefaultConfig();
      $this->getResources("config.yml");
   	  $this->getlogger()->info("plugin Enabled");
   }

   public function onDisable(){
   	  $this->getlogger()->info("plugin Disabled");
   }

   public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool { 

         switch($cmd->getName()){                   
             case "mail":
               if($sender instanceof Player){
                   $this->openMyForm($sender); 
          } else {
                $sender->sendMessage("Mail commands arent supposed to be typed in console");
          }
       }
    return true;
}
 
  public function openMyForm($player){
       $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
       $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
             if($result === null){
                  return true;
             }
             switch($result){
                case 0:


                break;


                
             }
         });
         $form->setTitle("§l§cMAIL");
         $form->setContent($this->getConfig()->get("content"));
         $form->addButton("Back");
         $form->sendToPlayer($player);
          return $form;

                    
     }

}    