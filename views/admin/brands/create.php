<h2><?=$title?></h2>

<form method="post" action="/admin/brands/store">

    <div class="mb-3">
        <label for="name" class="form-label">Brand name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Brand description</label>
        <textarea name="description" id="description" class="form-control" rows="4"></textarea>
    </div>
    <div class="mb-3">
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</form>
