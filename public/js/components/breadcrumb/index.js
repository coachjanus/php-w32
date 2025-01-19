const template = document.createElement('template');
template.innerHTML = `
<style>
    @import '/css/crumb.css';
</style>

<section class="bg-light">
    <div class="container py-5"><div class="mt-5 d-flex crumb"></div></div>
</section>`;

export default class Breadcrumb extends HTMLElement {
    static observedAttributes = ["title", "page_title"];

    constructor() {
        super();
        this.shadow = this.attachShadow({mode: 'open'});
        this.shadow.appendChild(template.content);
    }

    attributeChangedCallback(title, oldValue, newValue) {
        if (oldValue === newValue) return;
        title = newValue;
    }

    makeCrumbBlock = () => `
    <h2 class="text-uppercase">${this.title}</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end mb-0 px-0 bg-light">
            <li class="breadcrumb-item"><a class="text-dark" href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">${this.page_title}</li>
        </ol>
    </nav>`;

    connectedCallback() {
        const crumb = this.shadow.querySelector('.crumb');
        crumb.innerHTML = this.makeCrumbBlock()
    }

    get title() {
        return this.getAttribute('title');
    }
    
    get page_title() {
        return this.getAttribute('page_title');
    }
}