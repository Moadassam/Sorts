<?php

namespace SortCommand\Moadassam;

use pocketmine\command\PluginCommand;

use pocketmine\event\Listener;
use pocketmine\Player;

class SortHelp extends PluginCommand implements Listener{

    public static function SortHelpMenu($player){
        $api = Command::getFormAPI();
        $form = $api->createCustomForm(function (Player $player, array $data){
            $result = $data;
            if(empty($result)){
                return true;
            }
            return true;
        });

        $form->setTitle("§l§1§kA§r§eSortHelp§1§k1");
        $form->addLabel("§2Le plugin de sort comprends plusieurs sorts, il suffit de faire /sort pour accéder à la liste. Ils sont débloquable à partir d'un certain niveau, de plus ils ont un cooldown d'utilisation. \n \n§ePlugin Développé par Moadassam !\n§cDiscord: §gMoadassam#1417");
        $form->sendToPlayer($player);
        return $form;
    }
}