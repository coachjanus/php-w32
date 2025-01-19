import {navigation} from './navigation.js';

const template = document.createElement('template');
template.innerHTML = `
<style>
    @import '/css/nav.css';
</style>

<ul class="nav"></ul>`;

export default class Navigation extends HTMLElement {

    constructor() {
        super();
        this.navigation = navigation;
        this.shadow = this.attachShadow({mode: 'open'});
        this.shadow.appendChild(template.content);
    }

    makeNavItem = (item) => `
    <li class="nav-item">
        <a href="${item.href}" class="nav-link">
            <span class="icon ${item.icon}"></span>
            <span>${item.title}</span>
        </a>
    </li>`;

    makeNav = () => {
        let res = '';
        this.navigation.forEach(item => {
            res += this.makeNavItem(item);
        });
        return res;
    }
    
    connectedCallback() {
        const fontAwesome = document.querySelector('link[href*="font-awesome"]');
        if (fontAwesome) {
            this.shadow.appendChild(fontAwesome.cloneNode());
        }
        const nav = this.shadow.querySelector('.nav');
        nav.innerHTML = this.makeNav()
    }
   

}