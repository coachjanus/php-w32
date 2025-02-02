<section class="py-5 mb-3">
  <h1><?=$title;?></h1>
    <main>
      <?php if (count($orders)>0):?>

        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Ordered date</th>
              <th>Ordered status</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>

            <?php foreach ($orders as $order):?> 
              <tr>
                <td>
                <?=$order->id;?>
                </td>
                <td><?=$order->order_date;?></td>
                <td><?=$order->status;?></td>
                <td>
                  <form method="POST" style="display: inline-block;">
                    <input type="submit" class="btn btn-danger" value="delete">
                  </form>
                </td>
              </tr>
            <?php endforeach?>
          </tbody>
        </table>

      <?php else:?>
        <h2>No orders yet</h2>
      <?php endif?>
             
    </main>

</section>
