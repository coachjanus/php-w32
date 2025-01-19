<h1><?=$title?></h1>
<form method="POST" action="/admin/badges/store">
<div class="mb-3">
  <label for="title" class="form-label">Badge title</label>
  <input type="text"  name="title" class="form-control" id="title" placeholder="title">
</div>

<div class="mb-3">
<button type="submit" class="btn btn-primary">Create badge</button>
</div>
</form>