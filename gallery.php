<?php
function getMyPhotos($folder) {
    $fullPath = "img/" . $folder . "/";
    $files = glob($fullPath . "*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}", GLOB_BRACE);
    return $files ? $files : [];
}

$photos1 = getMyPhotos("sunflower");   // Соняшник
$photos2 = getMyPhotos("poppy");       // Мак
$photos3 = getMyPhotos("viburnum");    // Калина
$photos4 = getMyPhotos("cornflower");  // Волошка
$photos5 = getMyPhotos("mallow");      // Мальва
$photos6 = getMyPhotos("marigolds");   // Чорнобривці
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Галерея</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="subpage-nav">
    <div class="subpage-nav__container">
        <div class="sidebar__logo subpage-logo">
            <a href="index.html">Квіти Перемоги</a>
        </div>
        <ul class="subpage-nav__links">
            <li><a href="#gallery-home">Головна</a></li>
            <li><a href="#gallery1">Соняшник</a></li>
            <li><a href="#gallery2">Мак</a></li>
            <li><a href="#gallery3">Калина</a></li>
            <li><a href="#gallery4">Волошка</a></li>
            <li><a href="#gallery5">Мальва</a></li>
            <li><a href="#gallery6">Чорнобривці</a></li>
        </ul>
    </div>
</nav>

<main>
    <section class="subpage-hero" id="gallery-home" style="
          background-image: linear-gradient(
              rgba(0, 0, 0, 0.6),
              rgba(0, 0, 0, 0.6)
            ),
            url('img/gallery.jpg');
        ">
        <div class="subpage-hero__content">
            <h1>Галерея Перемоги</h1>
            <p>Краса української природи у кожній пелюстці</p>
            <a href="#gallery1" class="subpage-home-btn">Дивитись колекції</a>
        </div>
    </section>

    <section class="gallery-section" id="gallery1">
        <h2>Соняшник</h2>
        <div class="gallery-grid grid-2x2">
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
        </div>
        <div class="dots-container"></div>
        <div class="controls">
            <button class="nav-btn" onclick="updateGallery('gallery1', -1)">← Назад</button>
            <button class="nav-btn" onclick="updateGallery('gallery1', 1)">Вперед →</button>
        </div>
    </section>

    <section class="gallery-section" id="gallery2">
        <h2>Мак</h2>
        <div class="gallery-grid grid-vertical">
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
        </div>
        <div class="dots-container"></div>
        <div class="controls">
            <button class="nav-btn" onclick="updateGallery('gallery2', -1)">← Назад</button>
            <button class="nav-btn" onclick="updateGallery('gallery2', 1)">Вперед →</button>
        </div>
    </section>

    <section class="gallery-section" id="gallery3">
        <h2>Калина</h2>
        <div class="gallery-grid grid-2x2">
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
        </div>
        <div class="dots-container"></div>
        <div class="controls">
            <button class="nav-btn" onclick="updateGallery('gallery3', -1)">← Назад</button>
            <button class="nav-btn" onclick="updateGallery('gallery3', 1)">Вперед →</button>
        </div>
    </section>

    <section class="gallery-section" id="gallery4">
        <h2>Волошка</h2>
        <div class="gallery-grid grid-vertical">
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
        </div>
        <div class="dots-container"></div>
        <div class="controls">
            <button class="nav-btn" onclick="updateGallery('gallery4', -1)">← Назад</button>
            <button class="nav-btn" onclick="updateGallery('gallery4', 1)">Вперед →</button>
        </div>
    </section>

    <section class="gallery-section" id="gallery5">
        <h2> Мальва</h2>
        <div class="gallery-grid grid-2x2">
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
        </div>
        <div class="dots-container"></div>
        <div class="controls">
            <button class="nav-btn" onclick="updateGallery('gallery5', -1)">← Назад</button>
            <button class="nav-btn" onclick="updateGallery('gallery5', 1)">Вперед →</button>
        </div>
    </section>

    <section class="gallery-section" id="gallery6">
        <h2>Чорнобривці </h2>
        <div class="gallery-grid grid-vertical">
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
            <div class="frame"><img src="" alt=""></div>
        </div>
        <div class="dots-container"></div>
        <div class="controls">
            <button class="nav-btn" onclick="updateGallery('gallery6', -1)">← Назад</button>
            <button class="nav-btn" onclick="updateGallery('gallery6', 1)">Вперед →</button>
        </div>
    </section>
</main>

<button id="backToTop" class="back-to-top" title="Нагору">
    <span class="arrow">↑</span>
</button>

<script>
    window.galleryData = {
        "gallery1": <?php echo json_encode(array_chunk($photos1, 4)); ?>,
        "gallery2": <?php echo json_encode(array_chunk($photos2, 4)); ?>,
        "gallery3": <?php echo json_encode(array_chunk($photos3, 4)); ?>,
        "gallery4": <?php echo json_encode(array_chunk($photos4, 4)); ?>,
        "gallery5": <?php echo json_encode(array_chunk($photos5, 4)); ?>,
        "gallery6": <?php echo json_encode(array_chunk($photos6, 4)); ?>
    };

    function forceFirstLoad() {
        for (let id in window.galleryData) {
            const section = document.getElementById(id);
            if (section && window.galleryData[id].length > 0) {
                const firstSlide = window.galleryData[id][0];
                const imgs = section.querySelectorAll('img');
                imgs.forEach((img, i) => {
                    if (firstSlide[i]) {
                        img.src = firstSlide[i];
                        img.parentElement.style.display = "block";
                        img.style.opacity = "1";
                    } else {
                        img.parentElement.style.display = "none";
                    }
                });
            }
        }
    }
    window.onload = forceFirstLoad;
</script>

<script>
    const backToTopBtn = document.getElementById("backToTop");
    window.onscroll = function() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            backToTopBtn.classList.add("show");
        } else {
            backToTopBtn.classList.remove("show");
        }
    };
    backToTopBtn.onclick = function() {
        window.scrollTo({ top: 0, behavior: "smooth" });
    };
</script>
<script src="js/gallery-script.js"></script>
</body>
</html>