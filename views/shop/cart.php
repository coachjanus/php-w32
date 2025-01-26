<section class="py-5 mb-3" id="cart-page">
<h1><?=$title;?></h1>  
<div class="responsive-container cart-container mb-3">
  
    <main>
      <table class="table">
        <thead>
          <tr>
            <th class="desc" scope="col">Product</th>
            <th class="price" scope="col">Price</th>
                              <th class="quantity" scope="col">Quantity</th>
                              <th class="total" scope="col">Total</th>
                              <th class="action" scope="col">&nbsp;</th>
                          </tr>
                          </thead>
                          
            <tbody class="shopping-cart-items">
                              <tr class="cart-item">
                                  <td class="desc" scope="row">Subscription renewal</td>
                                  <td class="amount">$8.99</td>
                                  <td class="qty">
                                    <div class="number-input quantity" data-id="${product.id}">
                                      <button class="btn btn-dec">-</button>
                                      <input class="quantity-result"
                                          type="number" 
                                          value="${item.amount}"
                                          min="1"
                                          max="10"
                                          required 
                                          />
                                      <button class="btn btn-inc">+</button>
                                    </div>
                                  </td>
                                  <td class="amount">$8.99</td>
                                  <td class="">
                                      <a class="remove" href="#!"><i class="fas fa-trash-alt small text-muted"></i></a>
                                  </td>
                              </tr>
                              
                          </tbody>
                        </table>
              
                  </main>
                      
                  <aside class="sidebar">
                    <h2 class="text-uppercase mb-4">Cart total</h2>
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                      <div class="card-body">
                        <ul class="list-unstyled mb-0">
                          <li class="d-flex">
                            <strong class="text-uppercase">Subtotal</strong>
                            <span class="cart-subtotal">250</span>
                          </li>
                          <li class="d-flex">
                            <strong class="text-uppercase">Tax</strong>
                            <span class="cart-tax">2</span>
                          </li>
                          <li class="border-bottom mb-3"></li>
                            <li class="d-flex">
                              <strong class="text-uppercase">Total</strong>
                              <span class="cart-total">250</span>
                            </li>
                            <li>
                            <form action="#" class="form-container py-2">
                              <div class="input-group">
                                <input class="form-control mb-3" type="text" placeholder="Enter your coupon">
                                <button class="btn btn-send w-100" type="submit"> <i class="fas fa-gift me-2"></i>Apply coupon</button>
                              </div>
                            </form>
                          </li>
                        </ul>
                        <a class="btn btn-outline-dark checkout" href="#!" id="checkout"> Procceed to checkout<i class="fas fa-long-arrow-alt-right"></i></a>
                      </div>
                    </div>
              
                  </aside>
                </div>
              
              </section>
