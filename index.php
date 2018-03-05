<?php
//API call goes  here
   $backgroundImage = "./img/sea.jpg";
    if(isset($_GET['keyword'])){
        include 'api/pixabayAPI.php';
        $keyword = $_GET['keyword'];
        if(!isset($keyword) || trim($keyword) == ''){
            $imageURLs = getImageURLs($_GET['category'], $_GET['layout']);
        } else{
            $imageURLs = getImageURLs($_GET['keyword'], $_GET['layout']);
        }
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    } else{
         $backgroundImage = "./img/sea.jpg";
         echo hola;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <meta charset="utf-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <style>
            @import url("css/styles.css");
            body{
                background-image: url('<?=$backgroundImage ?>');
            }
        </style>
    </head>
    <body>
        <br /><br/>
        <?php
        if(!isset($imageURLs)){
            echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
            $backgroundImage = "./img/sea.jpg";
        } else {
        ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!--<h1> I'm a regulat HTML tag inside the PHP else statement! </h1>-->
        <ol class="carousel-indicators">
            <?php
                for($i=0; $i < 7; $i++){
                    echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                    echo ($i == 0)?" class='active'": "";
                    echo "></li>";
                }
            ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
                 for($i=0; $i<7; $i++){
                     do{
                         $randomIndex = rand(0, count($imageURLs));
                     } while(!isset($imageURLs[$randomIndex]));
                     //Display Carousel here
                    echo '<div class="item ';
                    echo ($i==0) ? "active" : "";
                    echo '">';
                    echo '<img src="' .$imageURLs[$randomIndex] . '">';
                    echo "</div>";
                    unset($imageURLs[$randomIndex]);
                }
            ?>
        </div>
        <!-- HTML form goes here -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
        <?php
            } //End of the else statement 
        ?>
        <br>
        <form>
            
            <input type="text" name="keyword" placeholder="Keyword" value>
            <br /><br />
            <div id = "layoutDiv">
                <!--<input type="text" name="keyword" placeholder = "keyword" value="<?=$_GET['keyword']?>"/>-->
                <input type = "radio" id="lhorizontal" name="layout" value = "horizontal">
                <label for = "Horizontal"></label><label for="lhorizontal">Horizontal</label>
                <input type="radio" id="lvertical" name = "layout" value = "vertical">
                <label for = "Vertical"></label><label for="lvertical">Vertical</label>
            </div>
            <br />
            <select name = "category">
                <option value = "">Select One</option>
                <option value = "ocean">Sea</option>
                <option>Forest</option>
                <option>Mountain</option>
                <option>Snow</option>
            </select><br /><br />
            <input type="submit" value="Search" />
        </form>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
    
</html>