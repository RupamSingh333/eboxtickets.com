 <div id="exampleevent" class="card-body">
              <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                <thead>
                  <tr>
                    <th style="text-align: center !important;" scope="col">S.No</th>
                    <th style="text-align: center !important;" scope="col">Order id</th>
                     <th style="text-align: center !important;" scope="col">Mobile No.</th>
                    <th style="text-align: center !important;" scope="col">Buyer name</th>
                    <th style="text-align: center !important;" scope="col">Quantity</th>
                    <th style="text-align: center !important;" scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody id="mypage">
                  <?php  $i=1; foreach ($comptickets as $value):   ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= "#".$value['id']; ?></td>
<td><?= ucfirst($value->user->mobile) ?></td>
                    <td><?= ucfirst($value->user->name) ?></td>
                    <td><?= $value['ticket_buy']; ?></td>
                    <td><?= $value['amount']; ?></td>
                    
                  </tr>
        <?php $i++; endforeach; ?>
</tbody>
</table>

</div>