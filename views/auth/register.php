<main class="form-signin w-50 m-auto mt-5">
  <form method="post" action="/signup">
    
    <h1 class="h3 mb-3 fw-normal"><?=$title?></h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
      <label for="email">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password"  placeholder="Password">
      <label for="password">Password</label>
    </div>

    
    <button class="btn btn-primary py-2" type="submit">Sign up</button>
    
  </form>
</main>

