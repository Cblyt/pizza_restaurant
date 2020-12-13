<?php
    $user_img = "/img/ed.jpg";
    $user_name = "Edward";
    $user_age = 19;
    $description = "I like to play golf!" ;
    $user_hobbie_img = "https://scontent-lhr8-1.cdninstagram.com/v/t51.2885-15/e35/s1080x1080/118293043_331826061299209_542746889509739950_n.jpg?_nc_ht=scontent-lhr8-1.cdninstagram.com&amp;_nc_cat=101&amp;_nc_ohc=UTH5cPbmoIkAX9gZjSX&amp;_nc_tp=15&amp;oh=1b3794ed174a5dbaf4d1fb90df38d49c&amp;oe=5FB8CD72";

    if ($user_age > 18)
    {
        echo "<h2>All about me! </h2>";
        echo "<img src='" . $user_img . "' height= '300'>";
        echo"<div
                <h3>Hello, my name is " . $user_name . ", " . $description . "</h3>
            </div>";
        echo "Here is a picture of me playing golf.<br />";
        echo "<img src='https://scontent-lhr8-1.cdninstagram.com/v/t51.2885-15/e35/s1080x1080/118293043_331826061299209_542746889509739950_n.jpg?_nc_ht=scontent-lhr8-1.cdninstagram.com&amp;_nc_cat=101&amp;_nc_ohc=UTH5cPbmoIkAX9gZjSX&amp;_nc_tp=15&amp;oh=1b3794ed174a5dbaf4d1fb90df38d49c&amp;oe=5FB8CD72' width=300> <br />";
        echo "Here is my <a href='www.instagram.com/de_armadillo/?hl=en'>Instagram</a> profile where I like to post pictures of me playing golf :) ";
    }
    else
    {
        echo "You are not old enough to view this content";
    }
?>