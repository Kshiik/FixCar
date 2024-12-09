<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/create.css">
    <title>Формирование заявки</title>
</head>
<body>
    <script>
        var id = JSON.parse(localStorage.getItem("id"));
        sessionStorage.removeItem("id");
        sessionStorage.clear();
    </script>
    <h1>Формирование заявки</h1>
    <div class="form">
        <label for="car">Автомобиль:</label><br>
        <input type="text" id="car" name="car" required><br>
        
        <label for="problem">Описание проблемы:</label><br>
        <textarea id="problem" name="problem" rows="4" cols="50" required></textarea><br>
        
        <label for="booking_date">Дата бронирования:</label><br>
        <input type="date" id="booking_date" name="booking_date" required><br>
        
        <label for="booking_time">Время бронирования (8:00 - 21:00):</label><br>
        <input type="time" id="booking_time" name="booking_time" min="08:00" max="21:00" required><br><br>
        
        <input type="submit" value="Отправить заявку" onclick="regist()">
    </div>


    <script>
        function regist(){

            let xhr = new XMLHttpRequest(); 
            let data = {
                id: id,
                car: document.getElementById('car').value,
                problem: document.getElementById('problem').value,
                booking_datetime: document.getElementById('booking_date').value + ' ' + document.getElementById('booking_time').value+':00',
            }
            data = JSON.stringify(data);
            data = encodeURI(data);
            let parms = `action=getUserData&data=${data}`;
            xhr.onreadystatechange = function(){
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                    let text = JSON.parse(xhr.response);

                    if(text['return'] == "Заявка оставлена"){
                        alert(text['return']);
                        localStorage.setItem("id",id);
                        location.href = "vid.php";
                    }
                    else{
                        alert(text['return']);
                    }
                }
            }
            xhr.open('POST','Assets/PHP/addreq.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(parms);
        }
    </script>
</body>
</html>