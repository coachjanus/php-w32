
<div class="mt-1 d-flex justify-content-between">
<h2><?=$title?></h2>
<a href="/admin/categories/create" class="btn btn-primary">Add new</a>
</div>
<div class="table-responsive small">

<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">
                #
            </th>
            <th scope="col">
                Name
            </th>
            <th scope="col">
                Actions
            </th>
        </tr>

    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?=$category->id?></td>
                <td><?=$category->name?></td>
                <td><a href="/admin/categories/edit/<?=$category->id?>" class="btn btn-success">Edit</a>

                <form method="post" action="/admin/categories/destroy/<?=$category->id?>" style="display:inline-block;">
                <input type="hidden" name="id" value="<?=$category->id?>">
                <input type="submit" value="destroy" class="btn btn-danger inline">
                </form>
                
            
            </td>
            </tr>
        <?php endforeach?>
    </tbody>

</table>
</div> 