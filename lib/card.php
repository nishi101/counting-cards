<?php
Card::addOrValue("ClubAce","a","clubs/1.png",1,11);
Card::add("ClubTwo","2","clubs/2.png",2);
Card::add("ClubThee","3","clubs/3.png",3);
Card::add("ClubFour","4","clubs/4.png",4);
Card::add("ClubFive","5","clubs/5.png",5);
Card::add("ClubSix","6","clubs/6.png",6);
Card::add("ClubSeven","7","clubs/7.png",7);
Card::add("ClubEight","8","clubs/8.png",8);
Card::add("ClubNine","9","clubs/9.png",9);
Card::add("ClubTen","10","clubs/10.png",10);
Card::add("ClubJack","j","clubs/11.png",10);
Card::add("ClubQueen","q","clubs/12.png",10);
Card::add("ClubKing","k","clubs/13.png",10);

Card::addOrValue("DiamondAce","a","diamonds/1.png",1,11);
Card::add("DiamondTwo","2","diamonds/2.png",2);
Card::add("DiamondThee","3","diamonds/3.png",3);
Card::add("DiamondFour","4","diamonds/4.png",4);
Card::add("DiamondFive","5","diamonds/5.png",5);
Card::add("DiamondSix","6","diamonds/6.png",6);
Card::add("DiamondSeven","7","diamonds/7.png",7);
Card::add("DiamondEight","8","diamonds/8.png",8);
Card::add("DiamondNine","9","diamonds/9.png",9);
Card::add("DiamondTen","10","diamonds/10.png",10);
Card::add("DiamondJack","j","diamonds/11.png",10);
Card::add("DiamondQueen","q","diamonds/12.png",10);
Card::add("DiamondKing","k","diamonds/13.png",10);

Card::addOrValue("HeartAce","a","hearts/1.png",1,11);
Card::add("HeartTwo","2","hearts/2.png",2);
Card::add("HeartThee","3","hearts/3.png",3);
Card::add("HeartFour","4","hearts/4.png",4);
Card::add("HeartFive","5","hearts/5.png",5);
Card::add("HeartSix","6","hearts/6.png",6);
Card::add("HeartSeven","7","hearts/7.png",7);
Card::add("HeartEight","8","hearts/8.png",8);
Card::add("HeartNine","9","hearts/9.png",9);
Card::add("HeartTen","10","hearts/10.png",10);
Card::add("HeartJack","j","hearts/11.png",10);
Card::add("HeartQueen","q","hearts/12.png",10);
Card::add("HeartKing","k","hearts/13.png",10);

Card::addOrValue("SpadeAce","a","spades/1.png",1,11);
Card::add("SpadeTwo","2","spades/2.png",2);
Card::add("SpadeThee","3","spades/3.png",3);
Card::add("Spadeour","4","spades/4.png",4);
Card::add("SpadeFive","5","spades/5.png",5);
Card::add("SpadeSix","6","spades/6.png",6);
Card::add("SpadeSeven","7","spades/7.png",7);
Card::add("SpadeEight","8","spades/8.png",8);
Card::add("SpadeNine","9","spades/9.png",9);
Card::add("SpadeTen","10","spades/10.png",10);
Card::add("SpadeJack","j","spades/11.png",10);
Card::add("SpadeQueen","q","spades/12.png",10);
Card::add("SpadeKing","k","spades/13.png",10);

class Card {
    public static $chosenCards = [];
    public static $cardList = [];
    public $value = 0;
    public $orValue = 0;
    public $image_url = "";
    public $type;
    public $label;
    
    public static function pickCard(){
        $chosenCard = mt_rand(0,count(Card::$cardList)-1);
        $card = Card::$cardList[$chosenCard];
        array_splice(Card::$cardList, $chosenCard, 1);
        Card::$chosenCards[]=$card;
        return $card;
    }
    
    public static function add($label, $type, $image_url, $value){
        $card = new Card();
        $card->value = $value;
        $card->label = $label;
        $card->image_url = $image_url;
        $card->type = $type;
        $index = count(Card::$cardList);
        Card::$cardList[$index] = $card; 
        return $card;
    }
    public static function addOrValue($label, $type, $image_url, $value, $valueOr){
        $card = Card::add($label,$type,$image_url,$value);
        $card->orValue = $valueOr;
        return $card;
    }
}
?>