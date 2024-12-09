<?php 
$conn = new PDO('mysql:host=localhost;port=3306;dbname=v5;', "root", "");


if(isset($_POST['action'])){
    $act = $_POST['action'];
    if($act === 'getUserData'){
        $data = json_decode($_POST['data']);
        $arr = get_object_vars($data);

        $sql = "SELECT * FROM `user` WHERE login = :name";
        $stmt = $conn->prepare($sql);
       
        $stmt->execute([
            'name'=>$arr['login'],
        ]);

        $result = $stmt->fetch();
        
        if($result != null){

            if($result['password'] != $arr['password']){
                $array = array(
                    "return" => "Не верный пароль",
                );
            }
            else{
                $array = array(
                    "id" => $result['id'],
                    "return" => "Вход выполнен",
                );
            }

            
        }
        else{
            $array = array(
                "return" => "Не верный логин",
            );
        }
        print_r(json_encode($array)) ;    
    }
}   