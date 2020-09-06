<?php

namespace SortCommand\Moadassam;

use pocketmine\command\PluginCommand;

use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\network\mcpe\protocol\ActorEventPacket;
use pocketmine\Player;

class Sorts extends PluginCommand implements Listener
{

    public static function SortsMenu($player)
    {
        $api = Command::getFormAPI();
        $form = $api->createSimpleForm(function (Player $player, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case "0":
                    if ($player->hasPermission("foudre.use")) {
                        $itemfoudre = Item::get(369, 0, 1);
                        $player->getInventory()->addItem($itemfoudre);
                    } else {
                        $player->sendMessage("§cTu n'as pas le niveau d'utiliser ce sort");
                    }
                break;

                case "1":
                    $playerName1 = $player->getName();
                    if (!isset(Command::$coolDown1[$playerName1]) || Command::$coolDown1[$playerName1] <= time()) {
                        if ($player->hasPermission("minerais.use")) {
                            $random = mt_rand(1, 4);
                            $random2 = mt_rand(1, 32);
                            $random3 = mt_rand(10, 64);

                            if ($random == 1) {
                                $player->getInventory()->addItem(Item::get(265, 0, $random3));
                                $player->broadcastEntityEvent(ActorEventPacket::CONSUME_TOTEM);
                            }
                            if ($random == 2) {
                                $player->getInventory()->addItem(Item::get(264, 0, $random3));
                                $player->broadcastEntityEvent(ActorEventPacket::CONSUME_TOTEM);
                            }
                            if ($random == 3) {
                                $player->getInventory()->addItem(Item::get(263, 0, $random3));
                                $player->broadcastEntityEvent(ActorEventPacket::CONSUME_TOTEM);
                            }
                            if ($random == 4) {
                                $player->getInventory()->addItem(Item::get(388, 0, $random2));
                                $player->broadcastEntityEvent(ActorEventPacket::CONSUME_TOTEM);
                            }

                            Command::$coolDown1[$playerName1] = time() + 86400;
                        } else {
                            $player->sendMessage("§cTu n'as pas le niveau d'utiliser ce sort");
                        }
                    } else {
                        $time = Command::$coolDown1[$playerName1] - time();
                        $dateh = date("H", $time);
                        $datem = date("m", $time);
                        $dates = date("s", $time);
                        $player->sendPopup("§eRégénération du sort de §l§bMinerais");
                        $player->sendMessage("§c $dateh Heures $datem Minutes $dates Secondes");
                    }
                break;

                case "2":
                    if ($player->hasPermission("milleoiseaux.use")) {
                        $itemmilleoiseaux = Item::get(349, 0, 1);
                        $player->getInventory()->addItem($itemmilleoiseaux);
                    } else {
                        $player->sendMessage("§cTu n'as pas le niveau d'utiliser ce sort");
                    }
                break;

                case "3":
                    if ($player->hasPermission("ringan.use")){
                        $itemringan = Item::get(350, 0, 1);
                        $player->getInventory()->addItem($itemringan);
                    } else{
                        $player->sendMessage("§cTu n'as pas le niveau d'utiliser ce sort");
                    }
                break;

            }
            return true;
        });
        $form->setTitle("§l§e§kA§r§1§lSorts§e§k1");
        $form->addButton("§fFoudre", 1, "https://media1.giphy.com/media/KyHopEeCqpOiNJqK9h/200.gif");
        $form->addButton("§fMinerais", 1, "https://media1.giphy.com/media/KyHopEeCqpOiNJqK9h/200.gif");
        $form->addButton("§fMille Oiseaux", 1, "https://media1.giphy.com/media/KyHopEeCqpOiNJqK9h/200.gif");
        $form->addButton("§fRingan", 1, "https://media1.giphy.com/media/KyHopEeCqpOiNJqK9h/200.gif");
        $form->sendToPlayer($player);
        return $form;
    }

}