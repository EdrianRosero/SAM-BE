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
        generateNavBar(<?php echo json_encode($userData); ?>, 'home.php');
    </script>

    <div class="container py-4">
        <div class="row justify-content-center">

            <!-- Left Sidebar Card 1&2 - Fan's Favorite Sports & Olympic Highlights -->
            <div class="col-lg-3">
                <div class="container-feature p-3">
                    <h5 class="fw-bold text-black mb-3" style="border-left: 10px solid #12989f; padding-left: 10px;">Top Picks</h5>
                    <ul class="sports-ranking list-unstyled" id="sports-content"></ul>
                </div>
                <div class="container-feature p-3 mt-4 text-center">
                    <h5 class="fw-bold text-black mb-3" style="border-left: 10px solid #12989f; padding-left: 10px;">Best of the Olympics</h5>
                    <div id="video-content"></div>
                </div>
            </div>

            <!-- Middle Content (Post Form and Post Container) -->
            <div class="col-lg-6 col-md-8">
                <form action="create_post.php" method="POST" onsubmit="return submitForm();">
                    <div class="create-post shadow-sm rounded-3 bg-white">
                        <div class="user d-flex align-items-center px-3 py-3 text-dark">
                            <img src="assets/imgs/profile-icon.png" alt="Profile Picture"
                                class="rounded-circle post-form-profile bg-gray">
                            <h6 id="displayname" class="mb-0 mt-2 fw-bold">
                                <?php echo isset($userData['displayname']) ? $userData['displayname'] : 'Error displaying name'; ?>
                            </h6>
                            <input type="checkbox" id="check" name="anonymous" class="ms-3" onclick="toggleAnonymous()">
                            <label for="check" class="toggle-button ms-2 mt-2"></label>
                        </div>
                        <div class="create-post-form">
                            <div class="create-post-input p-3">
                                <textarea id="postText" rows="3" name="text" class="form-control border-0"
                                    placeholder="What's on your mind, <?php echo isset($userData['displayname']) ? $userData['displayname'] : 'User'; ?>?"></textarea>
                            </div>
                            <ul class="create-post-links list-unstyled mb-0">
                                <li class="d-flex justify-content-center align-items-center border-secondary"
                                    style="height: 40px;">
                                    <button type="submit" class="btn btn-primary w-100 rounded-bottom-3">Post</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
                <div id="post_container" class="mt-5 mb-4"> </div>
            </div>

            <!-- Right Sidebar Card 3 - Top Stories -->
            <div class="col-lg-3">
                <div class="container-feature px-3 pb-1">
                    <h5 class="fw-bold mb-4 ms-2 text-black" style="border-left: 10px solid #12989f; padding-left: 10px;">Top Stories</h5>
                    <ul class="top-stories-list list-unstyled"></ul>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <script>
        let footer = generateFooter();
        document.body.innerHTML += footer;
    </script>

    <script>
        function submitForm() {
            var postText = document.getElementById("postText").value.trim();
            if (postText === "") {
                alert("Please enter your thoughts before posting.");
                return false;
            }
            return true;
        }

        var clicked = false;

        function toggleAnonymous() {
            const displayname = document.getElementById("displayname");
            clicked = !clicked;
            displayname.innerText = clicked ? 'Anonymous' : '<?php echo $userData['displayname']; ?>';
        }

        fetchPosts();
    </script>

    <script>
        // Fan's Favorite Sports
        var sportsNames = ["Football", "Basketball", "Baseball", "Tennis", "Swimming"];
        var sportsLinks = [
            "https://olympics.com/en/sports/football/",
            "https://olympics.com/en/sports/basketball/",
            "https://olympics.com/en/sports/baseball-5/",
            "https://olympics.com/en/sports/tennis/",
            "https://olympics.com/en/sports/swimming/"
        ];
        var sportsImages = [
            "assets/imgs/football.gif",
            "assets/imgs/basketball.gif",
            "assets/imgs/baseball.gif",
            "assets/imgs/tennis.gif",
            "assets/imgs/swimming.gif"
        ];
        var sportsRanks = [1, 2, 3, 4, 5];

        // Olympic Highlights Videos
        var videoTitles = [
            "Beyonce introduces Team USA, from Simone Biles to Noah Lyles",
            "Mr. Bean Live Performance at the London 2012 Olympic Games"
        ];
        var videoUrls = [
            "https://www.youtube.com/embed/wa7HpWw7DEk?si=sZpjKt55_H0iYIGI",
            "https://www.youtube.com/embed/CwzjlmBLfrQ?si=cSzqE1VBxCU0F-xj"
        ];

        // Top Stories
        var names = [
            "Track and Field Stars",
            "Camille Rast Wins",
            "Samoan History Makers",
            "Adam Peaty's Guidance"
        ];

        var description = [
            "Track and field stars set to make a comeback in 2025.",
            "Camille Rast wins thrilling Flachau World Cup slalom.",
            "Meet the Samoan history makers at their first cricket World Cup.",
            "Adam Peaty receives guidance from Michael Phelps and Gordon Ramsay about potential LA 2028 return."
        ];

        var links = [
            "https://olympics.com/en/news/track-and-field-stars-set-to-make-a-comeback-in-2025",
            "https://olympics.com/en/news/camille-rast-wins-thrilling-flachau-world-cup-slalom",
            "https://olympics.com/en/news/samoa-sporting-talents-cricket-history-first-world-cup-cricket-tournament",
            "https://olympics.com/en/news/adam-peaty-guidance-michael-phelps-gordon-ramsay-la-2028"
        ];

        var images = [
            "assets/imgs/story1.png",
            "assets/imgs/story2.png",
            "assets/imgs/story3.png",
            "assets/imgs/story4.png"
        ];

        // Populate Fan's Favorite Sports Section
        var sportsContent = document.getElementById("sports-content");
        for (var i = 0; i < sportsNames.length; i++) {
            sportsContent.innerHTML += `
        <li class="ranking-item d-flex align-items-center">
            <a href="${sportsLinks[i]}" target="_blank" class="text-decoration-none">
                <span class="rank">${sportsRanks[i]}</span>
                <img src="${sportsImages[i]}" alt="${sportsNames[i]}" class="rank-image">
                <span class="sport-name">${sportsNames[i]}</span>
            </a>
        </li>`;
        }

        // Populate Olympic Highlights Section
        var videoContent = document.getElementById("video-content");
        for (var i = 0; i < videoTitles.length; i++) {
            videoContent.innerHTML += `
        <div class="video-container">
            <iframe class="rounded" width="200" height="100"
                src="${videoUrls[i]}" title="${videoTitles[i]}" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <p class="text-muted text-center px-1">${videoTitles[i]}</p>
        </div>`;
        }

        // Populate Top Stories Section
        var storiesContainer = document.querySelector(".top-stories-list");
        for (let i = 0; i < names.length; i++) {
            storiesContainer.innerHTML += `
        <li class="top-story-item">
            <a href="${links[i]}" target="_blank" class="text-decoration-none">
                <div class="story-image">
                    <img src="${images[i]}" alt="${names[i]}" class="img-fluid">
                </div>
                <div class="story-description px-2">
                    <p class="text-center">${description[i]}</p>
                </div>
            </a>
        </li>`;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoA7s4ZWJ70sLq0gFM/JB12zGTBrsE/mxw4YNd02BO8BgU+"
        crossorigin="anonymous"></script>

</body>

</html>