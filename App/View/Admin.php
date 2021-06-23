<?php 
    session_start();
    if(!isset($_SESSION['josid']) || !isset($_SESSION['josname'])) {
       header("Location: admin/login");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="/App/View/css/animate.css" rel="stylesheet">
    <link href="/App/View/css/styleforadmin.css" rel="stylesheet">
    <link rel="stylesheet" href="/App/View/css/style.css">
    <link rel="stylesheet" href="/App/View/css/codebase.min.css">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <style type="text/css">
    </style>
</head>

<body>

<div id="wrapper">
    <?php include_once ("App/View/includes/adminHeader.php"); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Dashboard</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Dashboard</a>
                </li>
            </ol>
        </div>
    </div>
    <div style="margin-top: 20px;">
        <div class="row gutters-tiny " data-toggle="appear">
            <div class="col-6 col-md-4 col-xl-4">
                <a class="block text-center" href="#">
                    <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-dusk">
                        <div class="ribbon-box" id="book_cate">1</div>
                        <p class="mt-5">
                            <span class="iconify" data-icon="mdi:book-open-page-variant" data-inline="false" style="color: white;" data-width="60" data-height="50"></span>
                        </p>
                        <p class="font-w600 text-white">Books Category</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-xl-4">
                <a class="block text-center" href="#">
                    <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-sea">
                        
                        <div class="ribbon-box" id="record_cate">1</div>
                        <p class="mt-5">
                            <span class="iconify" data-icon="mdi:record-rec" data-inline="false" style="color: white;" data-width="60" data-height="50"></span>
                        </p>
                        <p class="font-w600 text-white">Record Category</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-xl-4">
                <a class="block text-center" href="#">
                    <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-dusk">
                        
                        <div class="ribbon-box" id="vinyl_cate">1</div>
                        <p class="mt-5">
                            <span class="iconify" data-icon="bi:vinyl-fill" data-inline="false" style="color: white;" data-width="60" data-height="50"></span>
                        </p>
                        <p class="font-w600 text-white">Vinyl Category</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/App/View/js/popper.min.js"></script>
<script src="/App/View/js/inspinia.js"></script>
<script src="/App/View/js/pace.min.js"></script>
<script>
    $(document).ready(function(){
        var floor;
        $("#side-btn-top").click(function(){
            $("#leftsidebar").addClass('aaa');
            floor=1;
        });
         $('#page-wrapper').on("click", function(){
            if(floor==0){
                $("#leftsidebar").removeClass('aaa');
            }
            floor=0;
        });
    })
    $.ajax({
        url:"App/Controller/functions.php?id=dashboard",
        type: "post",
        dataType: 'json',
        success: function (res) {
            $('#book_cate').html(res[0].nums);
            $('#record_cate').html(res[1].nums);
            $('#vinyl_cate').html(res[2].nums);
        },
        error: function(err){
            console.log(err)
        }
    });
</script>
</body>
</html>
