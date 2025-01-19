<div class="mt-3 d-inline-flex justify-content-between align-items-center">
  <h2>Badges list</h2>
  <a href="/admin/badges/create" class="btn btn-primary align-middle">Add new</a>
</div>


<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Actions</th> 
            </tr>
          </thead>
          <tbody>
            <?php foreach ($badges as $badge):?>
            <tr>
              <td><?=$badge->id?></td>
              <td><?=$badge->title?></td>
              <td>
                <a class="btn btn-info" href="/admin/badges/edit/<?=$badge->id?>">Edit</a>
                <a class="btn btn-danger" href="/admin/badges/destroy/<?=$badge->id?>">Delete</a>
            </td>   
            </tr>
            <?php endforeach?>
            
          </tbody>
        </table>
</div>