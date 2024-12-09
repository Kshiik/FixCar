<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/admin.css" rel="stylesheet">
    <title>Document</title>
</head>
<body onload="vi()">
<header>
        <a class="create-request-button" href="vhod.php">Выход</a>
    </header>
    <main>
        <h1>Мои заявки</h1>
       <div class="table-container" >
        <table> 
            <thead> 
               
                <tr>
                    <th>Номер заявки</th>
                    <th>Фамилия</th>
                    <th>Машина</th>
                    <th>проблема</th>
                    <th>Статус</th>
                    <th>Дата создания</th>
                    <th>Отметить статус</th>
                </tr>
            </thead>
            <tbody class="cards">
                
            </tbody>
        </table>
    </div>
    </main> 


    <script>
        function check(idreq,checkcod){
            let xhr = new XMLHttpRequest(); 
            let data = {
                checkcod: checkcod,
                id: idreq
            }
            data = JSON.stringify(data);
            data = encodeURI(data);
            let parms = `action=getUserData&data=${data}`;
            xhr.onreadystatechange = function(){
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                let text = JSON.parse(xhr.response);
                location.reload();
                }
            }
            xhr.open('POST','Assets/PHP/check.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(parms);
    }
        function vi(){
            let xhr = new XMLHttpRequest(); 

            let parms = `action=getUserData`;
            xhr.onreadystatechange = function(){
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                    let text = JSON.parse(xhr.response);
                    
                    console.log(text);
                    text.forEach(element => {
                        console.log(element);
                        let div = document.createElement('tr');
                        div.className = "card";
                        div.innerHTML = `
                        <td>${element[0]}</td>
                        <td>${element['full_name']}</td>
                        <td>${element['auto']}</td>
                        <td>${element['problem']}</td>
                        <td>${element['name']}</td>
                        <td>${element['booking_datetime']}</td>
                        <td><input type="button" class="buttonvhod" name="vhod" onclick="check(${element[0]},1)" value="Подтвердить">
                        <input type="button" class="buttonvhod" name="vhod" onclick="check(${element[0]},2)" value="Отказать"></td>
                        `;
                        let cards = document.getElementsByClassName('cards');
                        cards[0].append(div)});
                }
            }
            xhr.open('POST','Assets/PHP/vivodadm.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(parms);
        }
        
    </script>

</body>
</html>