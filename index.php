<?php
include "lib/card.php";
include "lib/player.php";

$p1 = Player::add("Adolf Hitler","assets/player_image/hitler.png");
$p2 = Player::add("Joseph Stalin","http://a1.files.biography.com/image/upload/c_fit,cs_srgb,dpr_1.0,h_1200,q_80,w_1200/MTE5NTU2MzE2Mzc0NDY4MTA3.jpg");
$p3 = Player::add("Emperor Hirohito","http://www.ducksters.com/history/world_war_ii/hirohito.jpg");
$p4 = Player::add("Hideki Tojo","http://www.nndb.com/people/950/000091677/tojo.jpg");
?><hmtl>

    <head>
        <title>Counting Fucking Cards</title>
        <style>
            .winner{
                color:#ff0600;
                font-weight:bold;
            }
        </style>
    </head>

    <body>
        <?php
            $count = mt_rand(4,6);
            $p1->pickCards($count);
            $p2->pickCards($count);
            $p3->pickCards($count);
            $p4->pickCards($count);
            $p1->tallyScore();
            $p2->tallyScore();
            $p3->tallyScore();
            $p4->tallyScore();
            $winner = [];
            foreach(Player::$player_list as $player){
                if((count($winner)==0 || $winner[0]->score<$player->score) && $player->score<=42){
                    $winner = [];
                    $winner[] = $player;
                }else if(($winner==0 || $winner[0]->score==$player->score) && $player->score<=42){
                    $winner[] = $player;
                }
            }
        ?>
        <br/>
        <table>
            <tr>
               <td colspan="3">
                   <?php if(count($winner)==1){?>
                    <h1>Winner <?=$winner[0]->playerName;?> with the score <?=$winner[0]->score;?></h1>
                   <?php }else if(count($winner)>1){ ?>
                    <h1>Multiple winners! <?php $t = 0;$max=count($winner); foreach ($winner as $w){ ?><?=$w->playerName; echo ($t<$max-1)?", ":""; $t++; }  ?> with the score <?=$winner[0]->score;?></h1>
                   <?php }else{ ?>
                      <h1>No Winners</h1>
                   <?php } ?>
               </td>
            </tr>
            <?php
            foreach(Player::$player_list as $player){
                ?>
                <tr>
                    <td>
                        <center>
                            <img src="<?=$player->image_url;?>" style="width:100px;"/><br/>
                            <span class="<?php echo (in_array($player,$winner))?"winner":"loser";?>"><?=$player->playerName;?></span>
                        </center>
                    </td>
                    <td>
                    <?php
                        foreach($player->selectedCards as $card){
                            ?>
                            <img src="assets/cards/<?=$card->image_url;?>"/>
                            <?php
                        }
                    ?>
                    </td>
                    <td><h1><?=$player->score;?></h1></td>
                </tr>
                <?php    
            }
            ?>
        </table>
    </body>

</html>