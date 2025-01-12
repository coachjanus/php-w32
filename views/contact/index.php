
<h1><?= $title ?></h1>

<dl>
<?php foreach ($messages as $iten):?>
    <dt>
        <dd>
            <?=$iten->first_name?>&nbsp;<?=$iten->last_name?>
        </dd>
        <dd>
            <?=$iten->message?>
        </dd>
    </dt>

    
<?php endforeach?>
<form action="" method="post">

<label for="">First name</label>
<input type="text" name="first_name">
<label for="">Last name</label>
<input type="text" name="last_name">
<label for="">Email</label>
<input type="email" name="email">
<label for="">Message</label>
<textarea name="message" id=""></textarea>
<input type="submit">
</form>


</dl>