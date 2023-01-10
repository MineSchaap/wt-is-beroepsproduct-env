<?php

function getHeader(){
    return 
    '<header class = "header">
        <div class = "flex-container">

            <a href = "index.php">
                <div class = "indiv-flex"  style="flex-grow: 1">
                    <h2>
                        gelre airport
                    </h2>
                </div>
            </a>

            <div class = "flex-container" style="flex-grow: 2">

            <a href="medewerker_home_page.php">
                    <div class = "indiv-flex">
                    <h2>
                        naar medewerker homepage
                    </h2>
                </div>
            </a>

            <a href="passenger_home_page.php">
                <div class = "indiv-flex">
                    <h2>
                        naar passagier homepage
                    </h2>
                </div>
            </a>

            <a href="vluchten_overzicht_page.php">
                <div class = "indiv-flex">
                    <h2>
                        overzicht vluchten
                    </h2>
                </div>
            </a>

            <a href="index.php">
                <div class = "indiv-flex">
                    <h2>
                        lorem ipsum
                    </h2>
                </div>
            </a>

            <a href="index.php">
                <div class = "indiv-flex">
                    <h2>
                        lorem ipsum
                    </h2>
                </div>
            </a>

            <a href="index.php">
                <div class = "indiv-flex">
                    <h2>
                        lorem ipsum
                    </h2>
                </div>
            </a>

            </div>

            <div class = "indiv-flex" style="flex-grow: 2">
                    
                <form action="vlucht-details.php" method="post">
                    <input type="number" placeholder="zoek vlucht" name = "vluchtnummer" required>
                    
                    <button type = "submit" >submit</button>
                </form>
            </div>

        </div>
    </header>';
}

function getFooter(){
    return 
    '<footer>
        <div class = "flex-container">
            <div class = "indiv-flex">
                <h2>
                    contact us
                </h2>

                <div class = "flex-container">
                    <div class = "indiv-flex">
                        <h3>
                            email-adres
                        </h3>
                        <p>
                            us@gmail.com
                        </p>
                    </div>

                    <div class = "indiv-flex">
                        <h3>
                            telefoonnummer
                        </h3>
                        <p>
                            0314-000000
                        </p>
                    </div>

                    <div class = "indiv-flex">
                        <h3>
                            adres
                        </h3>
                        <p>
                            ruitenberglaan 26 arnhem
                        </p>
                    </div>
                </div>

            </div>

            <div class = "indiv-flex">
                <h3>information</h3>
                <p>about us</p>

                <a href = "privacyverklaring.php">
                    <p>privacy policy</p>
                </a>
                
                
                <p>contact us</p>



            </div>
        </div>

        <p>
            copyright 2022 Gelre Airport
        </p>
    </footer>';
}

?>