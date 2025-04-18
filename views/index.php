<!DOCTYPE html>
<html lang="de">

<head>
    <?php include 'partials/meta.php'; ?>
    <?php include 'partials/assets.php'; ?>
</head>

<body>
    <?php include 'partials/header.php'; ?>

    <div class="bg">
        <img src="img/bg/bg-main.svg" class="bg-img" alt="Hochofen Duisburg" width="1920" height="1715">
    </div>

    <main id="content" class="container-xl" tabindex="-1">
        <h1 class="highlight-text">
            <span class="line-break">Grauzone</span>
            <span class="line-break">Pott</span>
        </h1>

        <section class="highlight-info">
            <div class="highlights">
                <p class="highlight-paragraph">
                    <strong>Grauzone Pott</strong>
                    beleuchtet die bisher unbeachtete Geschichte von migrantischem Widerstand und neonazistischer
                    Gewalt im Ruhrgebiet der 1980er und 1990er Jahre.
                </p>

                <div class="streams">
                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="https://wissenschaftspodcasts.de/podcasts/grauzone-pott/" target="_blank">
                                <img src="/img/dienste/logo-wisspod-dunkel.png" alt="Wissenschafts Podcasts">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="https://www.deezer.com/en/show/1001467761" target="_blank">
                                <img src="/img/dienste/deezer.svg" alt="Deezer">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="https://music.amazon.de/podcasts/b0e6abd4-ea9a-4f4f-8c86-edc8023c064c/grauzone-pott"
                                target="_blank">
                                <img src="/img/dienste/amazon_music.svg" alt="Amazon Music">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="https://podcasts.apple.com/us/podcast/grauzone-pott/id1784667635" target="_blank">
                                <img src="/img/dienste/apple.svg" alt="Apple Podcasts">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="https://www.youtube.com/playlist?list=PLaFluaFBXapZWt9hsHi-_bHKrWrpf9FL3"
                                target="_blank">
                                <img src="/img/dienste/youtube.svg" alt="Youtube">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="https://castbox.fm/channel/id6387591" target="_blank">
                                <img src="/img/dienste/castbox.svg" alt="Castbox">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="https://open.spotify.com/show/6yt622PnBA6zKMV0Snv68Y" target="_blank">
                                <img src="/img/dienste/spotify.svg" alt="Spotify">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="https://de.player.fm/series/grauzone-pott" target="_blank">
                                <img src="/img/dienste/playerfm.svg" alt="Player FM">
                            </a>
                        </p>
                    </div>

                    <div class="frame board">
                        <p class="stream-paragraph">
                            <a href="https://overcast.fm/itunes1784667635/grauzone-pott" target="_blank">
                                <img src="/img/dienste/overcast.svg" alt="Overcast">
                            </a>
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <div class="reference">
            <div class="container-sm">

                <section class="new-episode">
                    <img src="img/deko/ep-motive.png" alt="Neue Episode" class="navigate-to-episodes" />


                    <div class="new-episode-desc">
                        <h2 class="heading-quote"><a href="/episoden">Episoden</a></h2>
                        <p class="short-description">
                            Du kannst <strong>Grauzone Pott</strong>, unseren Doku-Podcast, auf allen bekannten
                            Streamingplattformen hören – oder ganz einfach direkt hier auf
                            unserer Website streamen.<br><br>

                            In unserem Episodenbereich findest du alle Folgen mit ausführlichen Shownotes, den
                            vollständigen Credits und den verwendeten Quellen.
                        </p>
                        <a class="non-decorated" href="/episoden">
                            <div class="frame board">
                                <p class="episoden-paragraph">
                                    <span class="text-node styled-text">Episoden anhören</span>
                                </p>
                            </div>
                        </a>
                    </div>
                </section>

                <section class="quote-of-the-week">
                    <blockquote>
                        <p>
                            <?php echo htmlspecialchars($quote); ?>
                        </p>
                        <div class="quote-footer">- <?php echo htmlspecialchars($author); ?></div>
                    </blockquote>
                </section>

                <section class="call-to-action">
                    <div class="action-wrapper">
                        <img id="kontakt-img" src="img/deko/kontakt.png" alt="Kontakt">
                        <div class="hello">
                            <h2 class="heading-quote-call">Meldet euch!</h2>
                            <p>Wir arbeiten an einer neuen Staffel. Wenn du Zeitzeug*in bist oder zu den 1980ern,
                                neonazistischer Gewalt oder migrantischer Selbstorganisation forscht und etwas beitragen
                                möchtest, melde dich bei uns. Deine Perspektive zählt!</p>
                            <p class="kontakt-leiste">
                                <span class="line-break"><a href="mailto:info@peira.space">info@peira.space</a></span>
                                <span class="line-break"><a href="https://www.facebook.com/peirakollektiv"
                                        target="_blank">Facebook</a></span>
                                <span class="line-break"><a href="https://www.instagram.com/peira.space/"
                                        target="_blank">Instagram</a></span>
                            </p>
                        </div>
                    </div>
                    <img class="bg-call" src="../img/deko/bg-kontakt.svg">
                </section>

            </div>

            <section class="foerderung container-sm">
                <div class="max-quote">
                    <h2 class="heading-quote">Gefördert durch</h2>
                    <div class="logo-leiste">
                        <img src="img/logos/fsk.png" alt="Fonds Soziokultur">
                        <img src="img/logos/knrw.svg" alt="Kunststiftung NRW">
                    </div>
                </div>
            </section>
        </div>
    </main>
    <?php include 'partials/footer.php'; ?>
    </div>
</body>

</html>