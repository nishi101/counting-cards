<?php
class Player{
    public static $player_list = [];
    public $image_url;
    public $playerName;
    public $id;
    public $score;
    public $selectedCards = [];
    
    public function pickCards($count){
        
        $this->selectedCards = [];
        for($i=0;$i<$count;$i++){
            $this->selectedCards[] = Card::pickCard();
        }
    }
    
    public function tallyScore(){
        $checkScore = [0,0];
        foreach($this->selectedCards as $card){
            if($card->type=="a"){
                $checkScore[0] += $card->value;
                $checkScore[1] += $card->orValue;
            }else{
                $checkScore[0] += $card->value;
                $checkScore[1] += $card->value;
            }
        }
        if($checkScore[0]<42 && $checkScore[0]>=$checkScore[1] && abs(42-$checkScore[0])<abs(42-$checkScore[1])){
            $this->score=$checkScore[0];
        }else if($checkScore[1]<42 && $checkScore[1]>=$checkScore[0] && abs(42-$checkScore[1])<abs(42-$checkScore[0])){
            $this->score=$checkScore[1];
        }else{
            $this->score=$checkScore[1];
        }
    }
    
    public static function add($name, $image_url){
        $player = new Player();
        $player->playerName = $name;
        $player->score = 0;
        $index = count(Player::$player_list);
        $player->id = $index;
        $player->image_url = $image_url;
        Player::$player_list[$index] = $player;
        return $player;
    }
}
