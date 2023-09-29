<!doctype HTML>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Twój wskaźnik BMI</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="baner">
        <h2>Oblicz wskaźnik BMI</h2>
    </div>
    <div class="logo">
        <img src="wzor.png" alt="liczymy BMI"/>
    </div>
    <div class="left">
        <img src="rys1.png" alt="zrzuć kalorie"/>
    </div>
    <div class="right">
        <h1>Podaj dane</h1>
            <form action="waga.php" method="POST">
                <label>Waga: </label>
                    <input type="number" name="waga"/>
                <br>
                <label>Wzrost[cm]: </label>
                    <input type="number" name="wzrost"/>
                <br>
                <input type="submit" value="Licz BMI i zapisz wynik"/>
        <?php
        $host="localhost";
        $user="root";
        $password="";
        $nazwabazy="egzamin";

        $polaczenie=new mysqli($host,$user,$password,$nazwabazy);
        if($polaczenie->connect_error)
        {
            die("BLAD".$polaczenie->connect_error);
        }
        if(!empty($_POST['waga']) && !empty($_POST['wzrost'])){
            $waga=$_POST['waga'];
            $wzrost=$_POST['wzrost'];
            $BMI = ($waga/($wzrost*$wzrost))*10000;
            echo "Twoja waga: ".$waga.";"." Twój wzrost: ".$wzrost."<br>"."BMI wynosi: ".$BMI;
        
        if($BMI<19){
            $wartosc=1;
        }
        elseif($BMI>=19 && $BMI<26){
            $wartosc=2;
        }
        elseif($BMI>=26 && $BMI<31){
            $wartosc=3;
        }
        else{
            $wartosc=4;
        }
        $date=date('Y-m-d');
        
        $zapytanie="INSERT INTO wynik (id,bmi_id,data_pomiaru,wynik) VALUES ('',$wartosc,'$date',$BMI);";
        $wynik=$polaczenie->query($zapytanie);
        }
        $polaczenie->close();
        
        ?>
    </div>
    <div class="main">
        <table>
            <th>lp.</th><th>Interpretacja</th><th>zaczyna sie od..</th>
        <?php        
                  $polaczenie=new mysqli($host,$user,$password,$nazwabazy);
                  if($polaczenie->connect_error)
                    {
                    die("BLAD".$polaczenie->connect_error);
                    }
                    $zapytanie="SELECT id, informacja,wart_min,wart_max FROM bmi";
                    $wynik=$polaczenie->query($zapytanie);
                    while($wiersz=$wynik->fetch_assoc())
                    {
                        echo '<tr>';
                        echo '<td>'.$wiersz['id'].'</td>'.'<td>'.$wiersz['informacja'].'</td>'.'<td>'.$wiersz['wart_min'].'</td>';
                        echo '</tr>';
                    }
                    $polaczenie->close();
        ?>
        
        </table>
    </div>
    <div class="stopka">
        Autor: 0000000000000000
        <a href="kw2.jpg">wynik dzialania kwerendy 2</a>
    </div>




</body>
</html>