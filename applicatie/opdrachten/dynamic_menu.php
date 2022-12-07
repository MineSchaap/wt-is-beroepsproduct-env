<?php
$foodArray = 
[
  ['Shoarma', '&euro; 6.95'],
  ['Appels', '&euro; 10.95'],
  ['kk', '&euro; 69.95'],
  ['kl', '&euro; 14.95'],
];

$drinkArray = 
[
  ['Shoarma', '&euro; 6.95'],
  ['Appels', '&euro; 10.95'],
  ['kk', '&euro; 69.95'],
  ['kl', '&euro; 14.95'],
];
?>

<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <title>Restaurantmenu</title>
    <style>
      td:first-child {
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
    <h1>Menu</h1>

    <h2>Eten</h2>
    <table>
        <tr><td>Shoarma</td><td>&euro; 6.95</td></tr>
        <tr><td>Appels</td><td>&euro; 10.95</td></tr>
        <tr><td>Tabouleh</td><td>&euro; 8.95</td></tr>
        <tr><td>Hamburger</td><td>&euro; 5.50</td></tr>
    </table>

    <h2>Drinken</h2>
    <table>
        <tr><td>Cola</td><td>&euro; 2.00</td></tr>
        <tr><td>Ayran</td><td>&euro; 2.30</td></tr>
        <tr><td>Fernandes</td><td>&euro; 2.50</td></tr>
        <tr><td>Bier</td><td>&euro; 5.50</td></tr>
    </table>
  </body>
</html>