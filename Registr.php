<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" >
    <link rel="stylesheet" href="assets/css/Registr.css">
    <title>Document</title>
    <link>
</head>
<body>
    <div class="registrPage">
        <input type="text" name="fio" id="Fio" placeholder="ведите ФИО">
        <input type="tel" name="phone" id="Phone" placeholder="ваш номер телефона">
        <input type="text" name="login" id="Login" placeholder="ваш логин">
        <input type="text" name="password" id="Password" placeholder="ваш пароль">
        <input type="button" class="button" name="regist" value="зарегестрироваться" onclick="regist()">
        <a href="vhod.php" class="buttonvhod">войти</a>
    </div>   
    <script>
        function regist(){
            let xhr = new XMLHttpRequest(); 
            let data = {
                Fio: document.getElementById('Fio').value,
                phone: document.getElementById('Phone').value,
                login: document.getElementById('Login').value,
                password: document.getElementById('Password').value,
            }
            data = JSON.stringify(data);
            data = encodeURI(data);
            let parms = `action=getUserData&data=${data}`;
            xhr.onreadystatechange = function(){
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                    let text = JSON.parse(xhr.response);

                    if(text['return'] == "Пользователь создан"){
                        window.location.href = 'vhod.php';
                    }
                    else{
                        alert(text['return']);
                    }
                    
                }
            }
            xhr.open('POST','Assets/PHP/registr.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(parms);
        }
    </script>
</body>
</html>