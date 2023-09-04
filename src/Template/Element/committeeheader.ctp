<?php $getdata_committee = $this->Comman->committee_assigned(); ?>
<div class="table-responsive">
    <div class="scroll_Committee">
        <ul class="tabes d-flex">
            <li><a class=" <?php if ($this->request->params['action'] == "event" || $this->request->params['action'] == "ticketdetails") {
                                echo "active";
                            } else {
                                echo "";
                            } ?>" href="<?php echo SITE_URL; ?>committee/event">Ticket Count</a></li>
            <li><a class=" <?php if ($this->request->params['action'] == "pending") {
                                echo "active";
                            } else {
                                echo "";
                            } ?>" href="<?php echo SITE_URL; ?>committee/pending">Pending (<?php echo $getdata_committee['cart_data_pending']; ?>)</a></li>
            <li><a class=" <?php if ($this->request->params['action'] == "approved") {
                                echo "active";
                            } else {
                                echo "";
                            } ?>" href="<?php echo SITE_URL; ?>committee/approved">Approved (<?php echo $getdata_committee['cart_data_approved']; ?>)</a></li>
            <li><a class=" <?php if ($this->request->params['action'] == "ignored") {
                                echo "active";
                            } else {
                                echo "";
                            } ?>" href="<?php echo SITE_URL; ?>committee/ignored">Ignored (<?php echo $getdata_committee['cart_data_ignored']; ?>)</a></li>
            <li><a class=" <?php if ($this->request->params['action'] == "complete") {
                                echo "active";
                            } else {
                                echo "";
                            } ?>" href="<?php echo SITE_URL; ?>committee/complete">Completed (<?php echo $getdata_committee['cart_data_complete']; ?>)</a></li>
        </ul>
    </div>
</div>