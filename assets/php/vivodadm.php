<?php 

try {
                    $conn = new PDO('mysql:host=localhost;port=3306;dbname=v5;', "root", "");
                    if(isset($_POST['action'])){
                        $act = $_POST['action'];
                        if($act === 'getUserData'){
                            $sql = "SELECT * FROM `request` INNER JOIN `status` ON `request`.`id_status` = `status`.`id` INNER JOIN `user` ON `user`.`id` = `request`.`id_user`";
                            $stmt = $conn->prepare($sql);
                           
                            $stmt->execute();
                            $arraaa = $stmt->fetchAll();
                
                            print_r(json_encode($arraaa));
                        }
                    }


                } catch(PDOException $e) {
                    echo "Ошибка подключения: " . $e->getMessage();
                }