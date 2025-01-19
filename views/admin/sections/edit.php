<h2><?=$title?></h2>

<form method="post" action="/admin/sections/update">
<input type="hidden" name="id" value="<?=$section->id?>">
    <div class="mb-3">
        <label for="name" class="form-label">section name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?=$section->name?>">
    </div>
    
    <div class="mb-3">
        <input type="submit" value="Update" class="btn btn-primary">
    </div>
</form>
