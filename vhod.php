<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/vhod.css">
    <title>Document</title>
</head>
<body>
<div class="vhodPage">
        <input type="text" name="login" id="Login" placeholder="ваш логин">
        <input type="text" name="password" id="Password" placeholder="ваш пароль">
        <input type="button" class="buttonvhod" name="vhod" value="Войти" onclick="login();">
        <a href="Registr.php" class="button">Зарегистрироваться</a>
    </div>   
    <script>

        function login(){
            let xhr = new XMLHttpRequest(); 
            let data = {
                login: document.getElementById('Login').value,
                password: document.getElementById('Password').value,
            }
            data = JSON.stringify(data);
            data = encodeURI(data);
            let parms = `action=getUserData&data=${data}`;
            xhr.onreadystatechange = function(){
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                    let text = JSON.parse(xhr.response);
                    

                    if(text['return'] == "Вход выполнен"){
                        if(text['id'] == 16){
                            location.href = "AdminPanel.php";
                        }
                        else{
                            localStorage.setItem("id",JSON.stringify(text['id']));
                            location.href = "vid.php";
                        }

                    }
                    else{
                        alert(text['return']);
                    }
                }
            }
            xhr.open('POST','Assets/PHP/login.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(parms);
        }
    </script>
</body>
</html>