<?php


// //funkcijos uzrasomos taip:
// $skaicius1 = 'As ir';
// $skaicius2 = 'Tu';

// function plus($stalas, $kede){
// print $stalas . $kede;
// }

// plus($skaicius1, $skaicius2);

//pirma uzduotis. sukurkite funkcija kuriai butu paduodami du parametrai ribos nuo kiek iki kiek snekant apie metus pvvz 1790-2020 i funkcijos vidu.
//parasyti koda, kuris ekrane sukurtu imputa su pasirinkimo variantais. kad mum sukurtu selectoriu automatiskai, kad nereiketu irasineti visu reiksmiu nuo 1790-2020
//hint: funkcijos viduje reikes irasyti for.



// function input($nuo, $iki){
//     print '<select>';
//     for ($x=$nuo; $x<=$iki; $x++) { 
//        print "<option value='$x'>" . $x . "</option>";
//     }
//     print '</select>';
// }

//antra uzduotis
// function logo(){
//     print "<h1>logo</h1>";

// }

// logo();


$servername = 'localhost';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=testine", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


function get($conn, $sql)
{

    $stmt = $conn->query($sql);               //sios dvi eilutes jungiasi prie musu diuomenu bazes ir gauna atsakyma is duomenu bazes is $sql. tada tuos bisus duomenis $stmt filtruojame pagal getchALL PDO::FETCH_OBJ kad gautume objektus kurie turi savyje tvarkingai ID NAME ir t.t issivardumpine matysime rezultata vardumpiname siuo atveju su  $user 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  //sios dvi eilutes

}
$sql = "SELECT * FROM `users` WHERE 1";
var_dump(get($conn, $sql));

function table($data)
{
    print '<table>';
    foreach (array_keys($data[0]) as $value) {
        print '<th>' . $value . '</th>';
    }
    foreach ($data as $users) {
        print '<tr>';
        foreach ($users as $user) {
            print '<td>' . $user . '</td>';
        }
        print '</tr>';
    }
    print '</table>';
}
table(get($conn, $sql));


$userPet = "SELECT `name`, `email`, `pet_name` FROM `gyvunai`, `users` WHERE `id` = `user_id`";
table(get($conn, $userPet));
// 



//trecia uzduotis mysql duomenu bazes
function form()
{
    print "<form method='post'><input type='email' placeholder='Email' name='email'><input type='password' placeholder='Password' name='password'><button name='button' type='submit'>Siusti</button></form>";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $button = $_POST['button'];

    if (isset($button)) {


        if (!empty($email) && !empty($password)) {
            print 'Tavo el. pastas yra:' . $email . "<br>" . 'Tavo slaptazodis yra:' . $password;
        } else {
            print "Klaidingai ivesti duomenys";
        }
    }
}

form();
