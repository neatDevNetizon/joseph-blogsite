<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="App/View/js/javascript.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="App/View/css/style.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style type="text/css">
    	.pagination {
          display: block;
          width: 75%;
          margin: 1em auto;
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

        /* arbitrary styles */
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
            <h1 class="heading">All blogs</h1>
            <p class="heading">You can see all of blogs over here</p>
            <div id="page-content">
                <div class="blog-card" >
                    <div class="meta">
                      <div class="photo" style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-1.jpg)"></div>
                      <ul class="details">
                        <li class="date">Aug. 24, 2015</li>
                      </ul>
                    </div>
                    <div class="description">
                      <h1>Learning to Code</h1>
                      <h2>Opening a door to the future</h2>
                      <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p>
                      <p class="read-more">
                        <a href="#">Read More</a>
                      </p>
                    </div>
                </div>
                <div class="blog-card alt">
                    <div class="meta">
                      <div class="photo" style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-2.jpg)"></div>
                      <ul class="details">
                        <li class="date">July. 15, 2015</li>
                      </ul>
                    </div>
                    <div class="description">
                      <h1>Mastering the Language</h1>
                      <h2>Java is not the same as JavaScript</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p>
                      <p class="read-more">
                        <a href="#">Read More</a>
                      </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    var totalPageNum = 0;
    
(function($){
    
    var paginate = {
        // startPos: function(pageNumber, perPage) {
        //     // determine what array position to start from
        //     // based on current page and # per page
        //     return pageNumber * perPage;
        // },

        // getPage: function(items, startPos, perPage) {
        //     // declare an empty array to hold our page items
        //     var page = [];

        //     // only get items after the starting position
        //     items = items.slice(startPos, items.length);

        //     // loop remaining items until max per page
        //     for (var i=0; i < perPage; i++) {
        //         page.push(items[i]); }

        //     return page;
        // },

        totalPages: function(items, perPage) {
            // determine total number of pages
            return Math.ceil(items / perPage);
        },

        createBtns: function(totalPages, currentPage) {
            // create buttons to manipulate current page
            var pagination = $('<div class="pagination" />');

            // add a "first" button
            pagination.append('<span class="pagination-button">&laquo;</span>');

            // add pages inbetween
            for (var i=1; i <= totalPages; i++) {
                // truncate list when too large
                if (totalPages > 5 && currentPage !== i) {
                    // if on first two pages
                    if (currentPage === 1 || currentPage === 2) {
                        // show first 5 pages
                        if (i > 5) continue;
                    // if on last two pages
                    } else if (currentPage === totalPages || currentPage === totalPages - 1) {
                        // show last 5 pages
                        if (i < totalPages - 4) continue;
                    // otherwise show 5 pages w/ current in middle
                    } else {
                        if (i < currentPage - 2 || i > currentPage + 2) {
                            continue; }
                    }
                }

                // markup for page button
                var pageBtn = $('<span class="pagination-button page-num" />');

                // add active class for current page
                if (i == currentPage) {
                    pageBtn.addClass('active'); }

                // set text to the page number
                pageBtn.text(i);

                // add button to the container
                pagination.append(pageBtn);
            }

            // add a "last" button
            pagination.append($('<span class="pagination-button">&raquo;</span>'));

            return pagination;
        },

        createPage: function(currentPage, perPage, totalPage) {
            $('.pagination').remove();
            $.ajax({
                url:"/App/Controller/functions.php?id=page",
                type: "post",
                dataType: 'json',
                data: {
                    current: currentPage,
                    perpage: perPage
                },
                success: function (res) {
                    $('#page-content').html('');
                    var html = "";
                    for(x in res) {
                        if(x%2==1){
                            html += '<div class="blog-card" ><div class="meta"><div class="photo" style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-1.jpg)"></div><ul class="details"><li class="date">Aug. 24, 2015</li></ul></div><div class="description"><h1>Learning to Code</h1><h2>Opening a door to the future</h2><p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p><p class="read-more"><a href="#">Read More</a></p></div></div>';
                        } else {
                            html += '<div class="blog-card alt" ><div class="meta"><div class="photo" style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-1.jpg)"></div><ul class="details"><li class="date">Aug. 24, 2015</li></ul></div><div class="description"><h1>Learning to Code</h1><h2>Opening a door to the future</h2><p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p><p class="read-more"><a href="#">Read More</a></p></div></div>';
                        }
                        
                    }
                    $('#page-content').html(html);

                },
                error: function(err){
                    console.log(err)
                }
            });
            var container = $('#page-content');
                // detach items from the page and cast as array
            //     items = items.detach().toArray(),
            //     // get start position and select items for page
            //     startPos = this.startPos(currentPage - 1, perPage),
            //     page = this.getPage(items, startPos, perPage);

            // // loop items and readd to page
            // $.each(page, function(){
            //     // prevent empty items that return as Window
            //     if (this.window === undefined) {
            //         container.append($(this)); }
            // });

            // prep pagination buttons and add to page
            var totalPages = this.totalPages(totalPage, perPage),
            pageButtons = this.createBtns(totalPages, currentPage);
            container.after(pageButtons);
        }
    };

    // stuff it all into a jQuery method!
    $.fn.paginate = function(perPage, totalPage) {
        // default perPage to 5
        if (isNaN(perPage) || perPage === undefined) {
            perPage = 5; }

        // don't fire if fewer items than perPage
        if (totalPage <= perPage) {
            return true; }

        // ensure items stay in the same DOM position
        // if (items.length !== totalPage) {
        //     items.wrapAll('<div class="pagination-items" />');
        // }

        // paginate the items starting at page 1
        paginate.createPage(1, perPage, totalPage);

        // handle click events on the buttons
        $(document).on('click', '.pagination-button', function(e) {
            var currentPage = parseInt($('.pagination-button.active').text(), 10),
                newPage = currentPage,
                totalPages = paginate.totalPages(totalPage, perPage),
                target = $(e.target);
            // get numbered page
            newPage = parseInt(target.text(), 10);
            if (target.text() == '«') newPage = 1;
            if (target.text() == '»') newPage = totalPages;

            // ensure newPage is in available range
            if (newPage > 0 && newPage <= totalPages) {
                paginate.createPage(newPage, perPage, totalPage); 
            }
        });
    };

})(jQuery);
    $.ajax({
        url:"App/Controller/functions.php?id=allrow",
        type: "post",
        dataType: 'json',
        success: function (res) {
           totalPageNum = res*1;
           $('.article-loop').paginate(4, totalPageNum);
        },
        error: function(err){
            console.log(err)
        }
    });

/* This part is just for the demo,
not actually part of the plugin */

</script>

</html>