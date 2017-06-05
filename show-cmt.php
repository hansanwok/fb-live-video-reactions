<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <script type="text/javascript" src="jquery-2.0.0.min.js"></script>
    <title>
        SDK PHP
    </title>
    <style type="text/css">
        .name{
            color:blue;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php

require ('comments.php');
foreach ($last_two_cmt as $cmt) {
//chi hien thi ra 2 cmt muon nhat
    //lay ten qua pic qua id cmt tuy nhien chi lay 1, lay dc ma nhieu ten thi gui nhieu request co ma chet
    $response = $fb->get($cmt['from']['id'] . "?fields=picture{url}");
    $picture = $response->getGraphNode();
    $pic_arr = $picture->asArray();
    $cmt['pic_small'] = $pic_arr['picture']['url'];

    echo '<img src="' . $cmt['pic_small'] . '"/>';
    echo 'Id : ' . $cmt['from']['id'] . '<br>';
    echo $cmt['from']['name'] . '<br>';
    echo 'Noi dung : ' . $cmt['message'] . '<br>';
}
?>


</body>
</html>