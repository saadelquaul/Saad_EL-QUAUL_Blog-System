<?php

?>
<header>
        <h1>INSPIRE Blog</h1>
        <?php if (isset($_SESSION['user_id'])) {
         echo "<div class='profile'>" . 
                '<img src="../assets/images/user-1.jpg" alt="User" width="30" height="30" class="profile-img">' .
                '<div class="profile-info none">' . 
                   '<p class = "articles"> Articles</p>
                    <p class = "bookmarks">BookMarks</p>
                    <p class = "edit">Edit Profile</p>
                    <a href="../templates/logout.php?action=lg"><p class = "logout">Log Out</p></a>
                    
                </div>
            </div>';
        } ?>
            
        
</header>