<div class="mt-3 d-flex justify-content-between">
  <h2>Products Management</h2>
  <a href="/admin/products/create"><button class="btn btn-primary">Add New</button></a>
</div>

<table class="table table-striped table-sm">
  <thead>
    <tr>
      <th scope="col">#Id</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>          
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $product):?>
      <tr>
        <td><?=$product->id?></td>
        <td><?=$product->name?></td>
        <td><?=$product->price?></td>
        <td>
          <a href="/admin/products/edit/<?=$product->id?>"><button class="btn btn-warning">Edit</button></a>
                <form action="/admin/products/destroy/<?=$product->id?>" method="post" style="display: inline-block;">
                <input type="hidden" name="id" value="<?=$product->id?>">
                <button class="btn btn-danger" type="submit">Delete</button>
        </td>
      </tr>
    <?php endforeach?>
  </tbody>
</table>
