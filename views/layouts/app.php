<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="description">
    <meta name="keywords" content="keyword">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Home page</title>
    <link rel="stylesheet" href="/css/main.css">

</head>

<body>
  <div class="app">
    <aside class="app-nav">
      <!-- header app-navHeader-->
      <header class="app-nav-header">
        <span class="app-nav-header--title">Navigation</span>
        <span class="app-nav--hide">
          <button class="icon-button icon-button--dark">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </span>
      </header>

      <ul class="nav">
        <li class="nav-item">
          <a href="/" class="nav-link">
            
            <span class="icon"><i class="fa-solid fa-house"></i></span>
            <span>Home</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="/catalog" class="nav-link">
            <span class="icon"><i class="fa-solid fa-cart-shopping"></i></span>
            <span>Catalog</span>
          </a>
        </li>
        <li>
          <a href="/blog" class="nav-link">
            <span class="icon"><i class="fa-solid fa-list"></i></span>
            <span>Blog</span>
          </a>
        </li>
        <li>
          <a href="/contact" class="nav-link">
            <span class="icon"><i class="fa-solid fa-hashtag"></i></span>
            
            <span>Contact</span>
          </a>
        </li>
        <li>
          <a href="/about" class="nav-link">
            <span class="icon"><i class="fa-solid fa-location-dot"></i></span>
            <span>About</span>
          </a>
        </li>
        
      </ul>
    </aside>

    <div class="app-main">
      <header class="app-main-header">
        <span class="app-nav-show">
          <button class="icon-button" id="hamburger">
            <i class="fa-solid fa-bars"></i>
          </button>
        </span>

        <h1 class="app-main-header-title">
          <em class="app-main-header-title--emphasis">Container</em>
          <span>in action</span>
        </h1>

        <nav class="app-main-header-links">
          <a href="#" class="app-main-header-link">
            <span class="icon-button">
              <i class="fa-solid fa-heart"></i>
            </span>
          </a>
          <a href="/cart" class="app-main-header-link">
            <span class="icon-button fa-solid fa-cart-shopping"> 
            (<span id="total-in-cart">0</span>)</span>
          </a>
          <?php if (App\Core\Session::instance()->get('userId')):?>
            <a href="/profile" class="app-main-header-link">
              <span class="icon-button">
                <i class="fas fa-address-card"></i>
              </span>
            </a>
            <a href="/logout" class="app-main-header-link">
              <span class="icon-button">
                <i class="fas fa-sign-out-alt"></i>
              </span>
            </a>
          <?php else:?>
            <a href="/login" class="sign-in app-main-header-link">
            <span class="icon-button">
              <i class="fa-solid fa-user"></i>
            </span>
          </a>
          <?php endif;?>
          
        </nav>
               
      </header>

      <section class="hero bg-cover bg-center py-5 mt-5" style="background: url(images/bg-banner.jpg);">
        <div class="container py-5 px-4">
            <p>New Inspiration 2024</p>
            <h1>15% off on new season</h1>
            <a href="" class="btn btn-hero">Browse collection</a>
        </div>
      </section>
        
      <div class="app-main-content">
          <div class="app-content">
            <main class="content">
              <section class="Section" data-section="card">
               
                <carousel-component url = 'https://my-json-server.typicode.com/couchjanus/db' site_url="https://couchjanus.github.io"></carousel-component>

                <div class="responsive-container">
                  
                  {{ content }}
                  
                </div>
                
              </section>
            </main>
          </div>
      </div>

      <section class="divider bg-cover bg-center bg-fixed py-5 mt-5" style="background: url(./images/divider-bg.jpg)">
        <div class="divider-container py-5 px-4">
            <p>New actions and events</p>
            <h2>Notify me for events please </h2>
            <a href="" class="btn btn-hero">Subscribe</a>
            
        </div>
      </section>
    </div>
  </div>

  <div class="app-footer">
    <footer-component></footer-component>
    </div>

    <login-component></login-component>

    <script type="module" src="/js/main.js"></script>
</body>
</html>


<main>

</main>

<!-- <script type="module" src="/js/main.js"></script> -->