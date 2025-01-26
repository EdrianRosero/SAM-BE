/* NAVIGATION BAR ----- START */
function generateNavBar(user_data, currentPage) {
  const navbarHtml = `
        <nav class="navbar">
            <div class="navbar-left">
                <a href="home.php" class="logo"><img src="assets/imgs/nav-Icon.png"></a>
            </div>
            <div class="navbar-right">
                <ul>
                    <li><a href="home.php" class="${
                      currentPage === "home.php" ? "active-link" : ""
                    }"><img src="assets/imgs/home.gif"></a></li>
                    <li><a href="blog.php" class="${
                      currentPage === "blog.php" ? "active-link" : ""
                    }"><img src="assets/imgs/blog.gif"></a></li>
                    <li onclick="toggleMenu()"><a href="#" class="${
                      currentPage === "profile.php" ? "active-link" : ""
                    }"><img src="assets/imgs/profile.gif"></a></li>
                </ul>
            </div>
            <div class="profile-menu-wrap" id="profileMenu">
                <div class="profile-menu">
                    <div class="user-info">
                        <h5>Hello, ${
                          user_data.displayname
                            ? user_data.displayname
                            : "error displaying displayname"
                        }!</h5>
                    </div>
                    <hr>
                    <a href="profile.php" class="profile-menu-link"><img src="assets/imgs/setting.png"> <p>Edit Profile</p> <span></span></a>
                    <hr>
                    <a href="#" class="profile-menu-link"><img src="assets/imgs/feedback.png"> <p>Give Feedback</p> <span></span></a>
                    <a href="#" class="profile-menu-link"><img src="assets/imgs/help.png"> <p>Help & Support</p> <span></span></a>
                    <hr>
                    <a href="logout.php" class="profile-menu-link"><img src="assets/imgs/logout.png"> <p>Log Out</p> <span></span></a>
                </div>
            </div>
        </nav>
    `;
  document.body.innerHTML = navbarHtml;
}
/* NAVIGATION BAR ----- END */

/* POST TOGGLE MENU ----- START */
function toggleMenu() {
  let profileMenu = document.getElementById("profileMenu");
  if (profileMenu) {
    profileMenu.classList.toggle("open-menu");
  }
}
/* POST TOGGLE MENU ----- END */

/* POST (HOMEPAGE) ----- START */
const postContainer = document.getElementById("post_container");

const fetchPosts = async (user_data) => {
  const response = await fetch("fetch_posts.php");
  const posts = await response.json();
  posts.forEach((post) => createPostCard(post.id, post));
};

function createPostCard(postId, posts, user_data) {
  const postElement = document.createElement("div");
  postElement.classList.add("post");

  const isAnonymous = posts.anonymous === "Y";
  const author = isAnonymous ? "Anonymous" : posts.displayname;
  const timestamp = new Date(posts.timestamp);
  const timeAgo = formatTimeAgo(timestamp);
  const postText = posts.text;
  const likeCount = posts.likecount;

  const postInnerHTML = `
        <div class="post-author d-flex align-items-start mb-3">
            <div>
                <h6 class="text-dark fw-bold mb-0">${author}</h6>
                <small>${timeAgo}</small>
            </div>
        </div>
        <p class="text-dark fs-6 mb-3">${postText}</p>
        <div class="post-stats d-flex align-items-center justify-content-between border-bottom pb-1 fs-7">
            <div class="like-Count-Icn d-flex align-items-center">
                <img src="assets/imgs/like.gif">
                <span class="like-Count ms-2 mt-1" data-post-id="${postId}">${likeCount}</span>
            </div>
        </div>
        <div class="post-activity d-flex align-items-center justify-content-between">
            <div class="like-function d-flex align-items-center my-1" id="likeButton_${postId}" onclick="likePost(${postId})">
                <img id="likeImage_${postId}" src="assets/imgs/like.gif" class="me-2">
                <span id="likeText_${postId}" class="fs-6">Like</span>
            </div>
            <div class="comment-function d-flex align-items-center my-1" id="commentButton_${postId}" onclick="commentPost(${postId})">
                <img id="commentImage_${postId}" src="assets/imgs/comment.gif" class="me-2">
                <span id="commentText_${postId}" class="fs-6">Comment</span>
            </div>
            <div class="share-function d-flex align-items-center my-1" id="shareButton_${postId}" onclick="sharePost(${postId})">
                <img id="shareImage_${postId}" src="assets/imgs/share.gif" class="me-2">
                <span id="shareText_${postId}" class="fs-6">Share</span>
            </div>
        </div>
    `;

  postElement.innerHTML = postInnerHTML;
  document.getElementById("post_container").appendChild(postElement);
}

/* POST (HOMEPAGE) ----- END */

/* POST TIMESTAMP ----- START */
function formatTimeAgo(timestamp) {
  const postDate = new Date(timestamp);
  const now = new Date();
  const diffInSeconds = Math.floor((now - postDate) / 1000);

  if (diffInSeconds < 60) {
    return "just now";
  } else if (diffInSeconds < 3600) {
    const minutes = Math.floor(diffInSeconds / 60);
    if (minutes == 1) {
      return `${minutes} minute ago`;
    } else {
      return `${minutes} minutes ago`;
    }
  } else if (diffInSeconds < 86400) {
    const hours = Math.floor(diffInSeconds / 3600);
    if (hours == 1) {
      return `${hours} hour ago`;
    } else {
      return `${hours} hours ago`;
    }
  } else {
    const days = Math.floor(diffInSeconds / 86400);
    if (days == 1) {
      return `${days} day ago`;
    } else {
      return `${days} days ago`;
    }
  }
}
/* POST TIMESTAMP ----- END */

/* POST LIKE ----- START */
function likePost(postId) {
  const likeCountElement = document.querySelector(
    `.like-Count[data-post-id="${postId}"]`
  );
  const likeText = document.getElementById(`likeText_${postId}`);
  const likeButton = document.getElementById(`likeButton_${postId}`);
  const likeImage = document.getElementById(`likeImage_${postId}`);
  const isLiked = likeButton.classList.contains("liked");

  fetch("like_post.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      postId: postId,
      isLiked: isLiked,
    }),
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "success") {
        likeButton.classList.toggle("liked");
        const currentlikeCount = parseInt(likeCountElement.innerText);
        likeCountElement.innerText = isLiked
          ? currentlikeCount - 1
          : currentlikeCount + 1;
        likeText.innerText = isLiked ? "Like" : "Like";
        likeText.style.fontWeight = isLiked ? "normal" : "bold";
        likeButton.style.color = isLiked ? "" : "#1877f2";
        likeImage.src = isLiked
          ? "assets/imgs/like.gif"
          : "assets/imgs/liked.gif";
      } else {
        console.error("Error updating like count:", data);
      }
    })
    .catch((error) => {
      console.error("Error updating like count:", error);
    });
}
/* POST LIKE ----- END */

/* POST (USER PROFILE) ----- START */
const fetchUserPosts = async (user_data) => {
  try {
    const response = await fetch("fetch_user_post.php");
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const posts = await response.json();
    posts.forEach((post) => createUserPostCard(post.id, post, user_data));
  } catch (error) {
    console.error("Error fetching user posts:", error);
  }
};

function createUserPostCard(postId, posts, user_data) {
  const postElement = document.createElement("div");
  postElement.classList.add("post");
  postElement.id = `post_${postId}`;

  posts.displayname = user_data.displayname;

  const author = posts.displayname;
  const timestamp = new Date(posts.timestamp);
  const timeAgo = formatTimeAgo(timestamp);
  const postText = posts.text;
  const likeCount = posts.likecount;

  const postInnerHTML = `
        <div class="post-author d-flex align-items-start mb-3">
            <div>
                <h6 class="text-dark fw-bold mb-0">${author}</h6>
                <small>${timeAgo}</small>
            </div>
        </div>
        <p class="text-dark fs-6 mb-3">${postText}</p>
        <div class="post-stats d-flex align-items-center justify-content-between border-bottom pb-1 fs-7">
            <div class="like-Count-Icn d-flex align-items-center">
                <img src="assets/imgs/like.gif">
                <span class="like-Count ms-2 mt-1" data-post-id="${postId}">${likeCount}</span>
            </div>
        </div>
        <div class="post-activity d-flex align-items-center justify-content-between">
            <div class="like-function d-flex align-items-center my-1" id="likeButton_${postId}" onclick="likePost(${postId})">
                <img id="likeImage_${postId}" src="assets/imgs/like.gif" class="me-2">
                <span id="likeText_${postId}" class="fs-6">Like</span>
            </div>
            <div class="comment-function d-flex align-items-center my-1" id="commentButton_${postId}" onclick="commentPost(${postId})">
                <img id="commentImage_${postId}" src="assets/imgs/comment.gif" class="me-2">
                <span id="commentText_${postId}" class="fs-6">Comment</span>
            </div>
            <div class="share-function d-flex align-items-center my-1" id="shareButton_${postId}" onclick="sharePost(${postId})">
                <img id="shareImage_${postId}" src="assets/imgs/share.gif" class="me-2">
                <span id="shareText_${postId}" class="fs-6">Share</span>
            </div>
            <div class="delete-function d-flex align-items-center my-1" id="deleteButton_${postId}" onclick="deletePost(${postId})">
                <img id="deleteImage${postId}" src="assets/imgs/delete.gif" class="me-2">
                <span id="deleteText${postId}" class="fs-6">Delete</span>
            </div>
        </div>
    `;

  postElement.innerHTML = postInnerHTML;

  document.getElementById("post_container").appendChild(postElement);
}

/* POST (USER PROFILE) ----- END */

/* POST DELETE ----- START */
function deletePost(postId) {
  fetch("delete_post.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "postId=" + encodeURIComponent(postId),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.text();
    })
    .then((responseText) => {
      console.log("Server response:", responseText);
      const postElement = document.getElementById(`post_${postId}`);
      if (postElement) {
        postElement.remove();
      }
    });
}
/* POST DELETE ----- END */

/* POST EDIT ----- START */
function editField(fieldName) {
  var currentValue = document.getElementById(fieldName).textContent;
  var newValue = prompt("Enter new " + fieldName + ":", currentValue);

  if (newValue !== null) {
    document.getElementById(fieldName).textContent = newValue;

    var formData = new FormData();
    formData.append("field", fieldName);
    formData.append("value", newValue);

    fetch("update_profile.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.text();
      })
      .then((data) => {
        location.reload();
      })
      .catch((error) => {
        console.error("Error updating profile:", error.message);
      });
  }
}
/* POST EDIT ----- END */

/* FOOTER ----- START */
function generateFooter() {
  return `
      <section class="footer bg-dark text-white">
          <ul class="list">
              <li>
                  <a href="#">Terms & Conditions</a>
              </li>
              <li>
                  <a href="#">Privacy Policy</a>
              </li>
          </ul>
          <p class="copyright">
              All Rights Reserves &copy; 2024
          </p>
      </section>
      `;
}
/* FOOTER ----- END */
