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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
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
    <div style="margin: 20px 10px 30px 10px;">
        <table id="example" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th width="50%">Title</th>
                <th width="20%">Publish Date</th>
                <th width="20%">Site Name</th>
                <th width="10%"></th>
            </tr>
        </thead>
        <tbody id="main-tbody">            
        </tbody>
    </table>
    </div>

</div>


<!-- Mainly scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/App/View/js/popper.min.js"></script>
<script src="/App/View/js/inspinia.js"></script>
<script src="/App/View/js/pace.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
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
        $.ajax({
            url:"/App/Controller/functions.php?id=blogs",
            type: "post",
            dataType: 'json',
            success: function (res) {
                console.log(res)
                tableData = "";
                for(x in res) {
                    tableData += "<tr><td>"+res[x].blog_title+"</td>";
                    tableData += "<td align='center'>"+res[x].blog_pub_date+"</td>";
                    tableData += "<td>"+res[x].blog_sitename+"</td>";
                    tableData += "<td><a href='#'>Delete</a></td></tr>";
                }
                
                $("#main-tbody").html(tableData);
                var table = $('#example').DataTable( {
                    lengthChange: false,
                    buttons: [ 'copy', 'excel', 'pdf' ]
                });
         
                table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );

            },
            error: function(err){
                console.log(err)
            }
        });
        
    });
</script>

</body>

</html>
