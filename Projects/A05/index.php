<?php
include('connect.php');
$result = executeQuery("SELECT * FROM islandsOfPersonality");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Core Memories</title>
    <link rel="icon" href="assets/images/brand.png" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: "Lato", sans-serif
        }

        .mySlides {
            display: none
        }

        .w3-bar-item.w3-button {
            padding-top: 12px !important;
            padding-bottom: 12px !important;
        }

        .w3-image:hover {
            transform: translateZ(-20px) scale(0.95);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .w3-bar-item p,
        .w3-bar-item i {
            margin: 0;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-black w3-card">
            <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right"
                href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i
                    class="fa fa-bars"></i></a>
            <a href="#slideshow" class="w3-bar-item w3-button w3-padding-large w3-hide-small">
                <i class="fa fa-home w3-xlarge"></i>
                <p>Home</p>
            </a>
            <?php
            $result->data_seek(0);
            while ($island = $result->fetch_assoc()) {
                $islandID = strtolower(str_replace(' ', '_', $island['name']));
                ?>
                <a href="#<?php echo $islandID; ?>" class="w3-bar-item w3-button w3-padding-large w3-hide-small">
                    <i class="fa fa-user w3-xlarge"></i>
                    <p><?php echo $island['name']; ?></p>
                </a>
            <?php } ?>
            <a href="#footer" class="w3-bar-item w3-button w3-padding-large w3-hide-small">
                <i class="fa fa-envelope w3-xlarge"></i>
                <p>Contact</p>
            </a>
        </div>
    </div>

    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
        <a href="#slideshow" class="w3-bar-item w3-button" style="width:100% !important">Home</a>
        <?php
        $result->data_seek(0);
        while ($island = $result->fetch_assoc()) {
            $islandID = strtolower(str_replace(' ', '_', $island['name']));
            echo "<a href='#$islandID' class='w3-bar-item w3-button' style='width:100% !important'>{$island['name']}</a>";
        }
        ?>
        <a href="#footer" class="w3-bar-item w3-button" style="width:100% !important">Contact</a>
    </div>

    <!-- Page content -->
    <div class="w3-content" style="max-width:2000px;margin-top:46px" id="slideshow">
        <!-- Automatic Slideshow -->
        <div class="mySlides w3-display-container w3-center">
            <img src="assets/images/college.png" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-black w3-padding-32 w3-hide-small">
                <h3>College Island</h3>
                <p><b>I dive into campus life and academic adventures.</b></p>
            </div>
        </div>
        <div class="mySlides w3-display-container w3-center">
            <img src="assets/images/foodie.png" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-black w3-padding-32 w3-hide-small">
                <h3>Foodie Island</h3>
                <p><b>I savor delicious food and culinary delights.</b></p>
            </div>
        </div>
        <div class="mySlides w3-display-container w3-center">
            <img src="assets/images/friendship.png" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-black w3-padding-32 w3-hide-small">
                <h3>Friendship Island</h3>
                <p><b>I cherish moments and build friendships.</b></p>
            </div>
        </div>
        <div class="mySlides w3-display-container w3-center">
            <img src="assets/images/scenery.png" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-black w3-padding-32 w3-hide-small">
                <h3>Scenery Island</h3>
                <p><b>I wander through stunning views and landscapes.</b></p>
            </div>
        </div>

        <!-- About  Me -->
        <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px">
            <h2 class="w3-wide">Edrian Joshua Rosero</h2>
            <p class="w3-opacity"><i>All About Me</i></p>
            <p class="w3-justify">Hi, I'm Edrian Joshua Rosero, a passionate individual with a love for discovering new
                experiences and
                building meaningful connections. My journey is filled with diverse interests, each shaping who I am
                today. On College Island, I'm immersed in the world of learning and growth, always striving to reach new
                academic heights. Over on Foodie Island, I enjoy exploring different cuisines and savoring every meal as
                an opportunity to experience culture through food. Friendship Island is where I cherish the bonds I
                create with others, valuing loyalty and shared moments of laughter. Finally, Scenery Island is where I
                find peace and inspiration, appreciating the beauty of nature and the world around me. Each of these
                islands represents a part of me, and together, they help define my unique perspective on life.</p>

            <div class="w3-row w3-padding-32">
                <h3 class="w3-padding-15 w3-text-black w3-con">Today I Feel</h3>
                <hr style="width:200px; border-color: black; margin: 0 auto 50px auto;" class="w3-opacity w3-center">
                <p class="w3-wide">Joy</p>
                <div class="w3-grey w3-round">
                    <div class="w3-yellow w3-round" style="height:28px;width:80%"></div>
                </div>
                <p class="w3-wide">Sadness</p>
                <div class="w3-grey w3-round">
                    <div class="w3-blue w3-round" style="height:28px;width:10%"></div>
                </div>
                <p class="w3-wide">Fear</p>
                <div class="w3-grey w3-round">
                    <div class="w3-purple w3-round" style="height:28px;width:5%"></div>
                </div><br>
                <p class="w3-wide">Disgust</p>
                <div class="w3-grey w3-round">
                    <div class="w3-green w3-round" style="height:28px;width:4%"></div>
                </div>
                <p class="w3-wide">Anger</p>
                <div class="w3-grey w3-round">
                    <div class="w3-red w3-round" style="height:28px;width:2%"></div>
                </div><br>
            </div>

            <div class="w3-row w3-center w3-padding-16 w3-section  w3-text-black w3-round"
                style="background: linear-gradient(to bottom right, rgb(255, 233, 169), rgb(172, 212, 255), rgb(218, 185, 255), rgb(198, 255, 198), rgb(255, 178, 178))">
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">30+</span><br>
                    Allies
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">55+</span><br>
                    Adventures
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">89+</span><br>
                    Smiles Shared
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">100+</span><br>
                    Milestones
                </div>
            </div>
        </div>

        <!-- Islands of Personality-->
        <div class="w3-white">
            <h1 class="w3-xxxlarge w3-padding-32 w3-center w3-text-black">Islands of Personality</h1>
            <hr style="width:350px; border-color: black; margin: -20px auto 50px auto;" class="w3-opacity w3-center">

            <?php
            $result->data_seek(0);

            while ($island = $result->fetch_assoc()) {
                $islandID = $island['islandOfPersonalityID'];
                $contentResult = $conn->query("SELECT * FROM islandContents WHERE islandOfPersonalityID = $islandID");
                ?>

                <div class="w3-container w3-padding-64 w3-round"
                    id="<?php echo strtolower(str_replace(' ', '_', $island['name'])); ?>"
                    style="background-color: <?php echo $island['color']; ?>; margin-bottom: 30px;">
                    <div class="w3-center" style="padding-left: 20px; padding-right: 20px;">
                        <h1 class="w3-text-black w3-xxlarge w3-bold">
                            <?php echo $island['name']; ?>
                        </h1>
                        <p class="w3-text-black w3-large w3-margin-bottom">
                            <?php echo $island['longDescription']; ?>
                        </p>
                        <img class="w3-image w3-round w3-margin-top w3-margin-bottom" src="<?php echo $island['image']; ?>"
                            style="width:100%; height:auto;">
                        <p class="w3-text-black w3-large"><i>
                                <?php echo $island['shortDescription']; ?>
                            </i></p><br>

                        <!-- Start of Two-Column Layout for Content with Spacing -->
                        <div class="w3-row">
                            <?php while ($content = $contentResult->fetch_assoc()) { ?>
                                <div class="w3-col l6 m6 s12 w3-margin-bottom">
                                    <div class="w3-content" style="padding: 10px;">
                                        <!-- Padding inside the column for spacing -->
                                        <img class="w3-image w3-round w3-center" src="<?php echo $content['image']; ?>"
                                            alt="<?php echo $content['content']; ?>" style="width:100%; height:auto;">
                                        <p class="w3-text-black w3-large w3-center">
                                            <?php echo $content['content']; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div> <!-- End of Two-Column Layout -->
                    </div>
                </div>

            <?php } ?>
        </div>

        <!-- Footer -->
        <footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge" id="footer">
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-snapchat w3-hover-opacity"></i>
            <i class="fa fa-pinterest-p w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
            <p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp"
                    target="_blank">w3.css</a>
            </p>
        </footer>

        <script>
            // Automatic Slideshow - change image every 4 seconds
            var myIndex = 0;
            carousel();

            function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                myIndex++;
                if (myIndex > x.length) { myIndex = 1 }
                x[myIndex - 1].style.display = "block";
                setTimeout(carousel, 4000);
            }

            // Used to toggle the menu on small screens when clicking on the menu button
            function myFunction() {
                var x = document.getElementById("navDemo");
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                } else {
                    x.className = x.className.replace(" w3-show", "");
                }
            }

            // When the user clicks anywhere outside of the modal, close it
            var modal = document.getElementById('ticketModal');
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>

</body>

</html>
<?php $conn->close(); ?>