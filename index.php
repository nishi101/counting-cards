<?php
include "lib/card.php";
include "lib/player.php";


/*if(isset($_POST['p1'])){
    $p1 = Player::add("Adolf Hitler","assets/player_image/hitler.png");
    $p2 = Player::add("Joseph Stalin","http://a1.files.biography.com/image/upload/c_fit,cs_srgb,dpr_1.0,h_1200,q_80,w_1200/MTE5NTU2MzE2Mzc0NDY4MTA3.jpg");
    $p3 = Player::add("Emperor Hirohito","http://www.ducksters.com/history/world_war_ii/hirohito.jpg");
    $p4 = Player::add("Hideki Tojo","http://www.nndb.com/people/950/000091677/tojo.jpg"); */

?><hmtl>

    <head>
        <title>Silverjack</title>
        <style>
            .winner{
                color:#ff0600;
                font-weight:bold;
            }
        </style>
    </head>

    <body background="http://www.solitaire-pyramid.com/solitaire/images/backgrounds/1920x1200/green_felt.jpg">
        
        <head><b>Fill in your name and hit play!</b></head>
        <form action="index.php" method="POST">
            <div>
                <label>Player 1:</label><input type="text" name="p1"/>
            </div>
            <div>
                <label>Player 2:</label><input type="text" name="p2"/>
            </div>
            <div>
                <label>Player 3:</label><input type="text" name="p3"/>
            </div>
            <div>
                <label>Player 4:</label><input type="text" name="p4"/>
            </div>
            
            <input type="submit" value="Play!" />
            <input type="reset" value="Clear Form" />
        </form>

        
        <?php 
        if(!isset($_POST['submit'])){ 
        $p1 = Player::add($_POST['p1'], "http://clipartsign.com/upload/2016/02/11/stick-figure-pics-clipart.jpeg");
        $p2 = Player::add($_POST['p2'], "http://blogs.technet.com/resized-image.ashx/__size/550x0/__key/communityserver-blogs-components-weblogfiles/00-00-00-91-10/3513.StickFigure_5F00_GradCap.png");
        $p3 = Player::add($_POST['p3'], "http://vignette4.wikia.nocookie.net/battlefordreamisland/images/5/5b/My_stick_figure.png/revision/latest?cb=20111203123444");
        $p4 = Player::add($_POST['p4'], "http://vignette4.wikia.nocookie.net/random-ness/images/4/4b/Michael_the_Stick_Figure.png/revision/latest?cb=20120922121447");
        
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
        <?php  ?>
    </body>

</html>