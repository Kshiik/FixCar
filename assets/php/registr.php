<?PHP $conn = new PDO('mysql:host=localhost;port=3306;dbname=v5;', "root", "");

if(isset($_POST['action'])){
    $act = $_POST['action'];
    if($act === 'getUserData'){
        $data = json_decode($_POST['data']);
        $arr = get_object_vars($data);

        $sql = "SELECT * FROM `user` WHERE login = :name And password = :password";
        $stmt = $conn->prepare($sql);
       
        $stmt->execute([
            'name'=>$arr['login'],
            'password'=>$arr['password'],
        ]);
        $result = $stmt->fetch();
        $count = $stmt->rowCount();

        if(!empty($arr['login']) && !empty($arr['password']) && !empty($arr['Fio']) && !empty($arr['phone'])){
            if($count > 0){
                $array = array(
                    "return" => "Уже есть",
                );
            }
            else{
                $sql = "INSERT INTO `user`  (`id_role`,`login`, `password`,`full_name`,`phone`) VALUES (:id_role, :login, :password, :full_name, :phone);";
    
                $stmt = $conn->prepare($sql);
               
                $stmt->execute([
                    'id_role'=>1,
                    'login'=>$arr['login'],
                    'password'=>$arr['password'],
                    'full_name'=>$arr['Fio'],
                    'phone'=>$arr['phone'],
                ]);
                $array = array(
                    "return" => "Пользователь создан",
                );
            }
        }
        else{
            $array = array(
                "return" => "Не все поля заполнены",
            );
        }
        

        print_r(json_encode($array)) ; 
       


    }
}