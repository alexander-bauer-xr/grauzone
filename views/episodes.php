<!DOCTYPE html>
<html lang="de">

<head>
    <?php include 'partials/meta.php'; ?>
    <?php include 'partials/assets.php'; ?>
</head>

<body>
    <?php include 'partials/header.php'; ?>

    <div class="bg-subpage">
        <img src="img/bg/bg-sub.svg" class="bg-img" alt="Hochofen Duisburg" width="1920" height="640">
    </div>

    <main id="content" class="container-xl" tabindex="-1">
        <div class="sub-spacer"></div>
        <h1 class="highlight-text-sub">
            <span class="line-break">Episoden</span>
        </h1>
        <div class="container-ep center-container">
            <?php foreach ($episodes as $episode): ?>
                <div class="episode">
                   <picture>
                       <source 
                           media="(max-width: 719px)" 
                           srcset="<?php echo $episode['image-mobile-url']; ?>"
                       >
                       <img 
                           src="<?php echo $episode['image-url']; ?>" 
                           alt="<?php echo $episode['image-alt']; ?>" 
                           class="navigate-to-episode" 
                           data-id="<?php echo $episode['id']; ?>" 
                           data-slug="<?php echo $episode['slug']; ?>"
                       />
                   </picture>

                    <div class="frame-ep">
                        <div class="text">
                            <h2 class="heading-ep">
                                <a href="/episode/<?php echo $episode['id']; ?>/<?php echo $episode['slug']; ?>"><?php echo htmlspecialchars($episode['title']); ?>:
                                    <?php echo htmlspecialchars($episode['subtitle']); ?></a>
                            </h2>
                        </div>
                        <div class="text">
                            <p class="short-description">
                                <?php echo htmlspecialchars($episode['description']); ?>
                            </p>
                        </div>
                        <div class="text-mehr">
                            <a href="/episode/<?php echo $episode['id']; ?>/<?php echo $episode['slug']; ?>">
                                <p class="episoden-paragraph">
                                    <span class="text-node styled-text">Mehr erfahren</span>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php include 'partials/footer.php'; ?>
    </div>
</body>

</html>