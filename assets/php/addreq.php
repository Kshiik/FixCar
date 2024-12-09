<?PHP $conn = new PDO('mysql:host=localhost;port=3306;dbname=v5;', "root", "");

if(isset($_POST['action'])){
    $act = $_POST['action'];
    if($act === 'getUserData'){
        $data = json_decode($_POST['data']);
        $arr = get_object_vars($data);

        
            $sql = "INSERT INTO `request`  (`id_user`, `auto`,`problem`,`id_status`,`booking_datetime`) VALUES (:id_user, :auto, :problem, :id_status, :booking_datetime);";

            $stmt = $conn->prepare($sql);
           
            $stmt->execute([
                'id_user'=>$arr['id'],
                'auto'=>$arr['car'],
                'problem'=>$arr['problem'],
                'id_status'=>1,
                'booking_datetime'=>$arr['booking_datetime'],
            ]);
            $array = array(
                "return" => "Заявка оставлена",
            );
        print_r(json_encode($array)) ; 
       


    }
}