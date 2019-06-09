<?php
function get_select()
{
    global $db;
    $veriler = array();
    $islem = $db->prepare("SELECT * FROM filmler");
    $islem->execute();
    foreach ($islem as $row)
    {
        $tRow["film_id"] = $row["film_id"];
        $tRow["film_adi"] = $row["film_adi"];
        $tRow["film_turu"] = $row["film_turu"];
        $tRow["film_yili"] = $row["film_yili"];
        $tRow["film_imdb"] = $row["film_imdb"];
        $veriler[] = $tRow;
    }

    echo json_encode($veriler);
}

function get_insert($veri)
{
    global $db;
    extract($veri);
    $islem = $db->prepare("INSERT INTO filmler (film_adi, film_turu, film_yili, film_imdb) VALUES (?, ?, ?, ?)");
    $islem->execute(array(trim($name), trim($sort), trim($year), trim($imdb)));
    if ($islem)
    {
        $data["film_id"] = $db->lastInsertId();
        $data["film_adi"] = trim($name);
        $data["film_turu"] = trim($sort);
        $data["film_yili"] = trim($year);
        $data["film_imdb"] = trim($imdb);
        echo json_encode($data);
    }
    else
        echo false;
}

function get_delete($veri)
{
    global $db;
    $islem = $db->prepare("DELETE FROM filmler WHERE film_id=?");
    $islem->execute(array(trim($veri)));
    if ($islem)
    {
        $data['film_id'] = $veri;
        echo json_encode($data);
    }
    else
        echo false;
}

function get_update($veri)
{
    global $db;
    extract($veri);
    $islem = $db->prepare("UPDATE filmler SET film_adi=?, film_turu=?, film_yili=?, film_imdb=? WHERE film_id=?");
    $islem->execute(array($name, $sort, $year, $imdb, $id));
    if ($islem)
    {
        $data["film_id"] = $id;
        $data["film_adi"] = $name;
        $data["film_turu"] = $sort;
        $data["film_yili"] = $year;
        $data["film_imdb"] = $imdb;
        echo json_encode($data);
    }
    else
        echo false;
}