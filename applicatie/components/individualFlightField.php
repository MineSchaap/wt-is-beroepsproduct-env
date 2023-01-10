<?php

function makeIndividualFlightBox($id, $bestemming, $vertrektijd){
    //$individualFlightBox = $id . $bestemming . $vertrektijd;

    $datum = date_format(date_create($vertrektijd),"Y/m/d");
    $tijd = date_format(date_create($vertrektijd),"H:i");

    $individualFlightBox = '
    <div class = "individual-flight-box">

        <h2>
            Naar ' . $bestemming . '
        </h2>

        <div class = "flex-container">
            <div class = "indiv-flex">
                <h2>
                    ' . $datum . '
                </h2>
            </div>
            <div class = "indiv-flex">
                <h2>
                    ' .$tijd . '
                </h2>
            </div>       
        </div>

        <h2>
            Op schema
        </h2>

        <div>
            <form action = "vlucht-details.php" method = "post"  class = "grid-buttons">
                <button class = "button-flight-details" type = "submit" name = "vluchtnummer" value = ' . $id . '>
                        meer informatie
                </buttons>
            </form>
        </div>
    </div>
    ';

    return $individualFlightBox;
}


?>