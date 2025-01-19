"use strict";
import Store from '/js/modules/store.js';

class CartItem {
    constructor(id, amount) {
        this.id = id;
        this.amount = amount;
    }
}

export default class Cart {
    cart = [];

    constructor(key = 'basket') {
        this.cart = Store.init(key);
        this.cartItemsAmount();
    }

    filterItem = (items, id) => items.filter(item => item.id !== id);
    findItem = (items, id) => items.find(item => item.id == id);


    cartItemsAmount() {
        const totalInCart = document.getElementById('total-in-cart');
        totalInCart.textContent = this.cart.reduce((prev, cur) => prev + cur.amount, 0);
    }

    saveCart(key = 'basket') {
        Store.set(key, this.cart);
        this.cartItemsAmount();
    }

    addProductToCart(product, amount=1){
        let inCart = this.cart.some(element => element.id === product.id);
        if (inCart){
            for (let item of this.cart) {
                if(+item.id === +product.id) {
                    // console.log(item.id, item.amount)
                    item.amount += amount;
                    this.saveCart();
                    return;
                }
            }
        }else{
            let cartItem = {...product, amount: amount};
            this.cart = [...this.cart, cartItem];
            this.saveCart();
        }        
    }

    addProductToCartButton(buttons, selector, amount=1) {
        // buttons.forEach((element) => {
        //     element.addEventListener('click', event => {
        //         event.preventDefault();
        //         let productId = event.target.closest(selector).dataset.id;
        //         let product = new CartItem(productId, amount)
        //         this.addProductToCart(product);
        //     });
        // });

        for(let element of buttons) {
            element.addEventListener('click', event => {
                event.preventDefault();
                let productId = event.target.closest(selector).dataset.id;
                let product = new CartItem(productId, amount)
                this.addProductToCart(product);
            });
        }
    }

    cartItemTemplate = (product) => `
    <tr class="cart-item" id="id${product.id}">
        <th class="desc" scope="row"><a class="name-block" href="#"><img src="${product.image}" alt="${product.name}" height="30"> ${product.name}</a></th>
        <td class="product-price">${product.price}</td>
        <td class="qty">
            <div class="number-input quantity" data-id="${product.id}">
                <button class="btn btn-dec">-</button>
                <input class="quantity-result"
                    type="number" 
                    value="${product.amount}"
                    min="1"
                    max="10"
                    required 
                />
                <button class="btn btn-inc">+</button>
            </div>
        </td>
        <td class="amount">$<span class="product-subtotal">0</span></td>
        <td><a class="remove fas fa-trash-alt" href="#!" data-id="${product.id}"></a></td>
    </tr>`;

    populateShoppingCart = (products) => {
        // console.log(products);
        let result = '';
        this.cart.forEach(item => {
            let product = this.findItem(products, item.id);
            // console.log(product);
            product = {...product, amount: item.amount}
            // console.log(product);
            result += this.cartItemTemplate(product)
        });
        return result;
    }

    setCartTotal(shoppingCartItems) {
        let tmpTotal = 0;
        let subTotal = 0;
        let cartTax = 0;
        
        this.cart.map(item => {
            let price = shoppingCartItems.querySelector(`#id${item.id} .product-price`).textContent;
            
            tmpTotal = +price * item.amount;
            
            shoppingCartItems.querySelector(`#id${item.id} .product-subtotal`).textContent = parseFloat(tmpTotal.toFixed(2));
    
            subTotal += parseFloat(tmpTotal.toFixed(2));
        });
    
        cartTax = parseFloat((subTotal * 0.07).toFixed(2));
    
        document.querySelector('.cart-subtotal').textContent = subTotal;
        document.querySelector('.cart-tax').textContent = cartTax;
        document.querySelector('.cart-total').textContent = subTotal + cartTax;
    }
    

    renderCart(shoppingCartItems) {
        this.setCartTotal(shoppingCartItems);
        shoppingCartItems.addEventListener('click', event => {
            if (event.target.classList.contains('fa-trash-alt')) {
                this.cart = this.filterItem(this.cart, event.target.dataset.id);
                this.setCartTotal(shoppingCartItems);
                this.saveCart();
                event.target.closest('.cart-item').remove();

            } else if (event.target.classList.contains('btn-inc')) {

                let tmp = this.findItem(this.cart, event.target.closest('.quantity').dataset.id);

                tmp.amount += 1;
                event.target.previousElementSibling.value = tmp.amount;

                this.setCartTotal(shoppingCartItems);
                this.saveCart();

            } else {
                if (event.target.classList.contains('btn-dec')) {
                    let tmp = this.findItem(this.cart, event.target.closest('.quantity').dataset.id);

                    if (tmp !== undefined && tmp.amount > 1) {
                        tmp.amount -= 1;
                        event.target.nextElementSibling.value = tmp.amount;
                    } else {
                        this.cart = this.filterItem(this.cart, event.target.dataset.id);
                        event.target.closest('.cart-item').remove();
                    }
                    this.setCartTotal(shoppingCartItems);
                    this.saveCart();
                }
            }
        })
    }
}