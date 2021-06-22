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

</head>

<body>

<div id="wrapper">
    <?php include_once ("App/View/includes/adminHeader.php"); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Posted Blog List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Blog List</a>
                </li>
            </ol>
        </div>
    </div>

</div>


<!-- Mainly scripts -->
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
</script>

</body>

</html>
