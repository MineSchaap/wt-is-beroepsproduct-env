<?php

$menu = 
[
'eten' => [
    'pannenkoek' => 18.7,
    'hamburger' => 5.0,
    'broodje gezond' => 4.0],

'drinken' => [
    'drankje1' => 43.0,
    'Coca cola' => 2.4,
    'sevenup' => 2.99]
];

$menukaart = '<h1>' . 'Menu' . '</h1>';

if(!isset($_GET['soort'])){
    foreach($menu as $soort => $artikelen){

        //titel plaatsen
        $menukaart .= '<h2>' . $soort . '</h2>';


        //in html aangeven dat er een tabel komt
        $menukaart .= '<table>';
        //langs de lijst gaan

        foreach($artikelen as $artikelen => $prijs){
            $menukaart .= '<tr>' . '<td>' . $artikelen . '</td>' . '<td>' . '&euro;' . $prijs . '</td>' . '</tr>';
        }

        //in html aangeven dat er het tabel eindigt
        $menukaart .= '</table>';

    }
}

elseif(array_key_exists($_GET['soort'], $menu)){
 
    $soort = $_GET['soort'] . '';//string

    $singleMenu = $menu[$soort];

    //titel plaatsen
    $menukaart .= '<h2>' . $soort . '</h2>';

    //in html aangeven dat er een tabel komt
    $menukaart .= '<table>';

    //langs de lijst gaan
    foreach($singleMenu as $artikelen => $prijs){
        $menukaart .= '<tr>' . '<td>' . $artikelen . '</td>' . '<td>' . '&euro;' . $prijs . '</td>' . '</tr>';
    }

    //in html aangeven dat er het tabel eindigt
    $menukaart .= '</table>';
}

?>

<!doctype html>
    <html lang="nl">
        <head>
            <meta charset="UTF-8">
            <title>Restaurantmenu</title>
            <style>
                td:first-child{
                    width: 8em;
                }
                td:nth-child(2) {
                    font-style: italic;
                    text-align: right;
                    width: 4em;
                }
            </style>
        </head>
    <body>
        <!--real-->
        <?= $menukaart ?>
        <!--test-->
        <h1>Menu</h1>

        <h2>Eten</h2>
        <table>
            <tr><td>Pannenkoek</td><td>&euro; 18.70</td></tr>
            <tr><td>Hamburger</td><td>&euro; 5.50</td></tr>
            <tr><td>Broodje Gezond</td><td>&euro; 4.00</td></tr>
        </table>

        <h2>Drinken</h2>
        <table>
            <tr><td>Cola</td><td>&euro; 2.00</td></tr>
            <tr><td>Spa Rood</td><td>&euro; 5.50</td></tr>
            <tr><td>Bier</td><td>&euro; 2.30</td></tr>
            <tr><td>Witte wijn</td><td>&euro; 3.20</td></tr>
            <tr><td>Rode wijn</td><td>&euro; 3.20</td></tr>
        </table>

    </body>
</html>