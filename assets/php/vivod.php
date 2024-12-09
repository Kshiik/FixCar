<?php 

try {
                    $conn = new PDO('mysql:host=localhost;port=3306;dbname=v5;', "root", "");
                    if(isset($_POST['action'])){
                        $act = $_POST['action'];
                        if($act === 'getUserData'){
                            $data = json_decode($_POST['data']);
                            $arr = get_object_vars($data);
                    
                            $sql = "SELECT * FROM `request` INNER JOIN `status` ON `request`.`id_status` = `status`.`id` WHERE `request`.`id_user` = :id;";
                            $stmt = $conn->prepare($sql);
                           
                            $stmt->execute([
                                'id'=>$arr['id'],
                            ]);
                            $arraaa = $stmt->fetchAll();
                
                            print_r(json_encode($arraaa));
                        }
                    }


                } catch(PDOException $e) {
                    echo "Ошибка подключения: " . $e->getMessage();
                }