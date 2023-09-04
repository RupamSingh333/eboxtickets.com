 <div id="exampleevent" class="card-body">
              <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                <thead>
                  <tr>
                    <th scope="col"><?= $this->Paginator->sort('S.No') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Ticket id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Buyer name') ?></th>
                  </tr>
                </thead>
                <tbody id="mypage">
                  <?php  $i=1; foreach ($comptickets as $value):?>
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= $value['ticketdetail'][0]['ticket_num']; ?></td>
                    <td><?= ucfirst($value->user->name) ?></td>
                    
                  </tr>
        <?php $i++; endforeach; ?>
</tbody>
</table>

</div>