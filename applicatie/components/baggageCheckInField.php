<?php
function getBaggageCheckinFieldHTML(){
    return '
    <div class = "textbox">
        <h2>
            koffers inchecken
        </h2>

        <p>
            alstublieft uw koffers individueel inchecken
        </p>
        <form action="components/handlePassengerNewBaggage.php" method="get">
            <div class = "flex-container">
                <div class = "indiv-flex">
                    <input type = "number" placeholder="hoeveelheid kilogram" class = "inputtextbox" name = "weight" step = 0.01 required>
                </div>

                <div class = "indiv-flex">
                    <button class = "inputtextbox" type = "submit">check koffer in</button>
                </div>
        
            </div>
        <!--aangeven gewicht, aangeven passagiersnummer niet nodig => al ingelogd-->
        </form>
    </div>';
}
?>