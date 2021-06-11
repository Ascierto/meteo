<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">
    <title>Meteo</title>
</head>
<body>
    <?php


    $file_content = file_get_contents("./data/city2.list.json",FILE_USE_INCLUDE_PATH);

    $cities = json_decode($file_content);

    

    ?>

    <header>
        <h1>Previsioni di oggi per : </h1>
    </header>
    
    <main>
        <form action="meteo2.php" method="GET">
            <select name="city" id="city" required>
                <?php

                    $index = 0;

                    foreach($cities as $city){

                        if ($index > 50) {
                            break;
                        }

                        printf("<option value='%s'>%s</option>" , $city->id, $city->name);

                        $index++;
                    }
                ?>
            </select>

            <input type="submit" value="Mostra Previsioni">

        
        </form>
    </main>

    <!-- 1 - Estrapolare le previsioni delle prossime tre ore del giorno corrente.
2- Estrapolare la prima previsione dei giorni a seguire.
3 - Mostrare i dati in pagina. -->


    <footer>
        <p>Il Meteo di Giuliano </p>
    </footer>
</body>
</html>