<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <script type="text/javascript" src="js/jquery-2.0.0.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/mycss.css">
    <title>
        SDK PHP
    </title>

</head>
<body>
<div class="container" style="margin-top:10% ">

    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Messi</div>
                <div class="panel-body"><img src="image/messi.jpg" class="img" style="width:100%" alt="Image"></div>
                <div class="panel-footer">
                    <img src="image/like.png">
                    <span id="count_like"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-danger">
                <div class="panel-heading">Ronaldo</div>
                <div class="panel-body"><img src="image/ronaldo.jpg" class="img" style="width:100%" alt="Image"></div>
                <div class="panel-footer">
                    <img src="image/love.png">
                    <span id="count_love"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-success">
                <div class="panel-heading">Mtp</div>
                <div class="panel-body"><img src="image/mtp.jpg" class="img" style="width:100%" alt="Image"></div>
                <div class="panel-footer">
                    <img src="image/haha.png">
                    <span id="count_haha"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="show"
<ul class="media-list">
</ul>
<script>
    // hay la y tuong vote cho ronal do vs messi nhe, kieu nhu yen miu vua vote cho ronaldo
    $(document).ready(function () {
        //set time = 1s, gui ajax yeu cau tra ve
        //minh chi hien thi la cai react muon nhat
        //tu dau nen de cac bien old ngoai ajax, ajx gui ve moi thay doi du lieu sau
        var old_like = 0;
        var old_love = 0;
        var old_haha = 0;
        var old_cmt = 0;
        setInterval(function () {

            $.ajax({
                url: 'all.php',
                type: 'get',
                dataType: 'json',
                success: function (all) {
                    var html = "";
                    var like = 0;
                    var love = 0;
                    var haha = 0;
                    //lay ra last two cmt
                    var last_cmt = all.last_cmt;

                    cmt = last_cmt.count;
                    //lay ra cac reactions
                    var reactions = all.reactions;
                    $.each(reactions, function (key, react) {

                        switch (react.type)
                        {
                            case 'LIKE': like++; break;
                            case 'LOVE': love++; break;
                            case 'HAHA': haha++; break;
                        }
                    });
                    ///hien 1 ra react muon nhat  // chen vao moi the html de hien thi ra toan bo cac react
                    for(var i=0; i<1; i++) {
                        switch (reactions[i].type) {
                            case 'LIKE' :
                                html += '<li class="media"> <div class="media-left"> <img class="media-object" src=" ' + reactions[i].pic_small + '" > </div> <div class="media-body"> <h4 class="media-heading">' + reactions[i].name + '</h4> vừa vote cho <strong>Messi</strong></div> </li>';
                                break;
                            case 'LOVE' :
                                html += '<li class="media"> <div class="media-left"> <img class="media-object" src=" ' + reactions[i].pic_small + '" > </div> <div class="media-body"> <h4 class="media-heading">' + reactions[i].name + '</h4> vừa vote cho <strong>Ronaldo</strong></div> </li>';
                                break;
                            case 'HAHA' :
                                html += '<li class="media"> <div class="media-left"> <img class="media-object" src=" ' + reactions[i].pic_small + '" > </div> <div class="media-body"> <h4 class="media-heading">' + reactions[i].name + '</h4> vừa vote cho <strong>MTP</strong></div> </li>';
                                break;

                        }
                    }
                    //neu co thay doi cmt, thi moi hien

                        if (old_cmt != cmt) {
                            html += '<li class="media"> <div class="media-left"> <img class="media-object" src=" ' + last_cmt.pic_small + '" > </div> <div class="media-body"> <h4 class="media-heading">' + last_cmt.from.name + '</h4>' + last_cmt.message + '</div> </li>';
                            $('.media-list').html(html);
                            old_cmt = cmt;
                        }

                    //neu co su thay doi react them react thi moi hien, hoac co nguoi cmt
                    if(haha != old_haha || like != old_like || love != old_love)
                    {
                        $('.media-list').html(html);
                    }
                    old_haha = haha;
                    old_like = like;
                    old_love = love;
                    $('#count_like').html(like);
                    $('#count_love').html(love);
                    $('#count_haha').html(haha);
                }
            });

        },1000);
    });

</script>

</body>
</html>