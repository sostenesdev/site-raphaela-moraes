<?php

namespace App\Services;

use DestinyLab\Swetest; 

class BirthChartService{

    private $permissions;
    public function __construct()
    {
        $this->permissions = ['Administrador', 'Funcionario', 'Convidado'];
    }
    public function getPermissions(){
        return $this->permissions;
    }

     //gets birth chart data from form
     public function birthChart(){

        // dd(public_path().DIRECTORY_SEPARATOR.'swetest'.DIRECTORY_SEPARATOR.'swetest.exe');
        
    // $swetest = new Swetest(public_path().DIRECTORY_SEPARATOR.'swetest'.DIRECTORY_SEPARATOR.'swetest.exe');
    $swetest = new Swetest();
    $swetest->setMaskPath(true);
    
    $birthDate = new \DateTime( '15 July 1987 08:15:00');
    //echo $birthDate->format('Y-m-d H:i:s'); echo '<br>';

    /**
     * Latitude Longitude
     * of Kathmandu, Nepal
     */
    $latitude = 27.7172453;
    $longitude = 85.3239605;

    /**
     * Timezone value for Nepal
     * As Nepal time is 5 hours 45 minutes ahead of UTC
     *
     * Put this value according to your country
     */
    $timezone = 5.75; 

    /**
     * Converting birth date/time to UTC
     */
    $offset = $timezone * (60 * 60);
    $birthTimestamp = strtotime($birthDate->format('Y-m-d H:i:s'));
    $utcTimestamp = $birthTimestamp - $offset;
    //echo date('Y-m-d H:i:s', $utcTimestamp); echo '<br>';
    $h_sys = 'P';

    $date = date('d.m.Y', $utcTimestamp);
    $time = date('H:i:s', $utcTimestamp);

    $swetest->query('-b'.$date.' -ut'.$time.' -p0123456789DAmt -sid1 -eswe -house'.$longitude.','.$latitude.','.$h_sys.' -fPls -g, -head')->execute();

    $output = $swetest->response()['output'];
    $planets = array_slice($output, 0, 14);
    $houses = array_slice($output, 14, 12);
    $ascendant = explode(',',$output[26]);

    // dd($output);

    $result = array();
    foreach($houses as $key => $h){
            $house = explode(',',$h);
            $nextKey = $key+1;
            if($nextKey > count($houses)-1){
                $nextKey = 0;
            }
            // $nextHouse = explode(',',$houses[$nextKey]);
            // dd($nextHouse);
            $h1 = $this->convertStringToFloat($house[1]);
            $h2 = $this->convertStringToFloat($house[2]);
            // $p = $this->convertStringToFloat(explode(',',$planets[0])[2]);
            // $teste = $this->point_between($h1,$h2,$p);
            // dd($h1,$h2,$p, $teste);
            $house_planets = [];
            foreach($planets as $p){
                $planet = explode(',',$p);
                $p1 = $this->convertStringToFloat($planet[1]);
                $p2 = $this->convertStringToFloat($planet[2]);
                // dd($p1,$p2);
                if($this->point_between($h1,$h2,$p1) && $this->point_between($h1,$h2,$p2)){
                    $house_planets[] = [
                                        'planet'=>(object)['name' => trim($planet[0]), 
                                                'position' => $planet[1], 
                                                'abs_pos' => $planet[2]],
                                        'house' => (object)$this->calculate_house_position($h1, 'Casa '.$key+1, 'casa')];
                }
            }
            $result[] = ['house_planets'=> $house_planets];
        }   
        return $result;
    }

    public function calcularDistancia($a1,$b1,$a2,$b2){
        return sqrt(($a1-$a2)*($a1-$a2)+($b1-$b2)*($b1-$b2));
    }

    //funcao que calcula a distancia entre dois pontos
    
    //funcao que converte string em float
    public function convertStringToFloat($string){
        $string = str_replace(',', '.', $string);
        $string = str_replace('°', '', $string);
        $string = str_replace('\'', '', $string);
        $string = str_replace('"', '', $string);
        $string = trim($string);
        return floatval($string);
    }

    function calculate_house_position($degree, $number_name, $point_type) {
        if ($degree < 30) {
            $dictionary = array("name" => $number_name, "quality" => "Cardinal", "element" => "Fire", "sign" => "Ari", "sign_num" => 0, "position" => $degree, "abs_pos" => $degree, "emoji" => "♈️", "point_type" => $point_type);
        } elseif ($degree < 60) {
            $result = $degree - 30;
            $dictionary = array("name" => $number_name, "quality" => "Fixed", "element" => "Earth", "sign" => "Tau", "sign_num" => 1, "position" => $result, "abs_pos" => $degree, "emoji" => "♉️", "point_type" => $point_type);
        } elseif ($degree < 90) {
            $result = $degree - 60;
            $dictionary = array("name" => $number_name, "quality" => "Mutable", "element" => "Air", "sign" => "Gem", "sign_num" => 2, "position" => $result, "abs_pos" => $degree, "emoji" => "♊️", "point_type" => $point_type);
        } elseif ($degree < 120) {
            $result = $degree - 90;
            $dictionary = array("name" => $number_name, "quality" => "Cardinal", "element" => "Water", "sign" => "Can", "sign_num" => 3, "position" => $result, "abs_pos" => $degree, "emoji" => "♋️", "point_type" => $point_type);
        } elseif ($degree < 150) {
            $result = $degree - 120;
            $dictionary = array("name" => $number_name, "quality" => "Fixed", "element" => "Fire", "sign" => "Leo", "sign_num" => 4, "position" => $result, "abs_pos" => $degree, "emoji" => "♌️", "point_type" => $point_type);
        } elseif ($degree < 180) {
            $result = $degree - 150;
            $dictionary = array("name" => $number_name, "quality" => "Mutable", "element" => "Earth", "sign" => "Vir", "sign_num" => 5, "position" => $result, "abs_pos" => $degree, "emoji" => "♍️", "point_type" => $point_type);
        } elseif ($degree < 210) {
            $result = $degree - 180;
            $dictionary = array("name" => $number_name, "quality" => "Cardinal", "element" => "Air", "sign" => "Lib", "sign_num" => 6, "position" => $result, "abs_pos" => $degree, "emoji" => "♎️", "point_type" => $point_type);
        } elseif ($degree < 240) {
            $result = $degree - 210;
            $dictionary = array("name" => $number_name, "quality" => "Fixed", "element" => "Water", "sign" => "Sco", "sign_num" => 7, "position" => $result, "abs_pos" => $degree, "emoji" =>
    
            "♏️", "point_type" => $point_type);
        } elseif ($degree < 270) {
            $result = $degree - 240;
            $dictionary = array("name" => $number_name, "quality" => "Mutable", "element" => "Fire", "sign" => "Sag", "sign_num" => 8, "position" => $result, "abs_pos" => $degree, "emoji" => "♐️", "point_type" => $point_type);
        } elseif ($degree < 300) {
            $result = $degree - 270;
            $dictionary = array("name" => $number_name, "quality" => "Cardinal", "element" => "Earth", "sign" => "Cap", "sign_num" => 9, "position" => $result, "abs_pos" => $degree, "emoji" => "♑️", "point_type" => $point_type);
        } elseif ($degree < 330) {
            $result = $degree - 300;
            $dictionary = array("name" => $number_name, "quality" => "Fixed", "element" => "Air", "sign" => "Aqu", "sign_num" => 10, "position" => $result, "abs_pos" => $degree, "emoji" => "♒️", "point_type" => $point_type);
        } elseif ($degree < 360) {
            $result = $degree - 330;
            $dictionary = array("name" => $number_name, "quality" => "Mutable", "element" => "Water", "sign" => "Pis", "sign_num" => 11, "position" => $result, "abs_pos" => $degree, "emoji" => "♓️", "point_type" => $point_type);
        }
        return $dictionary;
    }
    

    function point_between($p1, $p2, $p3) {
        // Finds if a point is between two others in a circle
        // args: first point, second point, point in the middle
        $p1_p2 = fmod($p2 - $p1 + 360, 360);
        $p1_p3 = fmod($p3 - $p1 + 360, 360);
        
        if (($p1_p2 <= 180) != ($p1_p3 > $p1_p2)) {
            return true;
        } else {
            return false;
        }
    }
    




}