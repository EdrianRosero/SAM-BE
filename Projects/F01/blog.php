<?php
session_start();
include("connection.php");
include("functions.php");
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die;
}
$userData = get_user_data($con, $_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>The Olympians</title>
    <link rel="icon" href="assets/imgs/tab-Icon.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/style.css" rel="stylesheet">
</head>

<body>
    <script src="script.js"></script>
    <script>
        generateNavBar(<?php echo json_encode($userData); ?>, 'blog.php');
    </script>

    <div class="banner">
        <div class="banner-container position-relative image-container">
            <div class="image-section"></div>
        </div>
    </div>

    <div class="container-blog pt-5">
        <div id="projects" class="section section-projects">
            <div class="container container-projects">
                <h2 class="title-text project-title fw-bold">
                    The Faces of Excellence: Olympic Stars
                </h2>
                <div id="project-content" class="row d-flex align-items-stretch justify-content-center">
                </div>
            </div>
        </div>

        <div class="separator my-5">
            <div class="separator-text text-center">
                <p class="description-text">Scroll down to see more!</p>
            </div>
        </div>

        <div class="section legacy p-5">
            <div class="container container-legacy">
                <div class="row">
                    <div class="w-col w-col-4 w-col-stack">
                        <div class="fave-info">
                            <h4 class="title-text heading-2 fw-bold" style="line-height: 3rem;">Beyond the Games: A
                                Legacy of Impact
                            </h4>
                            <p class="description-text">The Olympics are more than a celebration of athletic
                                excellence—they are a platform for global change. Through initiatives like Education,
                                Sustainability, Human Rights Protection, and Peace Development, the Olympic Movement
                                drives positive social impact worldwide. Programs such as Olympic Solidarity, Refugee
                                Support, and Olympism 365 embody the commitment to inclusivity, integrity, and progress,
                                showcasing how sport unites communities and fosters a better, more sustainable future
                                for all.</p>
                        </div>
                    </div>
                    <div class="w-col w-col-8 w-col-stack">
                        <div class="legacy-category">
                            <div role="list" class="category-grid">
                                <div role="listitem">
                                    <a href="https://www.olympics.com/ioc/education" target="_blank"
                                        class="plugin-block">
                                        <img src="assets/imgs/education.png">
                                    </a>
                                </div>
                                <div role="listitem">
                                    <a href="https://www.olympics.com/ioc/human-rights" target="_blank"
                                        class="plugin-block">
                                        <img src="assets/imgs/protection.png">
                                    </a>
                                </div>
                                <div role="listitem">
                                    <a href="https://www.olympics.com/ioc/integrity" target="_blank"
                                        class="plugin-block">
                                        <img src="assets/imgs/integrity.png">
                                    </a>
                                </div>
                                <div role="listitem">
                                    <a href="https://www.olympics.com/ioc/olympic-legacy" target="_blank"
                                        class="plugin-block">
                                        <img src="assets/imgs/legacy.png">
                                    </a>
                                </div>
                                <div role="listitem">
                                    <a href="https://www.olympics.com/ioc/olympic-solidarity" target="_blank"
                                        class="plugin-block">
                                        <img src="assets/imgs/solidarity.png">
                                    </a>
                                </div>
                                <div role="listitem">
                                    <a href="https://www.olympics.com/ioc/olympism365" target="_blank"
                                        class="plugin-block">
                                        <img src="assets/imgs/olympism.png">
                                    </a>
                                </div>
                                <div role="listitem">
                                    <a href="https://www.olympics.com/ioc/peace-and-development" target="_blank"
                                        class="plugin-block">
                                        <img src="assets/imgs/peace.png">
                                    </a>
                                </div>
                                <div role="listitem">
                                    <a href="https://www.olympics.com/ioc/refugee-olympic-team" target="_blank"
                                        class="plugin-block">
                                        <img src="assets/imgs/refugees.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <script>
        let footer = generateFooter();
        document.body.innerHTML += footer;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoA7s4ZWJ70sLq0gFM/JB12zGTBrsE/mxw4YNd02BO8BgU+"
        crossorigin="anonymous"></script>

    <script>
        var names = ["SIMONE BILES", "LEBRON JAMES", "NEERAJ CHOPRA", "NOVAK DJOKOVIC", "YUZURU HANYU"]
        var description = ["A Journey from Early Years to Sporting Glory", "A Phenom Takes Center Stage in Cleveland.", "Neeraj Chopra and his historic Olympic gold at Tokyo 2020.", "The making of a legend.", "The first Asian man to win an Olympic gold medal."]
        var links = ["https://www.olympics.com/en/athletes/simone-biles", "https://www.olympics.com/en/athletes/lebron-james", "https://www.olympics.com/en/athletes/neeraj-chopra", "https://www.olympics.com/en/athletes/novak-djokovic", "https://www.olympics.com/en/athletes/yuzuru-hanyu"]
        var images = ["assets/imgs/simone.png", "assets/imgs/lebron.jpg", "assets/imgs/neeraj.jpg", "assets/imgs/djokovic.jpg", "assets/imgs/yuzuru.jpg"];
        var borderColors = ["border-primary", "border-success", "border-danger", "border-warning", "border-info"];
        var borderColors = [
            "style='border: 3px solid #0081cb;'",
            "style='border: 3px solid #fcb131;'",
            "style='border: 3px solid #000000;'",
            "style='border: 3px solid #00a651;'",
            "style='border: 3px solid #ee334e;'"
        ];

        for (var i = 0; i < names.length; i++) {
            var projectContent = document.getElementById("project-content");
            projectContent.innerHTML += `<div class="col-12 col-lg-4 col-md-6 d-flex align-items-stretch my-3">
                    <div class="card-athlete text-center" ${borderColors[i]}>
                        <a href="${links[i]}" target="_blank" class="text-decoration-none">
                            <img src="${images[i]}" class="card-img-top" alt="${names[i]}">
                            <div class="card-body">
                                <h3 class="card-title title-text mt-0">${names[i]}</h3>
                                <p class="card-text my-0 description-text" style="font-size: 1rem;">${description[i]}</p>
                            </div>
                        </a>
                    </div>
                </div>`;
        }
    </script>

</body>

</html>