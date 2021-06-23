<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="App/View/js/javascript.js"></script>
    <link rel="stylesheet" href="App/View/css/style.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style type="text/css">
        .pagination {
          display: block;
          width: 75%;
          margin: 2em auto;
          text-align: center;
        }
        .pagination:after {
          content: "";
          clear: both;
        }
        .pagination-button {
          display: inline-block;
          padding: 5px 10px;
          border: 1px solid #e0e0e0;
          background-color: #eee;
          color: #333;
          cursor: pointer;
          transition: background 0.1s, color 0.1s;
        }
        .pagination-button:hover {
          background-color: #ddd;
          color: #3366cc;
        }
        .pagination-button.active {
          background-color: #bbb;
          border-color: #bbb;
          color: #3366cc;
        }
        .pagination-button:first-of-type {
          border-radius: 18px 0 0 18px;
        }
        .pagination-button:last-of-type {
          border-radius: 0 18px 18px 0;
        }
        .heading {
          text-align: center;
          max-width: 500px;
          margin: 20px auto;
        }
        .article-loop {
          display: block;
          width: 75%;
          padding: 1em 2em;
          margin: 1em auto;
          border: 1px solid #ddd;
          background-color: #ededed;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="homepage">
        <?php include_once ("App/View/includes/header.php"); ?>
        <div class="main-page">
            <h1 class="heading">Books</h1>
            <div id="page-content">
                
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    var totalPageNum = 0;
    (function($){
        var paginate = {
            totalPages: function(items, perPage) {
                return Math.ceil(items / perPage);
            },
            createBtns: function(totalPages, currentPage) {
                var pagination = $('<div class="pagination" />');
                pagination.append('<span class="pagination-button">&laquo;</span>');
                for (var i=1; i <= totalPages; i++) {
                    if (totalPages > 5 && currentPage !== i) {
                        if (currentPage === 1 || currentPage === 2) {
                            if (i > 5) continue;
                        } else if (currentPage === totalPages || currentPage === totalPages - 1) {
                            if (i < totalPages - 4) continue;
                        } else {
                            if (i < currentPage - 2 || i > currentPage + 2) {
                                continue; }
                        }
                    }
                    var pageBtn = $('<span class="pagination-button page-num" />');
                    if (i == currentPage) {
                        pageBtn.addClass('active'); }
                    pageBtn.text(i);
                    pagination.append(pageBtn);
                }
                pagination.append($('<span class="pagination-button">&raquo;</span>'));
                return pagination;
            },
            createPage: function(currentPage, perPage, totalPage) {
                $('.pagination').remove();
                $.ajax({
                    url:"/App/Controller/functions.php?id=bycategory",
                    type: "post",
                    dataType: 'json',
                    data: {
                        current: currentPage,
                        perpage: perPage,
                        category: 1
                    },
                    success: function (res) {
                        console.log(res)
                        $('#page-content').html('');
                        var html = "";
                        for(x in res) {
                            if(x%2==0){
                                html += '<div class="blog-card" onclick="goLink(\''+res[x].blog_url+'\')"><div class="meta">';
                                html += '<div class="photo" style="background-image: url('+res[x].blog_photo+')"></div>';
                                html += '<ul class="details"><li class="date">'+res[x].blog_pub_date+'</li></ul></div>';
                                html += '<div class="description"><label class="blog-title">'+res[x].blog_title+'</label>';
                                html += '<p style="padding-bottom: 30px;">'+res[x].blog_description+'</p>';
                                html += '<div class="blog-from"><img src="'+res[x].blog_href+'" class="blog-favicon"/>&nbsp;<a href="#">'+res[x].blog_sitename+'</a></div>';
                                html += '</div></div>';
                            } else {
                                html += '<div class="blog-card alt" onclick="goLink(\''+res[x].blog_url+'\')"><div class="meta">';
                                html += '<div class="photo" style="background-image: url('+res[x].blog_photo+')"></div>';
                                html += '<ul class="details"><li class="date">'+res[x].blog_pub_date+'</li></ul></div>';
                                html += '<div class="description"><label class="blog-title">'+res[x].blog_title+'</label>';
                                html += '<p style="padding-bottom: 30px;">'+res[x].blog_description+'</p>';
                                html += '<div class="blog-from"><img src="'+res[x].blog_href+'" class="blog-favicon"/>&nbsp;<a href="#">'+res[x].blog_sitename+'</a></div>';
                                html += '</div></div>';
                            }
                        }
                        $('#page-content').html(html);
                    },
                    error: function(err){
                        console.log(err)
                    }
                });
                var container = $('#page-content');
                var totalPages = this.totalPages(totalPage, perPage),
                pageButtons = this.createBtns(totalPages, currentPage);
                container.after(pageButtons);
            }
        };

        $.fn.paginate = function(perPage, totalPage) {
            if (isNaN(perPage) || perPage === undefined) {
                perPage = 5; }
            if (totalPage <= perPage) {
                $.ajax({
                    url:"/App/Controller/functions.php?id=bycategory",
                    type: "post",
                    dataType: 'json',
                    data: {
                        current: 1,
                        perpage: perPage,
                        category: 1
                    },
                    success: function (res) {
                        console.log(res)
                        $('#page-content').html('');
                        var html = "";
                        for(x in res) {
                            if(x%2==0){
                                html += '<div class="blog-card" onclick="goLink(\''+res[x].blog_url+'\')"><div class="meta">';
                                html += '<div class="photo" style="background-image: url('+res[x].blog_photo+')"></div>';
                                html += '<ul class="details"><li class="date">'+res[x].blog_pub_date+'</li></ul></div>';
                                html += '<div class="description"><label class="blog-title">'+res[x].blog_title+'</label>';
                                html += '<p style="padding-bottom: 30px;">'+res[x].blog_description+'</p>';
                                html += '<div class="blog-from"><img src="'+res[x].blog_href+'" class="blog-favicon"/>&nbsp;<a href="#">'+res[x].blog_sitename+'</a></div>';
                                html += '</div></div>';
                            } else {
                                html += '<div class="blog-card alt" onclick="goLink(\''+res[x].blog_url+'\')"><div class="meta">';
                                html += '<div class="photo" style="background-image: url('+res[x].blog_photo+')"></div>';
                                html += '<ul class="details"><li class="date">'+res[x].blog_pub_date+'</li></ul></div>';
                                html += '<div class="description"><label class="blog-title">'+res[x].blog_title+'</label>';
                                html += '<p style="padding-bottom: 30px;">'+res[x].blog_description+'</p>';
                                html += '<div class="blog-from"><img src="'+res[x].blog_href+'" class="blog-favicon"/>&nbsp;<a href="#">'+res[x].blog_sitename+'</a></div>';
                                html += '</div></div>';
                            }
                        }
                        $('#page-content').html(html);
                    },
                    error: function(err){
                        console.log(err)
                    }
                });
                return true;
            }
            paginate.createPage(1, perPage, totalPage);
            $(document).on('click', '.pagination-button', function(e) {
                var currentPage = parseInt($('.pagination-button.active').text(), 10),
                    newPage = currentPage,
                    totalPages = paginate.totalPages(totalPage, perPage),
                    target = $(e.target);
                newPage = parseInt(target.text(), 10);
                if (target.text() == '«') newPage = 1;
                if (target.text() == '»') newPage = totalPages;
                if (newPage > 0 && newPage <= totalPages) {
                    paginate.createPage(newPage, perPage, totalPage); 
                }
            });
        };

    })(jQuery);

    $.ajax({
        url:"App/Controller/functions.php?id=category",
        type: "post",
        dataType: 'json',
        data: {category: 1},
        success: function (res) {
            console.log(res);
            totalPageNum = res*1;
            $('.article-loop').paginate(4, totalPageNum);
        },
        error: function(err){
            console.log(err)
        }
    });

    function goLink(link) {
        console.log(link)
         window.open( link, "_blank");
    }

</script>

</html>