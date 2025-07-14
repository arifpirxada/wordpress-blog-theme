<style>
    .slider-container {
        width: 100%;
        position: relative;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .slider-wrapper {
        position: relative;
        height: 500px;
        overflow: hidden;
    }

    .slider-track {
        display: flex;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }

    .slide {
        min-width: 100%;
        height: 100%;
        position: relative;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .slide-content {
        position: relative;
        z-index: 2;
        max-width: 600px;
        padding: 40px;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease;
    }

    .slide.active .slide-content {
        opacity: 1;
        transform: translateY(0);
    }

    .slide h2 {
        font-size: 3rem;
        margin-bottom: 20px;
        font-weight: 700;
        background: linear-gradient(45deg, #fff, #f0f0f0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .slide p {
        font-size: 1.2rem;
        line-height: 1.6;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .slide-btn {
        display: inline-block;
        padding: 15px 30px;
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
    }

    .slide-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(255, 107, 107, 0.4);
    }

    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .nav-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-50%) scale(1.1);
    }

    .nav-btn.prev {
        left: 20px;
    }

    .nav-btn.next {
        right: 20px;
    }

    .dots-container {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 15px;
        z-index: 10;
    }

    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .dot.active {
        background: white;
        transform: scale(1.2);
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.6);
    }

    .dot:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: scale(1.1);
    }

    .progress-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background: linear-gradient(90deg, #ff6b6b, #ee5a24);
        transition: width 0.3s ease;
        z-index: 10;
    }

    @media (max-width: 768px) {
        .slider-wrapper {
            height: 400px;
        }

        .slide h2 {
            font-size: 2rem;
        }

        .slide p {
            font-size: 1rem;
        }

        .slide-content {
            padding: 20px;
        }

        .nav-btn {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
    }
</style>

<?php

require_once get_template_directory() . '/' . "inc/classes/class-homepage-banners.php";

$homepage_banners = ELEMENTAL_HOMEPAGE_BANNERS::get_instance();
$all_banners = $homepage_banners->get_active_banners();

?>

<div class="slider-container">
    <div class="slider-wrapper">
        <div class="slider-track" id="sliderTrack">

            <?php if (!empty($all_banners)) {
                foreach ($all_banners as $banner) {
            ?>

                    <div class="slide active" style="background-image: url('<?php echo esc_url($banner['image']) ?>')">
                        <div class="slide-content">
                            <h2><?php echo esc_html($banner['heading']) ?></h2>
                            <p><?php echo esc_html($banner['description']) ?></p>
                            <?php
                            if (!empty($banner['button_text']) && !empty($banner['button_url'])) {
                            ?>
                                <a href="<?php echo esc_url($banner['button_url']) ?>" class="slide-btn"><?php echo esc_html($banner['button_text']) ?></a>
                            <?php } ?>
                        </div>
                    </div>

            <?php
                }
            }
            ?>

        </div>

        <button class="nav-btn prev" onclick="changeSlide(-1)">❮</button>
        <button class="nav-btn next" onclick="changeSlide(1)">❯</button>

        <div class="dots-container">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
        </div>

        <div class="progress-bar" id="progressBar"></div>
    </div>
</div>

<script>
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const sliderTrack = document.getElementById('sliderTrack');
    const progressBar = document.getElementById('progressBar');
    const totalSlides = slides.length;

    let autoSlideInterval;
    const autoSlideDelay = 5000; // 5 seconds

    function updateSlider() {
        // Move slider track
        sliderTrack.style.transform = `translateX(-${currentSlideIndex * 100}%)`;

        // Update active slide
        slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === currentSlideIndex);
        });

        // Update active dot
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlideIndex);
        });

        // Update progress bar
        const progress = ((currentSlideIndex + 1) / totalSlides) * 100;
        progressBar.style.width = progress + '%';
    }

    function changeSlide(direction) {
        currentSlideIndex += direction;

        if (currentSlideIndex >= totalSlides) {
            currentSlideIndex = 0;
        } else if (currentSlideIndex < 0) {
            currentSlideIndex = totalSlides - 1;
        }

        updateSlider();
        resetAutoSlide();
    }

    function currentSlide(index) {
        currentSlideIndex = index - 1;
        updateSlider();
        resetAutoSlide();
    }

    function autoSlide() {
        currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
        updateSlider();
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(autoSlide, autoSlideDelay);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    // Initialize slider
    updateSlider();
    startAutoSlide();

    // Pause auto-slide on hover
    const sliderContainer = document.querySelector('.slider-container');
    sliderContainer.addEventListener('mouseenter', () => {
        clearInterval(autoSlideInterval);
    });

    sliderContainer.addEventListener('mouseleave', () => {
        startAutoSlide();
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            changeSlide(-1);
        } else if (e.key === 'ArrowRight') {
            changeSlide(1);
        }
    });

    // Touch/swipe support
    let startX = 0;
    let endX = 0;

    sliderContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });

    sliderContainer.addEventListener('touchmove', (e) => {
        endX = e.touches[0].clientX;
    });

    sliderContainer.addEventListener('touchend', () => {
        const difference = startX - endX;
        const threshold = 50;

        if (Math.abs(difference) > threshold) {
            if (difference > 0) {
                changeSlide(1); // Swipe left - next slide
            } else {
                changeSlide(-1); // Swipe right - previous slide
            }
        }
    });
</script>