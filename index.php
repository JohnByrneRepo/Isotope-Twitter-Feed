<!doctype html>
<html lang="en">
    <head>

        <?php include 'twitter/getfeed.php'; ?>
        <script src="js/jquery-1.7.1.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <link rel="stylesheet" href="css/style.css" />

        <meta charset="utf-8" />
        <title>Isotope Twitter Feed</title>

        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

        <link rel="stylesheet" href="css/style.css" />

        <!-- scripts at bottom of page -->

    </head>

    <body>
        <h1>Twitter Feed</h1>

        <section id="copy">
          <p>Showing recent posts of @<?php echo $twitteruser; ?>.</p>
        </section>

        <br>

        <form action="index.php" method="post">
            <div id="profileName">Twitter id <input type="text" name="id" size="26"></div>
            <div id="profileName">Post count <input type="text" name="posts" size="26"></div>
            <input type="submit" value="Refresh" name="commit" id="submit" class="button"/>
        </form>
        
 <!--
        <br>
        <br>
       
        <h1>Sort</h1>

        <ul id="sort-by" class="option-set clearfix" data-option-key="sortBy">
          <li><a href="#sortBy=original-order" data-option-value="original-order" class="selected" data>default</a></li>
          <li><a href="#sortBy=name" data-option-value="name">name</a></li>
          <li><a href="#sortBy=random" data-option-value="random">random</a></li>
        </ul>
 -->       
        <br>
        <br>
       
        <script>

            $(document).ready(function () {

                var $container = $('#container');
                $items = $('.item');

                $container.isotope({
                    itemSelector: '.item',
                    masonry: {
                        columnWidth: 90
                    },
                    getSortData: {
                        selected: function ($item) {
                            return ($item.hasClass('selected') ? -1000 : 0) + $item.index();
                        }
                    },
                    sortBy: 'selected'
                });
    /*
                $('.item').click(function () {

                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                        $(this).children('.maximise').hide();
                        $(this).children('.minimise').show();
                    } else {
                        $(this).addClass('selected');
                        $(this).children('.minimise').hide();
                        $(this).children('.maximise').show();
                    }

                    //$container.isotope('shuffle');
                    $container.isotope('reLayout');
                });
    */
            });
        </script>

        <div id="wrapper">
        <div id="container">
            <script>
                var tweetDates = <?php echo json_encode($tweetDates); ?>;
                var tweets = <?php echo json_encode($tweets); ?>;
                var profileImages = <?php echo json_encode($profileImages); ?>;

                for (i = 0; i < tweets.length; i++) {

                    var date = tweetDates[i].substring(0, 11);
                    var time = tweetDates[i].substring(11, 16);

                    var day = date.substring(0, 3);
                    var month = date.substring(4, 7);
                    var dayOfMonth = date.substring(8, 10);

                    switch (day) {
                        case "Mon": day = "Monday"; break;
                        case "Tue": day = "Tuesday"; break;
                        case "Wed": day = "Wednesday"; break;
                        case "Thu": day = "Thursday"; break;
                        case "Fri": day = "Friday"; break;
                        case "Sat": day = "Saturday"; break;      
                        case "Sun": day = "Sunday"; break;      
                    }
                    switch (month) {
                        case "Jan": month = "January"; break;
                        case "Feb": month = "February"; break;
                        case "Mar": month = "March"; break;
                        case "Apr": month = "April"; break;
                        case "May": month = "May"; break;
                        case "Jun": month = "June"; break;      
                        case "Jul": month = "July"; break;      
                        case "Aug": month = "August"; break;  
                        case "Sep": month = "September"; break;  
                        case "Oct": month = "October"; break;  
                        case "Nov": month = "November"; break;  
                        case "Dec": month = "December"; break;  
                    }
                     switch (dayOfMonth) {
                        case "01": dayOfMonth = "1st"; break;
                        case "02": dayOfMonth = "2nd"; break;
                        case "03": dayOfMonth = "3rd"; break;
                        case "04": dayOfMonth = "4th"; break;
                        case "05": dayOfMonth = "5th"; break;
                        case "06": dayOfMonth = "6th"; break;      
                        case "07": dayOfMonth = "7th"; break;      
                        case "08": dayOfMonth = "8th"; break;  
                        case "09": dayOfMonth = "9th"; break;  
                        case "10": dayOfMonth = "10th"; break;  
                        case "11": dayOfMonth = "11th"; break;  
                        case "12": dayOfMonth = "12th"; break;  
                        case "13": dayOfMonth = "13th"; break;  
                        case "14": dayOfMonth = "14th"; break;  
                        case "15": dayOfMonth = "15th"; break;  
                        case "16": dayOfMonth = "16th"; break;  
                        case "17": dayOfMonth = "17th"; break;  
                        case "18": dayOfMonth = "18th"; break;  
                        case "19": dayOfMonth = "19th"; break;  
                        case "20": dayOfMonth = "20th"; break;  
                        case "21": dayOfMonth = "21st"; break;  
                        case "22": dayOfMonth = "22nd"; break;  
                        case "23": dayOfMonth = "23rd"; break;  
                        case "24": dayOfMonth = "24th"; break;  
                        case "25": dayOfMonth = "25th"; break;  
                        case "26": dayOfMonth = "26th"; break;  
                        case "27": dayOfMonth = "27th"; break;  
                        case "28": dayOfMonth = "28th"; break;  
                        case "29": dayOfMonth = "29th"; break;  
                        case "30": dayOfMonth = "30th"; break;  
                        case "31": dayOfMonth = "31st"; break;              
                    } 

                    /*if (i === 0) {
                        alert("day = " + day);
                        alert("month = " + month);
                        alert("dayOfMonth = |" + dayOfMonth + "|");
                    }*/

                    date = day + " " + dayOfMonth + " " + month;

                    if (tweets[i].substring(0, 2) === "RT") {
                        date = "Retweet on " + date;
                    } else {
                        date = "Tweet on " + date;
                    }

                    var divItem = document.createElement("div");
                    divItem.setAttribute("class", "item");

                    var divMinimise = document.createElement("div");
                    divMinimise.setAttribute("class", "minimise");

                    var h1 = document.createElement("h1");
                    h1.innerHTML = date;

                    var img = document.createElement("img");
                    img.src = profileImages[i];
                    img.width = img.height = 48;

                    var p1 = document.createElement("p");
                    p1.innerHTML = tweets[i];

                    var p2 = document.createElement("p");
                    p2.innerHTML = "Posted at: " + time;

                    document.getElementById("container").appendChild(divItem);
                    divItem.appendChild(divMinimise);
                    divMinimise.appendChild(h1);
                    divMinimise.appendChild(img);
                    divMinimise.appendChild(p1);
                    divMinimise.appendChild(p2);

                }    

            // see http://jsfiddle.net/ub3UD/98/

            </script>
        </div>
        </div>
    </body>
</html>