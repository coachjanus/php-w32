const footerTemplate = document.createElement('template');

footerTemplate.innerHTML = 
`<style>
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css");
@import url('/css/footer.css');
</style>

 <footer class="footer">
      <section class="footer-main">
        <div class="footer-main-item">
          <h3 class="footer-title">About</h3>
          <ul>
            <li><a href="#">Services</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">Pricing</a></li>
            <li><a href="#">Customers</a></li>
            <li><a href="#">Careers</a></li>
          </ul>
        </div>
        <div class="footer-main-item">
          <h3 class="footer-title">Resources</h3>
          <ul>
            <li><a href="#">Docs</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">eBooks</a></li>
            <li><a href="#">Webinars</a></li>
          </ul>
        </div>
        <div class="footer-main-item">
          <h3 class="footer-title">Contact</h3>
          <ul>
            <li><a href="#">Help</a></li>
            <li><a href="#">Sales</a></li>
            <li><a href="#">Advertise</a></li>
          </ul>
        </div>
        <div class="footer-main-item">
          <h3 class="footer-title">Stay Updated</h3>
          <p>Subscribe to our newsletter to get our latest news.</p>
          <form>
            <input type="email" name="email" placeholder="Enter email address">
            <input type="submit" value="Subscribe">
          </form>
        </div>
      </section>
      <section class="footer-social">
        <div class="footer-social-list">
          <a href="#"><i class="fa-brands fa-google"></i></a>
          <a href="#"><i class="fa-brands fa-twitter"></i></a>
          <a href="#"><i class="fa-brands fa-facebook"></i></a>
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
        </div>
        
      </section>

      <section class="footer-legal">
          <a href="#">Terms &amp; Conditions</a>
          <a href="#">Privacy Policy</a>
          <span>&copy; 2024 Copyright Shopaholic Inc.</span>
      </section>
    </footer>`;

export default class Footer extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    const fontAwesome = document.querySelector('link[href*="font-awesome"]');
    const shadow = this.attachShadow({ mode: 'closed' });

    if (fontAwesome) {
      shadow.appendChild(fontAwesome.cloneNode());
    }

    shadow.appendChild(footerTemplate.content);
  }
}

