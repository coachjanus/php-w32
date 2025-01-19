<h2><?=$title?></h2>

<form method="post" action="/admin/roles/update">
<input type="hidden" name="id" value="<?=$role->id?>">
    <div class="mb-3">
        <label for="name" class="form-label">Role name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?=$role->name?>">
    </div>
    
    <div class="mb-3">
        <input type="submit" value="Update" class="btn btn-primary">
    </div>
</form>
