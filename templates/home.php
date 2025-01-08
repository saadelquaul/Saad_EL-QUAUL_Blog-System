<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=thumb_up" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home - Blog</title>
</head>

<body>

    <div class="cnt">
        <?php include '../includes/header.php' ?>
        <nav>
            <form action="home.php" method="GET">
                <button type="submit" name="category_id" value="0">All</button>
                <button type="submit" name="category_id" value="1" class="active"> Tech</button>
                <button type="submit" name="category_id" value="2">Sports</button>
                <button type="submit" name="category_id" value="3">Lifestyle</button>
            </form>
            <div class="search-bar">
                <form action="home.php" method="GET">
                    <input type="text" name="search" placeholder="Search articles...">
                    <button type="submit">Search</button>
                </form>
            </div>
        </nav>
        <button class="add-article">Add Article</button>
    </div>
    <div class="container-admin">
        <button class="active">
            Articles
        </button>
        <button>
            Categories
        </button>
        <button>
            Users
        </button>

        

    </div>
    <div class="container">
        <?php if (empty($articles)): ?>
            <p>No articles found.</p>
        <?php else: ?>
            <?php foreach ($articles as $article): ?>
                <div class="article">
                    <?php if (!empty($article['image'])): ?>
                        <img src="<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                    <?php endif; ?>
                    <h2><?= htmlspecialchars($article['title']) ?></h2>
                    <p><?= htmlspecialchars(substr($article['content'], 0, 150)) ?>...</p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="article">
            <div style="display: flex;justify-content:space-between;align-items:center;padding:4px 0;"><div class="tags"><p>#Lol</p><p>#Funny</p></div> <button class="more"><svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" class="xfx01vb x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--color: var(--secondary-icon);"><g fill-rule="evenodd" transform="translate(-446 -350)"><path d="M458 360a2 2 0 1 1-4 0 2 2 0 0 1 4 0m6 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-12 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0"></path></g></svg></button>
            </div>
            <img src="../assets/images/Home_Section.jpeg" alt="">
            <div style="display: flex; justify-content:space-between;align-items:center;"><h2>Better Coding</h2><i class="fa-regular fa-bookmark"></i></div>
            <p>Coding is a good work here is the tips to master it... <class class="Read-more">Read More</class></p>
            <div style="display:flex;align-items:center;"><span class="material-symbols-outlined like-btn">
                    thumb_up
                </span>
                <p class="comment">17 <i class="fa-regular fa-comment"></i></p>
            </div>
        </div>
        <div class="article">
            <img src="../assets/images/Home_Section.jpeg" alt="">
            <h2>Better Coding</h2>
            <p>Coding is a good work here is the tips to master it...</p>
        </div>
        <div class="article">
            <img src="../assets/images/Home_Section.jpeg" alt="">
            <h2>Better Coding</h2>
            <p>Coding is a good work here is the tips to master it...</p>
        </div>
        <div class="article">
            <img src="../assets/images/Home_Section.jpeg" alt="">
            <h2>Better Coding</h2>
            <p>Coding is a good work here is the tips to master it...</p>
        </div>
        <div class="article">
            <img src="../assets/images/Home_Section.jpeg" alt="">
            <h2>Better Coding</h2>
            <p>Coding is a good work here is the tips to master it...</p>
        </div>
        <div class="article">
            <img src="../assets/images/Home_Section.jpeg" alt="">
            <h2>Better Coding</h2>
            <p>Coding is a good work here is the tips to master it...</p>
        </div>
    </div>
    <?php include '../includes/footer.php' ?>
</body>

</html>