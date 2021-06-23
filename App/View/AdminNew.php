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
    <title>New Blog</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="/App/View/css/animate.css" rel="stylesheet">
    <link href="/App/View/css/styleforadmin.css" rel="stylesheet">
    <link rel="stylesheet" href="/App/View/css/style.css">
    <link rel="stylesheet" href="/App/View/css/toastr.min.css">
    <style type="text/css">
        #wrapper {
            /*padding-bottom: 30px;*/
        }
        .main-container {
            margin-top: 30px;
            padding: 20px;
        }
        .link-preview {
            margin-top: 30px;
            padding: 0px 20px 30px 20px;
        }
        .link-preview #preview_image {
            width: auto;
            max-width: 300px;
            height: 200px;
            min-width: 250px;
            object-fit: cover;
        }
        .link-preview #preview_title {
            margin-top: 0px;
            width: 100%;
        }
        .link-preview .imageandesc {
            margin-bottom: 10px;
            display: flex;
            flex-direction: row;
        }
        .link-preview .imageandesc #preview_summary {
            padding-top: 10px;
            margin-left: 10px;
        }
        .link-preview #preview_favicon {
            width: 25px;
            height: 25px;
        }
        .link-preview .favandname {
            display: flex;
            flex-direction: row;
        }
        .link-preview #preview_site {
            margin-left: 10px;

        }
        .publish-btn {
            justify-content: space-between;
            display: flex;
            padding-right: 20px;
            padding-left: 20px;
            padding-bottom: 40px;
            align-items: center;
        }
        .publish-btn select {
            width: 200px;
            height: 40px;
        }
        .publish-btn .category_div {
            display: grid;
        }
        .publish-btn .datepicker {
            height: 40px;
            width: 220px;
        }
        .publish-btn button {
            height: 50px;
        }
        .before-publish {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
        }
        .before-publish .date_picker {
            margin-left: 30px;
        }
        .warning-message {
            color: red;
            font-size: 12px;
            display: none;
        }
        .loading-container {
            display: flex;
            position: absolute;
            z-index: 9999999;
            width: 100%;
            height: 100vh;
            background-color: rgba(20, 20, 20, 0.7);
            text-align: center;
            align-items: center;
            justify-content: center;
        }
        .loading-image {
            background: white;
            border-radius: 30px;
            padding: 20px;
            width: 170px;
        }
        #loading-container {
            display: none;
        }
        @media screen and (max-width: 650px) {
           .link-preview .imageandesc {
                display: flex;
                flex-direction: column;
            }
            .link-preview .imageandesc #preview_summary {
                margin-left: 0px;
            }
            .link-preview #preview_title {
                width: 100%;
            }
            .publish-btn {
                justify-content: space-between;
                display: flex;
                flex-direction: column;
                padding-right: 20px;
                padding-left: 20px;
                align-content: center;
                align-items: center;
                padding-bottom: 50px;
            }
            .publish-btn .category_div {
                width: 100%;
                margin-bottom: 15px;
            }
            .publish-btn .date_picker {
                width: 100%;
                margin-bottom: 15px;
            }
            .publish-btn button {
                margin-top: 30px;
                width: 50%;
            }
            .publish-btn select {
                width: 100%;
            }
            .publish-btn .datepicker {
                width: 100%;
            }
            .before-publish {
                flex-direction: column;
                width: 100%;
            }
            .before-publish .date_picker {
                margin-left: 0px;
            }
            .link-preview #preview_image {
                object-fit: fill;
            }
        }
    </style>
</head>
<body>

    <div id="loading-container">
        <div class="loading-container" >
            <img src="/App/View/img/loading.svg" class="loading-image">
        </div>
    </div>  
    <div id="wrapper">
        <?php include_once ("App/View/includes/adminHeader.php"); ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Add New Blog</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Admin</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>New</a>
                    </li>
                </ol>
            </div>
            
        </div>
        <div class="main-container">
            <label>Add new link</label>
            <input type="text" name="" class="form-control" id="link_form"  placeholder="Enter a Blog Link">
            <label for="published_date" class="warning-message" id="warn-for-link">* Please add a blog link</label>
            <div class="link-preview" id="link_preview">
                <label>Preview</label>
                <h2 id="preview_title">Title of blog</h2>
                <div class="imageandesc">
                    <img src="/App/View/img/Vynil.svg" id="preview_image" alt="Banner image">
                    <h4 id="preview_summary">Description...</h4>
                </div>
                <div class="favandname">
                    <img src="/App/View/img/default_fav.png" id="preview_favicon">
                    <h5 id="preview_site">Site Name...</h5>
                </div>
            </div> 
        </div>
        <div class="publish-btn">
            <div class="before-publish">
                <div class="category_div">
                    <label for="category_select">Category Name</label>
                    <select class="form-select" aria-label="Default select example" id="category_select">
                        <option value="1">Books</option>
                        <option value="2">Record Store</option>
                        <option value="3">Vinyl Records Market</option>
                    </select>
                </div>
                <div class="date_picker">
                    <label for="published_date">Published Date</label>
                    <input class="datepicker form-control" type="date" id="published_date" data-date-format="mm/dd/yyyy" >
                    <label for="published_date" class="warning-message" id="warn-for-date">* Please select a published date</label>
                </div>
            </div>
            <button class="btn btn-success" onclick="publishing()">Publish</button>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/App/View/js/popper.min.js"></script>
    <script src="/App/View/js/inspinia.js"></script>
    <script src="/App/View/js/pace.min.js"></script>
    <script src="/App/View/js/toastr.min.js"></script>
    <script>
        var favicon_id, pre_image, pre_title, pre_desc, pre_sitename;
        $(document).ready(function(){
            var floor;
            var enterKey = 13;
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
            // $(document).keydown(function(e) {
            //     if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
            // }).keyup(function(e) {
            //     if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = false;
            // });
            $("#link_form").keydown(function(e) {
                if (e.keyCode == enterKey ){
                    console.log(e.target.value);
                    linkPreview(e.target.value);                }
            });
        })
        function validURL(str) {
            try {
                new URL(str);
            } catch (e) {
                console.error(e);
                return false;
            }
            return true;
        }
        function linkPreview(link) {
            var validateLink = validURL(link);
            if(!validateLink){
                $("#warn-for-link").html('* This is an invalid link. Please add correct link.');
                $("#warn-for-link").show();
                return false;
            } else $("#warn-for-link").hide();
            // link = $("#link_form").val();
            let site = new URL("/", link);
            $("#loading-container").show();
            $.ajax({
                url:"/App/Controller/fetch.php",
                type: "post",
                dataType: 'json',
                data: { link },
                success: function (res) {
                    console.log(res);
                    pre_image = res.image;
                    pre_title = res.title;
                    pre_desc = res.description;
                    pre_sitename = site.hostname;

                    $("#preview_title").html(res.title);
                    $("#preview_image").attr("src", res.image);
                    $("#preview_summary").html(res.description);
                    if(res.favicon === 'none'){
                        $("#preview_favicon").attr("src", "/App/View/img/default_fav.png");
                        favicon_id = '';
                    }
                    else if(res.favicon === ''){
                        favicon_id = site.href+"favicon.ico";
                        $("#preview_favicon").attr("src", favicon_id);
                    }
                    else {
                        favicon_id = res.favicon;
                        $("#preview_favicon").attr("src", res.favicon);
                    }
                    $("#preview_site").html(site.hostname);
                    $("#loading-container").hide();
                },
                error: function(err){
                    console.log(err)
                }
            })
        }
        function publishing() {
            favicon = favicon_id;
            link = $('#link_form').val();
            if(!link){
                $("#warn-for-link").html('* Please add a blog link');
                $("#warn-for-link").show();
                $("#link_form").focus();
                return false;
            } else $("#warn-for-link").hide();

            photo = pre_image;
            title = pre_title;
            description = pre_desc;
            pubdate = $('#published_date').val();

            if(!pubdate){
                $("#warn-for-date").show();
                $("#published_date").focus();
                return false;
            } else $("#warn-for-date").hide();

            sitename = pre_sitename;
            category = $('#category_select').val();

            reqData = {
                link, photo, title, description, pubdate, sitename, category, favicon
            }
            console.log(reqData);
            $.ajax({
                url:"/App/Controller/functions.php?id=newblog",
                type: "post",
                dataType: 'text',
                data: reqData,
                success: function (res) {
                    console.log(res)
                    if(res === "success") {
                        toastr.success("Succeed in publishing")
                    }else if(res === "existed"){
                        toastr.info("Already existing.");
                    }else if(res === "invalid link"){
                        toastr.error("Input correct link.")
                    }else {
                        toastr.error("An Error has occured")
                    }
                },
                error: function(err){
                    console.log(err)
                }
            });
        }
        function keypress(e) {
            console.log(e)
        }
    </script>
</body>
</html>
