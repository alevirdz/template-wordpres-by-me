<?php
/* Template Name: Página de Inicio */
get_header(); // Carga el encabezado del tema
?>



<div class="">
<main class="main">

<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                <h1><?php echo esc_html( get_option( 'hero_title', 'Better Solutions For Your Business' ) ); ?></h1>
                <p><?php echo esc_html( get_option( 'hero_description', 'We are a team of talented designers making websites with Bootstrap' ) ); ?></p>
                <div class="d-flex">
                    <a href="<?php echo esc_url( get_permalink( get_option( 'hero_about_page', '#' ) ) ); ?>" class="btn-get-started">Get Started</a>
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center">
                        <i class="bi bi-play-circle"></i><span>Watch Video</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <!-- Placeholder image with Lorem Ipsum text -->
                <div style="width: 100%; height: 400px; background-color: #ddd; display: flex; justify-content: center; align-items: center; text-align: center; color: #333;">
                    <p style="font-size: 20px; font-weight: bold; margin: 0;">Lorem Ipsum Dolor Sit Amet</p>
                </div>
            </div>
        </div>
    </div>

</section>

<section id="clients" class="clients section light-background">

    <div class="container" data-aos="zoom-in">

    <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
        {
            "loop": true,
            "speed": 600,
            "autoplay": {
            "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
            },
            "breakpoints": {
            "320": {
                "slidesPerView": 2,
                "spaceBetween": 40
            },
            "480": {
                "slidesPerView": 3,
                "spaceBetween": 60
            },
            "640": {
                "slidesPerView": 4,
                "spaceBetween": 80
            },
            "992": {
                "slidesPerView": 5,
                "spaceBetween": 120
            },
            "1200": {
                "slidesPerView": 6,
                "spaceBetween": 120
            }
            }
        }
        </script>
        <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
        </div>

    </div>

    </div>

</section>
<!-- /Clients Section -->

<section id="about" class="about section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>About Us</h2>
</div><!-- End Section Title -->

<div class="container">

  <div class="row gy-4">

    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua.
      </p>
      <ul>
        <li><i class="bi bi-check2-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
        <li><i class="bi bi-check2-circle"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
        <li><i class="bi bi-check2-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo</span></li>
      </ul>
    </div>

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
      <p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
      <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
    </div>

  </div>

</div>

</section><!-- /About Section -->

<section id="testimonials" class="testimonials section">
<section id="why-us" class="section why-us light-background" data-builder="section">

<div class="container-fluid">

  <div class="row gy-4">

    <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">

      <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
        <h3><span>Eum ipsam laborum deleniti </span><strong>velit pariatur architecto aut nihil</strong></h3>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
        </p>
      </div>

      <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">

        <div class="faq-item faq-active">

          <h3><span>01</span> Non consectetur a erat nam at lectus urna duis?</h3>
          <div class="faq-content">
            <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
          <h3><span>02</span> Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</h3>
          <div class="faq-content">
            <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
          <h3><span>03</span> Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
          <div class="faq-content">
            <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

      </div>

    </div>

    <div class="col-lg-5 order-1 order-lg-2 why-us-img">
      <img src="assets/img/why-us.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
    </div>
  </div>

</div>

</section><!-- /Why Us Section -->
<section id="call-to-action" class="call-to-action section dark-background">

<img src="assets/img/cta-bg.jpg" alt="">

<div class="container">

  <div class="row" data-aos="zoom-in" data-aos-delay="100">
    <div class="col-xl-9 text-center text-xl-start">
      <h3>Call To Action</h3>
      <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div class="col-xl-3 cta-btn-container text-center">
      <a class="cta-btn align-middle" href="#">Call To Action</a>
    </div>
  </div>

</div>

</section><!-- /Call To Action Section -->

<section id="team" class="team section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Team</h2>
  <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
</div><!-- End Section Title -->

<div class="container">

  <div class="row gy-4">

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
      <div class="team-member d-flex align-items-start">
        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
        <div class="member-info">
          <h4>Walter White</h4>
          <span>Chief Executive Officer</span>
          <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
          <div class="social">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""> <i class="bi bi-linkedin"></i> </a>
          </div>
        </div>
      </div>
    </div><!-- End Team Member -->

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
      <div class="team-member d-flex align-items-start">
        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/team/team-2.jpg" class="img-fluid" alt=""></div>
        <div class="member-info">
          <h4>Sarah Jhonson</h4>
          <span>Product Manager</span>
          <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
          <div class="social">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""> <i class="bi bi-linkedin"></i> </a>
          </div>
        </div>
      </div>
    </div><!-- End Team Member -->

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
      <div class="team-member d-flex align-items-start">
        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/team/team-3.jpg" class="img-fluid" alt=""></div>
        <div class="member-info">
          <h4>William Anderson</h4>
          <span>CTO</span>
          <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
          <div class="social">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""> <i class="bi bi-linkedin"></i> </a>
          </div>
        </div>
      </div>
    </div><!-- End Team Member -->

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
      <div class="team-member d-flex align-items-start">
        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/team/team-4.jpg" class="img-fluid" alt=""></div>
        <div class="member-info">
          <h4>Amanda Jepson</h4>
          <span>Accountant</span>
          <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
          <div class="social">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""> <i class="bi bi-linkedin"></i> </a>
          </div>
        </div>
      </div>
    </div><!-- End Team Member -->

  </div>

</div>

</section><!-- /Team Section -->

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Testimonials</h2>
  <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="swiper init-swiper">
    <script type="application/json" class="swiper-config">
      {
        "loop": true,
        "speed": 600,
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": "auto",
        "pagination": {
          "el": ".swiper-pagination",
          "type": "bullets",
          "clickable": true
        }
      }
    </script>
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="testimonial-item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
          <h3>Saul Goodman</h3>
          <h4>Ceo &amp; Founder</h4>
          <div class="stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
        </div>
      </div><!-- End testimonial item -->

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
          <h3>Sara Wilsson</h3>
          <h4>Designer</h4>
          <div class="stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
        </div>
      </div><!-- End testimonial item -->

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
          <h3>Jena Karlis</h3>
          <h4>Store Owner</h4>
          <div class="stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
        </div>
      </div><!-- End testimonial item -->

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
          <h3>Matt Brandon</h3>
          <h4>Freelancer</h4>
          <div class="stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
        </div>
      </div><!-- End testimonial item -->

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
          <h3>John Larson</h3>
          <h4>Entrepreneur</h4>
          <div class="stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
        </div>
      </div><!-- End testimonial item -->

    </div>
    <div class="swiper-pagination"></div>
  </div>

</div>

</section>

<section >
<div class="subscription-newsletter footer-newsletter">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-6">
        <h4>Join Our Newsletter</h4>
        <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
        <form action="forms/newsletter.php" method="post" class="php-email-form">
          <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your subscription request has been sent. Thank you!</div>
        </form>
      </div>
    </div>
  </div>
</div>
</section>

</main>


</div>




<?php get_footer(); ?>
</body>
</html>