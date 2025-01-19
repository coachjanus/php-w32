const template = document.createElement('template');
template.innerHTML = `
<style>
    @import '/css/form.css';
    @import '/css/auth.css';
</style>
<dialog id="login">
      <a href="#!" title="Close" class="close fas fa-times">x</a>
     
      <div class="card">
        <h2>Login</h2>
        <form class="form-container">
          <div class="input-group">
            <label class="form-label">Username or email address<span>*</span></label>
            <input type="text" placeholder="Username or Email" required class="form-control">
          </div>
          <div class="input-group">
            <label class="form-label">Password<span>*</span></label>
            <input type="password" placeholder="Password" required class="form-control">
          </div>
                
          <input type="submit" value="Sing In" />
                
          <p>
            <a href="">Forget Password?</a>
          </p>
        </form>
      </div>
    </dialog>
`;

export default class Login extends HTMLElement {

    constructor() {
        super();
    }
   
    connectedCallback() {
        this.shadow = this.attachShadow({mode: 'open'});
        this.shadow.appendChild(template.content);
        const login = this.shadow.getElementById('login');

        login.addEventListener('click', function() {
            this.close();
        })

    }

}
