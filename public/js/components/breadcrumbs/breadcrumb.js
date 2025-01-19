const template = document.createElement('template');
template.innerHTML = `
<style>
@import "/js/components/breadcrumbs/style.css"; 
</style>
<section class="bg-light mt-5">
    <div class="container py-5">
          <div class="breadcrumb-container"></div>
    </div>
</section>`;

export default class Breadcrumb extends HTMLElement {
    constructor() {
        super();
        this.shadow = this.attachShadow({mode: 'open'});
        this.shadow.appendChild(template.content);
    }

    get title() {
        return this.getAttribute('title');
    }
    
    get page_title() {
        return this.getAttribute('page_title');
    }

    get breadcrumbs() {
        // return this.getAttribute('breadcrumbs');
        return this.getAttribute( 'breadcrumbs' )
    }

    makeCrumbBlock = () => `
    <div class="breadcrumb-title">${this.title}</div>
            
    <ul class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
          <li class="breadcrumb-item active"></li>
    </ul>
    </div>`;

    connectedCallback() {
        const crumb = this.shadow.querySelector('.breadcrumb-container');
        console.log(this.breadcrumbs);
        crumb.innerHTML = this.makeCrumbBlock()
    }
}
