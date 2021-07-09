<?php

    $weather = "";
    $error = "";

  if(array_key_exists('city', $_GET)){
      
      $city = str_replace(' ', '', $_GET['city']);
      
      $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
      
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            
            $error = "That city could not be found";
            
        } else {
      
      $forecastpage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
      
      $pagearray = explode('(1&ndash;3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastpage);
            
        if(sizeof ($pagearray) > 1){
      
            $second_page_array = explode('</span></p></td><td class="b-forecast__table-description-cell--js" colspan="9">', $pagearray[1]);
            
                if (sizeof ($second_page_array) > 1) {
      
                    $weather = $second_page_array[0];
                    
                } else {
                    
                    $error = "That city could not be found";
                    
                }
            
            
        } else {
            
            $error = "That city could not be found";
            
        }
                
     }
      
  }  

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      
    <style type="text/css">
    
        html{
            
            background: url('./thomas-de-luze-2uqAzqtOCXQ-unsplash.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            
        }
        
        body{
            
            background: none;
            
        }
        
        .container{
            
            text-align: center;
            margin-top: 100px;
            width: 450px;
        }
        
        input{
            
            margin: 20px 0px;
            
        }
        
        #weather{
            
            margin-top: 15px;
            
        }
        
    </style>

    <title>weather scraper</title>
      
  </head>
    
  <body>
      
      <div class="container">
      
        <h1>What's The Weather?</h1>
      
      <form>
        <fieldset class="form-group">
        <label for="city">Enter the name of a city</label>  
        <input type="text" class="form-control" name="city" id="city" placeholder="Eg, Bhopal, Tokyo" value="<?php
            
            if(array_key_exists('city', $_GET)){
                
            echo $_GET['city'];
                
            }
                                                                                                             
        ?>">
          
        </fieldset>
    
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
          
          <div id="weather"><?php 
              
            if($weather){
                
                echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                 
            } else if ($error){
                
                
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                
            } 
              
              
              
            ?></div>

      </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>
