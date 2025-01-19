<h2><?=$title?></h2>

<form method="post" action="/admin/brands/update">
<input type="hidden" name="id" value="<?=$brand->id?>">
    <div class="mb-3">
        <label for="name" class="form-label">Brand name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?=$brand->name?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Brand description</label>
        <textarea name="description" id="description" class="form-control" rows="4">
        <?="$brand->description"?>
        </textarea>
    </div>
    <div class="mb-3">
        <input type="submit" value="Update" class="btn btn-primary">
    </div>
</form>
