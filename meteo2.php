<?php

$apiKey = "18e81bcbd64836fdceda9ce1e8bb381e";
$cityId = $_GET['city'];
$openWeatherMapUrl = "http://api.openweathermap.org/data/2.5/forecast?id={$cityId}&appid={$apiKey}&units=metric&lang=it";



$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $openWeatherMapUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);



$currentTime = time();


//appena copiati da test

$list= $data->list;

// echo "<pre>";
// var_dump($data->city->name);
// echo "</pre>";

$primo=$list[0]->dt;

//se $domani é = a  $primo + 86400 stampalo, e fallo per 5 volte!


//con questo for each stampo le previosioni dei prossimi 5 gg alla stessa ora

$x = 86400;

foreach ($list as $item) {


  $day1= $primo +$x;
  $day2= $day1 +$x;
  $day3= $day2 +$x;
  $day4= $day3 +$x;
  

}

$primoStr=(date("l g:i a\ d-m-Y",$primo));


$arrGiorno = explode(" ",$primoStr);


$dayOftheWeek= $arrGiorno[0];



//con questo prendo il meteo di oggi

// for ($i=0; $i < count($list) ; $i++) { 

//   if(strpos(date("l g:i a\ d-m-Y",$list[$i]->dt), $dayOftheWeek) !== false){

//     var_dump(date("l g:i a\ d-m-Y",$list[$i]->dt));
//   }
  
// }




?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons"
    rel="stylesheet">
    <link rel="stylesheet" href="./style/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Previsioni per <?php echo $data->city->name; ?> </title>
  </head>
  <body>





    <div class="container">

        <div class="row">
               <div class="col-12 text-start m-5">
                <a href="/miometeo" class="btn btn-success">Torna indietro</a>
             </div>
              <div class="col-12">
                  <h1 class="text-tomato">Le previsoni di oggi per : <span class="text-warning"><?php echo $data->city->name; ?></span></h1>
              </div>
        
        </div>
        <div class="row">

           <?php for ($i=0; $i < count($list) ; $i++): ?>

                <?php if(strpos(date("l g:i a\ d-m-Y",$list[$i]->dt), $dayOftheWeek) !== false) : ?>

                      <div class="weather-card col-md-5 m-5">
                       <div>
                             <img src="<?php echo "http://openweathermap.org/img/wn/{$list[$i]->weather[0]->icon}@2x.png" ?>" alt="<?php echo $list[$i]->weather[0]->description; ?>" title="<?php echo $list[$i]->weather[0]->description; ?>" />
                          
                              <div class="main-weather">
                                  <h1><?php echo $data->city->name; ?></h1>
                                  <p><?php echo $list[$i]->weather[0]->description; ?></p>
                                  
                                  <p class="text-success"> <?php echo date("l g:i a\ d-m-Y",$list[$i]->dt);  ?></p>
                              </div>
                          </div>

                              <div class="temperature">
                              <span><span class="material-icons temp-max">thermostat</span>Temp. Max: <?php echo $list[$i]->main->temp_max; ?>°C</span>
                              <span><span class="material-icons temp-min">thermostat</span>Temp. Min: <?php echo $list[$i]->main->temp_min; ?>°C</span>
                              </div>
                          
                      </div>

            
             <?php endif; ?>
  
         <?php endfor; ?>
        </div>
    </div>  
    

    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1>Le previsioni per i prossimi giorni a <span class="text-warning"><?php echo $data->city->name; ?></span></h1>
             </div>
        </div>
        <div class="row">

                    
             
                      <?php foreach ($list as $item): ?>

                        <?php   if($item->dt === $primo): ?>

                            <div class="weather-card col-md-5 m-5">
                                <div>
                                    <img src="<?php echo "http://openweathermap.org/img/wn/{$item->weather[0]->icon}@2x.png" ?>" alt="<?php echo $item->weather[0]->description; ?>" title="<?php echo $item->weather[0]->description; ?>" />
                                      <div class="main-weather">
                                        <h1><?php echo $data->city->name; ?></h1>
                                        <p><?php echo $item->weather[0]->description; ?></p>
                                        <p class="text-success"><?php echo date("l g:i a\ d-m-Y", $primo); ?></p>
                                      </div>
                                </div>
                                <div class="temperature">
                                <span><span class="material-icons temp-max">thermostat</span>Temp. Max: <?php echo $item->main->temp_max; ?>°C</span>
                                <span><span class="material-icons temp-min">thermostat</span>Temp. Min: <?php echo $item->main->temp_min; ?>°C</span>
                                </div>
                            </div>

                        <?php   elseif($item->dt === $day1): ?>

                            <div class="weather-card col-md-5 m-5">
                                <div>
                                    <img src="<?php echo "http://openweathermap.org/img/wn/{$item->weather[0]->icon}@2x.png" ?>" alt="<?php echo $item->weather[0]->description; ?>" title="<?php echo $item->weather[0]->description; ?>" />
                                      <div class="main-weather">
                                        <h1><?php echo $data->city->name; ?></h1>
                                        <p><?php echo $item->weather[0]->description; ?></p>
                                        <p class="text-success"><?php echo date("l g:i a\ d-m-Y", $day1); ?></p>
                                      </div>
                                </div>
                                <div class="temperature">
                                <span><span class="material-icons temp-max">thermostat</span>Temp. Max: <?php echo $item->main->temp_max; ?>°C</span>
                                <span><span class="material-icons temp-min">thermostat</span>Temp. Min: <?php echo $item->main->temp_min; ?>°C</span>
                                </div>
                            </div>

                            <?php   elseif($item->dt === $day2): ?>

                              <div class="weather-card col-md-5 m-5">
                                <div>
                                    <img src="<?php echo "http://openweathermap.org/img/wn/{$item->weather[0]->icon}@2x.png" ?>" alt="<?php echo $item->weather[0]->description; ?>" title="<?php echo $item->weather[0]->description; ?>" />
                                      <div class="main-weather">
                                        <h1><?php echo $data->city->name; ?></h1>
                                        <p><?php echo $item->weather[0]->description; ?></p>
                                        <p class="text-success"><?php echo date("l g:i a\ d-m-Y", $day2); ?></p>
                                      </div>
                                </div>
                                <div class="temperature">
                                <span><span class="material-icons temp-max">thermostat</span>Temp. Max: <?php echo $item->main->temp_max; ?>°C</span>
                                <span><span class="material-icons temp-min">thermostat</span>Temp. Min: <?php echo $item->main->temp_min; ?>°C</span>
                                </div>
                            </div>

                            <?php   elseif($item->dt === $day3): ?>

                              <div class="weather-card col-md-5 m-5">
                                <div>
                                    <img src="<?php echo "http://openweathermap.org/img/wn/{$item->weather[0]->icon}@2x.png" ?>" alt="<?php echo $item->weather[0]->description; ?>" title="<?php echo $item->weather[0]->description; ?>" />
                                      <div class="main-weather">
                                        <h1><?php echo $data->city->name; ?></h1>
                                        <p><?php echo $item->weather[0]->description; ?></p>
                                        <p class="text-success"><?php echo date("l g:i a\ d-m-Y", $day3); ?></p>
                                      </div>
                                </div>
                                <div class="temperature">
                                <span><span class="material-icons temp-max">thermostat</span>Temp. Max: <?php echo $item->main->temp_max; ?>°C</span>
                                <span><span class="material-icons temp-min">thermostat</span>Temp. Min: <?php echo $item->main->temp_min; ?>°C</span>
                                </div>
                            </div>

                            <?php   elseif($item->dt === $day4): ?>

                              <div class="weather-card col-md-5 m-5">
                                <div>
                                    <img src="<?php echo "http://openweathermap.org/img/wn/{$item->weather[0]->icon}@2x.png" ?>" alt="<?php echo $item->weather[0]->description; ?>" title="<?php echo $item->weather[0]->description; ?>" />
                                      <div class="main-weather">
                                        <h1><?php echo $data->city->name; ?></h1>
                                        <p><?php echo $item->weather[0]->description; ?></p>
                                        <p class="text-success"><?php echo date("l g:i a\ d-m-Y", $day4); ?></p>
                                      </div>
                                </div>
                                <div class="temperature">
                                <span><span class="material-icons temp-max">thermostat</span>Temp. Max: <?php echo $item->main->temp_max; ?>°C</span>
                                <span><span class="material-icons temp-min">thermostat</span>Temp. Min: <?php echo $item->main->temp_min; ?>°C</span>
                                </div>
                            </div>

                      <?php endif; ?>   


                    <?php endforeach; ?>
            
        </div>




    </div>

  </body>
</html>