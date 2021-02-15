<?php

    try{
            $pdo=new PDO(
                'mysql:host=localhost;dbname=temperature','root','nicolas',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }

        $statement=$pdo->prepare("SELECT date FROM temp order by id DESC LIMIT 15");
        $statement->execute();
        $datas = array();
        $datas['name'] = 'date';
        while($r=$statement->fetch(PDO::FETCH_ASSOC)) {
            $datas['data'][]=$r['date'];
        }

        $statement=$pdo->prepare("SELECT temperature FROM temp order by id DESC limit 15");
        $statement->execute();
        $datas1 = array();
        $datas1['name'] = 'temperature';
        while($rr=$statement->fetch(PDO::FETCH_ASSOC)) {
            $datas1['data'][]=$rr['temperature'];
        }


        $statement=$pdo->prepare("SELECT humidite FROM temp order by id DESC limit 15");
        $statement->execute();
        $datas2 = array();
        $datas2['name'] = 'humidite';
        while($rrr=$statement->fetch(PDO::FETCH_ASSOC)) {
            $datas2['data'][]=$rrr['humidite'];
        }


        $result = array();
        array_push($result,$datas);
        array_push($result,$datas1);
        array_push($result,$datas2);


        echo json_encode($result, JSON_NUMERIC_CHECK);
?>
