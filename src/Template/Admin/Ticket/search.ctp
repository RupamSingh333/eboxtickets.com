<table id="bootstrap-data-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Purchase Date</th>
            <th>Ticket No.</th>
            <th>Event</th>
            <th>Event Date</th>
            <th>Customer</th>
            <th>Mobile</th>
            <!-- <th>Purchase Ticket</th> -->
            <th>Qty.</th>
            <th style="width: 9%;">Amount</th>
            <!-- <th>Comm(<?php //echo $admin_info['feeassignment']; ?>%)</th> -->
            <th>Commision</th>


        </tr>
    </thead>
    <tbody>
        <?php
        $total_amount = 0; // initialize total amount variable to 0
        $total_commission_amount = 0; // initialize total commission amount variable to 0
        $i = 1;
        foreach ($users_search as $key => $value) {
            $total_amount += $value['ticket']['amount']; // add amount to total amount
            $total_commission_amount += ($value['ticket']['amount'] * $value['ticket']['adminfee'] / 100); // add commission to total commission amount
        ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php if (isset($value['ticket']['created'])) {
                        echo date('d M, Y h:i A', strtotime($value['ticket']['created']));
                    }  ?></td>

                <td><?php echo $value['ticket_num']; ?></td>
                <td><?php echo ucfirst($value['ticket']['event']['name']); ?></td>
                <td>
                    <b>From</b> <?php echo date('d M, Y h:i A', strtotime($value['ticket']['event']['date_from'])); ?><br>
                    <b>To</b> <?php echo date('d M, Y h:i A', strtotime($value['ticket']['event']['date_to'])); ?>
                </td>
                <td><?php echo ucwords($value['user']['name']) . ' ' . ucwords($value['user']['lname']); ?></td>
                <td><?php echo $value['user']['mobile']; ?></td>
                <td><?php echo $value['ticket']['ticket_buy']; ?></td>
                <td>
                    <?php echo "$" . number_format($value['ticket']['amount'], 2) . " TTD"; ?>

                </td>
                <td>
                    <a style="color: black;">
                        <?php echo "$" .  number_format($value['ticket']['amount'] * $value['ticket']['adminfee'] / 100, 2) . " TTD"; ?>

                    </a>
                </td>
            </tr>
        <?php

        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8" style="text-align: right"><strong>Total Amount:</strong></td>
            <td>
                <strong>
                    <?php echo "$" . number_format($total_amount, 2) . " TTD"; ?></strong>
            </td>

            <td>
                <strong>
                    <?php echo "$" . number_format($total_commission_amount, 2) . " TTD"; ?></strong>
            </td>


        </tr>
    </tfoot>
</table>
<?php echo $this->element('admin/pagination'); ?>