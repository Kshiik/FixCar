<?php 
$conn = new PDO('mysql:host=localhost;port=3306;dbname=v5;', "root", "");


if(isset($_POST['action'])){
    $act = $_POST['action'];
    if($act === 'getUserData'){
        $data = json_decode($_POST['data']);
        $arr = get_object_vars($data);
        if($arr['checkcod'] == 1){
            $sql = "UPDATE `request` SET `id_status` = '4' WHERE `request`.`id` = :id;";
        }
        if($arr['checkcod'] == 2){
            $sql = "UPDATE `request` SET `id_status` = '3' WHERE `request`.`id` = :id;";
        }
        
        $stmt = $conn->prepare($sql);
       
        $stmt->execute([
            'id'=>$arr['id'],
        ]);


        $result = $stmt->fetch();
        
        if($arr['checkcod'] == 1){
            $array = array(
                "return" => "Заявка подтверждена",
            );
        }
        if($arr['checkcod'] == 2){
            $array = array(
                "return" => "Заявка отменена",
            );
        }

        print_r(json_encode($array)) ;    
    }
}   