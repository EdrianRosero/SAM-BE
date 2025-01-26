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

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>The Olympians</title>
    <link rel="icon" href="assets/imgs/tab-Icon.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <script src="script.js"></script>
    <script>
        generateNavBar(<?php echo json_encode($userData); ?>, 'profile.php');
    </script>

    <section>
        <div class="container py-5">
            <div class="row d-flex justify-content-center">
                <div class="col col-lg-10">
                    <div class="card shadow">
                        <div class="rounded-top text-white d-flex flex-row"
                            style="background-color: #12989f; height:200px;">
                            <div class="avatar ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <img src="assets/imgs/profile-icon.png"
                                    alt="Profile Image"
                                    class="img-fluid img-thumbnail mt-4 mb-2"
                                    style="width: 150px; z-index: 1; border-radius: 50%;">
                                <button type="button" class="btn text-white shadow-sm" style="z-index: 1; background-color: #12989f">
                                    Edit Photo
                                </button>
                            </div>
                            <div class="ms-3" style="margin-top: 120px;">
                                <h3 id="displayname"><?php echo $userData['displayname']; ?></h3>
                                <h5 id="username"><?php echo $userData['username']; ?></h5>
                            </div>

                        </div>
                        <div class="characteristics p-4 text-black bg-body-tertiary">
                            <div class="d-flex justify-content-end text-center py-1 text-body">
                                <div class="d-none d-sm-block">
                                    <img src="assets/imgs/characteristic-1.gif" alt="Gold Icon" class="rounded-circle" style="width: 40px; height: 40px;">
                                    <p class="small text-muted mb-0">Gold Seeker</p>
                                </div>
                                <div class="px-3 d-none d-sm-block">
                                    <img src="assets/imgs/characteristic-2.gif" alt="Athlete Icon" class="rounded-circle" style="width: 40px; height: 40px;">
                                    <p class="small text-muted mb-0">Champion Spirit</p>
                                </div>
                                <div class="d-none d-md-block">
                                    <img src="assets/imgs/characteristic-3.gif" alt="Victory Icon" class="rounded-circle" style="width: 40px; height: 40px;">
                                    <p class="small text-muted mb-0">Victory Chaser</p>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center align-items-start my-5 mx-4">
                            <!-- Account Management Section -->
                            <div class="account-management col-12 col-lg-7 mb-5 d-flex justify-content-center">
                                <div class="card p-4 text-black shadow rounded-4" style="max-width: 500px; width: 100%;">
                                    <div class="mb-2 text-center">
                                        <p class="lead fw-bold">Manage Account</p>
                                    </div>
                                    <div class="account-edit p-4 rounded">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-user me-2 fs-4"></i>
                                            <h6 class="fw-semibold mb-0">Username:
                                                <span id="username"><?php echo $userData['username']; ?></span>
                                            </h6>
                                            <a href="#" onclick="editField('username')" class="ms-auto text-decoration-none">
                                                <i class="fas fa-edit fs-5"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-id-card me-2 fs-4"></i>
                                            <h6 class="fw-semibold mb-0">Display Name:
                                                <span id="displayname"><?php echo $userData['displayname']; ?></span>
                                            </h6>
                                            <a href="#" onclick="editField('displayname')" class="ms-auto text-decoration-none">
                                                <i class="fas fa-edit fs-5"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-lock me-2 fs-4"></i>
                                            <h6 class="fw-semibold mb-0">Password:
                                                <span id="password"><?php echo str_repeat('*', strlen($userData['password'])); ?></span>
                                            </h6>
                                            <a href="#" onclick="editField('password')" class="ms-auto text-decoration-none">
                                                <i class="fas fa-edit fs-5"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Characteristics Section -->
                            <div class="title col-12 col-lg-5 d-flex justify-content-center">
                                <div class="card p-4 text-black shadow rounded-4" style="max-width: 500px; width: 100%;">
                                    <div class="mb-2 text-center">
                                        <p class="lead fw-bold">Edit Characteristics</p>
                                    </div>
                                    <div class="title-item mb-3">
                                        <div class="box-container">
                                            <img src="assets/imgs/characteristic-1.gif" alt="Gold Seeker" class="rounded-circle" style="width: 40px; height: 40px;">
                                            <p class="small text-muted mb-0 ms-3">Gold Seeker</p> <!-- Added margin-left for spacing -->
                                            <a href="#" class="ms-auto text-decoration-none">
                                                <i class="fas fa-edit fs-5"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="title-item mb-3">
                                        <div class="box-container">
                                            <img src="assets/imgs/characteristic-2.gif" alt="Athlete Icon" class="rounded-circle" style="width: 40px; height: 40px;">
                                            <p class="small text-muted mb-0 ms-3">Champion Spirit</p> <!-- Added margin-left for spacing -->
                                            <a href="#" class="ms-auto text-decoration-none">
                                                <i class="fas fa-edit fs-5"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="title-item">
                                        <div class="box-container">
                                            <img src="assets/imgs/characteristic-3.gif" alt="Victory Chaser" class="rounded-circle" style="width: 40px; height: 40px;">
                                            <p class="small text-muted mb-0 ms-3">Victory Chaser</p> <!-- Added margin-left for spacing -->
                                            <a href="#" class="ms-auto text-decoration-none">
                                                <i class="fas fa-edit fs-5"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex flex-column align-items-center mb-4 text-body">
                            <p class="lead mb-3 text-center fw-bold text-black" style="border-bottom: 1px solid #e0e0e0; width: 70%; margin: 0 auto;">Posts</p>
                            <div class="post-view-type d-flex justify-content-center">
                                <button type="button" class="btn border-black text-body d-flex align-items-center me-2" style="z-index: 1;">
                                    <i class="bi bi-list fs-4" style="margin-right: 5px;"></i> List View
                                </button>
                                <button type="button" class="btn border-black text-body d-flex align-items-center" style="z-index: 1;">
                                    <i class="bi bi-grid fs-4" style="margin-right: 5px;"></i> Grid View
                                </button>
                            </div>
                        </div>

                        <div class="bg-body-tertiary rounded">
                            <div class="col col-lg-12 d-flex  justify-content-center my-4 mx-3">
                                <div id="post_container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        fetchUserPosts(<?php echo json_encode($userData); ?>);
    </script>

    <script>
        let footer = generateFooter();
        document.body.innerHTML += footer;
    </script>

    <script>
        let profileMenu = document.getElementById("profileMenu");

        function toggleMenu() {
            profileMenu.classList.toggle("open-menu");
        }
    </script>

</body>

</html>