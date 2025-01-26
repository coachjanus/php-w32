"use strict";
import Home from '/js/modules/home.js';
import Catalog from '/js/modules/catalog.js';
import Cart from '/js/modules/cart.js';

// import { isAuth} from '/js/modules/helpers.js';


import Store from '/js/modules/store.js';

import Footer from '/js/components/footer.js';
customElements.define('footer-component', Footer);

import Breadcrumb from './components/breadcrumb/index.js';
customElements.define('breadcrumb-component', Breadcrumb);

import Navigation from './components/nav.js';
customElements.define('nav-component', Navigation);

import Icons from './components/icons.js';
customElements.define('icons-component', Icons);

import Posts from './components/blog.js';
customElements.define('posts-component', Posts);

import Login from './components/login.js';
customElements.define('login-component', Login);

import Carousel from './components/carousel.js';
customElements.define('carousel-component', Carousel);

const appNav = document.querySelector('.app-nav');
const appNavHide = document.querySelector('.app-nav--hide')
const appNavShow = document.querySelector('.app-nav-show')
const hamburger = document.querySelector('#hamburger')

const hideNav = (e) => {
    e.preventDefault();
    appNav.classList.add('app-nav__hide')
    appNav.classList.remove('app-nav__show')
    appNavShow.classList.toggle('hamburger')   
}

const showNav = (e) => {
    e.preventDefault();
    appNav.classList.toggle('app-nav__hide')
    appNav.classList.toggle('app-nav__show')
    appNavShow.classList.toggle('hamburger')       
}

function initNav() {
    appNavHide.addEventListener('touchend', hideNav);
    appNavHide.addEventListener('click', hideNav);
    hamburger.addEventListener('touchend', showNav);
    hamburger.addEventListener('click', showNav);
}

async function fetchData(url){
    return await fetch(url, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'}
    }).then(response => {
        // console.log("response", response)
        if(response.status >= 400){
            return response.json().then(err => {
                const error = new Error('Something went wrong!')
                error.data = err
                throw error
            })
        }
       

        return response.json()
    })
}

function main() {
    initNav();

    
    // const url = "http://dev.loc";
    const url = "http://localhost:8000";
    
    function signIn() {
        const loginComponent = document.querySelector('login-component');
        const shadowRoot = loginComponent.shadowRoot; 
    
        const login = shadowRoot.querySelector('#login');
        const signIn = document.querySelector('.sign-in')
        signIn.addEventListener('click', function() {
            login.showModal()
        })
        // console.log(login)
    }
    signIn()

    

    let shoppingCart = new Cart();

    const renderButton = (productContainer) => {
        let addToCartButtons = productContainer.querySelectorAll(".add-to-cart");
        shoppingCart.addProductToCartButton(addToCartButtons, '.icon-actions')
    }

    fetchData(`${url}/api/products`)
    .then(products => {
        // console.log("products", products)
    // });
    
    const homePage = document.getElementById('home-page');
    // console.log(homePage);
    
    if (homePage) {
        const home = new Home();
        let productContainer = document.querySelector('.product-container');
        productContainer.innerHTML = home.populateProductList(products);
        renderButton(productContainer);
    }
    
    const catalogPage = document.getElementById('catalog-page');

    if (catalogPage) {
        let catalog = new Catalog()

        const productContainer = document.querySelector('.product-container');
        productContainer.innerHTML = catalog.populateProductList(products);
        renderButton(productContainer);
    // 
        const categoryContainer = document.getElementById('category-container');

        fetchData(`${url}/categories`)
        .then(categories => {

            catalog.populateCategories(categoryContainer, categories);
            let categoryItems = categoryContainer.querySelectorAll('.categories li a');

            categoryItems.forEach(item => item.addEventListener('click', e => {
                e.preventDefault();
                if (e.target.classList.contains('category-item')){
                    let category = e.target.dataset.id;
                    const categoryFilter = items => items.filter(item => item.category == category);
                    productContainer.innerHTML = catalog.populateProductList(categoryFilter(products));
                }else{
                    productContainer.innerHTML = catalog.populateProductList(products);
                }
                renderButton(productContainer);
            }));

        });

        const showOnly = document.getElementById('show-only');
        showOnly.innerHTML = catalog.populateBadges(products);
        let checkboxes = showOnly.querySelectorAll('input[name="badge"]')
        let values = [];
  
        checkboxes.forEach(item => {
          item.addEventListener("change", e => {
            if (e.target.checked) {
                values.push(item.value)
            }else {
                if (values.length != 0) {
                    values.pop(item.value)
                }
            }
            productContainer.innerHTML = values.map(value => catalog.renderList(products, value)).join("");
            if (values.length == 0) {
                productContainer.innerHTML = catalog.populateProductList(products);
            }
            renderButton(productContainer);
          });
        });

        const selectPicker = document.querySelector('.select-picker');
        selectPicker.innerHTML = catalog.sortingOptions();
        selectPicker.addEventListener('change', function() {
            switch(this.value) {
                case 'low-high':
                    productContainer.innerHTML = catalog.populateProductList(products.sort(catalog.compare('price', 'asc')));
                    break;
                case 'high-low':
                    productContainer.innerHTML = catalog.populateProductList(products.sort(catalog.compare('price', 'desc')));
                    break;
                case 'popularity':
                    productContainer.innerHTML = catalog.populateProductList(products.sort(catalog.compare('stars', 'asc')));
                    break;
                default:
                    productContainer.innerHTML = catalog.populateProductList(products.sort(catalog.compare('id', 'asc')));
            } 
            renderButton(productContainer);
        });
    }


    async function isAuth(url) {
        return await fetch(`${url}/api/auth`, {
            method: 'GET',
            headers: {'Content-Type': 'application/json'}
        })
        .then(response => response.json());
    }

    const cartPage = document.getElementById('cart-page');
    if(cartPage) {
        
        const shoppingCartItems = cartPage.querySelector('.shopping-cart-items');
        shoppingCartItems.innerHTML = shoppingCart.populateShoppingCart(products);
        shoppingCart.renderCart(shoppingCartItems);

        // isAuth(url).then(auth => {
        //     console.log('auth: ', auth);
        //   if(auth) {
            // console.log(document.getElementById('checkout'))
            document.getElementById('checkout').addEventListener("click", () => {
                let inCart = [];
                Store.get("basket").forEach(item =>{
                    inCart.push({
                        id:parseInt(item.id),
                        amount: parseInt(item.amount)
                    });
                    console.log(inCart);
                });

                console.log(inCart);

                console.log(JSON.stringify({
                    cart: inCart
                }));
                fetch("api/checkout", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        cart: inCart
                    })
                })
                .then(
                    response => {
                        console.log(response);
                        Store.clear();
                        document.location.replace("/profile");
                    }
                )
                .catch(error => console.log(error));


            }) //checkout
                    
        //   }
        // })

    }

});
    
}
 
(() => {
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", main);
    } else {
        main();
    }    
})();
