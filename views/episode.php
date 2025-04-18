<!DOCTYPE html>
<html lang="de">

<head>
    <?php include 'partials/meta.php'; ?>
    <?php include 'partials/assets.php'; ?>
</head>

<body>
    <?php include 'partials/header.php'; ?>
    <div class="bg-subpage">
        <img src="/img/bg/bg-sub.svg" class="bg-img" alt="Hochofen Duisburg" width="1920" height="640">
    </div>

    <main id="content" class="container-xl" tabindex="-1">
        <div class="sub-spacer"></div>
        <div class="ep-title">
            <p class="heading-ep">
                <span class="line-break"><?php echo htmlspecialchars($episode['title']); ?></span>
            </p>
            <h1 class="highlight-text-sub"><?php echo htmlspecialchars($episode['subtitle']); ?></h1>
        </div>

        <div class="container-ep ep-spacer center-container">
            <div class="smaller-gaps">
                <div class="custom-audio-container">
                    <div class="audioplayer-1">
                        <button class="play-btn">
                            <img src="/img/nav/play.svg" alt="Play" width="24" height="24">
                        </button>
                        <button class="pause-btn">
                            <img src="/img/nav/pause.svg" alt="Pause" width="24" height="24">
                        </button>
                        <input type="range" class="seek-slider" value="0" max="100">
                    </div>
                    <div class="second-line-wrapper">
                        <div class="audioplayer-2">
                            <span class="current-time">0:00</span> / <span class="duration">0:00</span>
                        </div>
                        <div class="audioplayer-3">
                            <button class="mute-btn">
                                <img id="mute-btn-img" src="/img/nav/mute.svg" alt="Mute" width="24" height="24">
                            </button>
                            <input type="range" class="volume-slider" value="1" max="1" step="0.1">
                        </div>
                    </div>
                </div>
                <p class="short-description">Oder überall,
                    wo es Podcasts gibt:</p>
                <div class="streams-ep">
                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="<?php echo htmlspecialchars($episode['wissen-url']); ?>" target="_blank">
                                <img src="/img/dienste/logo-wisspod-dunkel.png" alt="Wissenschafts Podcasts">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="<?php echo htmlspecialchars($episode['deezer-url']); ?>" target="_blank">
                                <img src="/img/dienste/deezer.svg" alt="Deezer">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="<?php echo htmlspecialchars($episode['amazon-url']); ?>" target="_blank">
                                <img src="/img/dienste/amazon_music.svg" alt="Amazon Music">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="<?php echo htmlspecialchars($episode['apple-url']); ?>" target="_blank">
                                <img src="/img/dienste/apple.svg" alt="Apple Podcasts">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="<?php echo htmlspecialchars($episode['youtube-url']); ?>" target="_blank">
                                <img src="/img/dienste/youtube.svg" alt="Youtube">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="<?php echo htmlspecialchars($episode['castbox-url']); ?>" target="_blank">
                                <img src="/img/dienste/castbox.svg" alt="Castbox">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="<?php echo htmlspecialchars($episode['spotify-url']); ?>" target="_blank">
                                <img src="/img/dienste/spotify.svg" alt="Spotify">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="<?php echo htmlspecialchars($episode['playerfm-url']); ?>" target="_blank">
                                <img src="/img/dienste/playerfm.svg" alt="Player FM">
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <audio controls>
                <source src="<?php echo htmlspecialchars($episode['audio_url']); ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <div class="episode">
                <picture>
                    <source media="(max-width: 719px)" srcset="<?php echo $episode['image-mobile-url']; ?>">
                    <img src="<?php echo $episode['image-url']; ?>" alt="<?php echo $episode['image-alt']; ?>"
                        class="navigate-to-episode" />
                </picture>

                <div class="frame-ep">
                    <div class="text">
                        <p class="highlight-paragraph">
                            <?php echo htmlspecialchars($episode['description']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="frame-ep">
                <div class="text">
                    <h2 class="heading-ep">
                        Shownotes
                    </h2>
                </div>
                <div class="text">
                    <p class="short-description"><?php echo $episode['shownotes']; ?></p>
                </div>
            </div>
            <div class="frame-ep">
                <div class="text">
                    <h2 class="heading-ep">
                        Transkript
                    </h2>
                </div>
                <div class="text">
                    <p class="short-description">
                        <?php echo htmlspecialchars($episode['transkript']); ?>
                        <br><br>
                        <strong>Das gesamte Transkript kann hier heruntergeladen werden: </strong><br><br>
                        <a href="<?php echo htmlspecialchars($episode['transkript-url']); ?>">
                            Transkript <?php echo htmlspecialchars($episode['title']); ?>:
                            <?php echo htmlspecialchars($episode['subtitle']); ?> (PDF)
                        </a>
                    </p>

                </div>
            </div>
            <div class="frame-ep">
                <h2 class="heading-ep">Mitwirkende</h2>
                <div class="team-container">
                    <div class="team-member short-description">
                        <span class="name">Chris Herzog und Alexander Bauer</span>
                        <span class="role">Konzept, künstl. Leitung, Recherche</span>
                    </div>
                    <div class="team-member short-description">
                        <span class="name">Chris Herzog</span>
                        <span class="role">Schnitt</span>
                    </div>
                    <div class="team-member short-description">
                        <span class="name">Alexander Bauer</span>
                        <span class="role">Programmierung</span>
                    </div>
                    <div class="team-member short-description">
                        <span class="name">Sevinç Onart</span>
                        <span class="role">Redaktionelle Mitarbeit</span>
                    </div>
                    <div class="team-member short-description">
                        <span class="name">Kim Busch</span>
                        <span class="role">Inhaltliche Mitarbeit</span>
                    </div>
                    <div class="team-member short-description">
                        <span class="name">Ceren Türkmen</span>
                        <span class="role">Inhaltliche Beratung und Recherche</span>
                    </div>
                    <div class="team-member short-description">
                        <span class="name">Interviewpartner*innen</span>
                        <span class="role">Wolfgang Ullrich, Ceren Türkmen, Bengü Kocatürk-Schuster, Marie-Cecile
                            Duclercq, Wilhelm Funcke, Mahir Kuruçay, Martin Dietzsch, Lukas Bastisch</span>
                    </div>
                    <div class="team-member short-description">
                        <span class="name">Judith Weber</span>
                        <span class="role">Öffentlichkeitsarbeit & Produktion</span>
                    </div>
                    <div class="team-member short-description">
                        <span class="name">Peira GbR</span>
                        <span class="role">Produktion</span>
                    </div>
                </div>
            </div>
    </main>
    <?php include 'partials/footer.php'; ?>
    <script src="/js/audioplayer.js" defer></script>
    </div>
</body>

</html>