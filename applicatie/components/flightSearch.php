<?php 
function getFlightSearchBox(){
    return '
    <div class = "textbox">
            
        <h2>
        zoek een vlucht
        </h2>

        <form action="vlucht-details.php" method="post">
        <input type="number" placeholder="vluchtnummer" class = "inputtextbox" name = "vluchtnummer" required>
        
        <button type = "submit" class = "inputtextbox">submit</button>
        </form>
    </div>
    ';
}
?>