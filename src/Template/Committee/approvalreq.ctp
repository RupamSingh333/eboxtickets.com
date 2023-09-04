<div class="row g-3 text-start">
    Do you want to approve this request for <?php echo $cart_data_comitee_data['user']['name']. " ".$cart_data_comitee_data['user']['lname']; ?>
    Request: For <?php echo $eventdetail['title']; ?> (<?php echo $cart_data_comitee_data['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $cart_data_comitee_data['eventdetail']['price']); ?> )
    <?php echo $this->Form->create($findtickets, array(
        'url' => array('controller' => 'committee', 'action' => 'approvalreq'),
        'class' => '',
        'id' => '',
        'enctype' => 'multipart/form-data',
        'validate',
        'autocomplete' => 'off'

    )); ?>

    <div class="row g-3 text-start">

        <div class="col-md-12">
        <input type="hidden" name="cart_id" value="<?php echo $cart_data_comitee_data['id'];?>">
            <input type="hidden" name="event_id" value="<?php echo $event_id ;?>">
            <?php if(!empty($ticketstype)){?>
            <label for="inputState" class="form-label">Choose Ticket Type</label>
            <?php /* $complimentary = $this->Comman->complimentary_assigned_tickets($cart_data_comitee_data['event']['id']);
            $complimentary_sold = $this->Comman->complimentary_assigned_ticketssold($cart_data_comitee_data['event']['id']);
         
            $complimentary_total_ticket =  $complimentary['count'] - $complimentary_sold['ticketsold'];
            */
             ?>   
            <select name="tickettype" id="" class="form-select">
     
            <!-- <option value="0">Comps <?php //echo ($cart_data_comitee_data['event']['currency']['Currency_symbol']) ? $cart_data_comitee_data['event']['currency']['Currency_symbol'] :"$"; ?>0.00 (<?php //echo  $complimentary_total_ticket; ?>  Available)</option> -->
                <?php
                foreach ($ticketstype as $key => $value) { //pr($value);exit;
                    $ticket_sold = $this->Comman->ticketsalecount_committee($cart_data_comitee_data['event']['id'],$value['eventdetail']['id']);
                    $total_ticket_data =  $value['count'] - $ticket_sold; ?>

                    <option value="<?php echo $value['eventdetail']['id'];?>" <?php if($ticket_id == $value['eventdetail']['id']){echo 'selected';}?> class="form-select"><?php echo $value['eventdetail']['title'] ." ".$cart_data_comitee_data['event']['currency']['Currency_symbol'].sprintf('%0.2f',$value['eventdetail']['price']); ?> (<?php echo  $total_ticket_data; ?> Available)</option>

                <?php } ?>
            </select>
            <?php }else{ ?>
                <?php echo "No tickets assigned"; ?>
                <?php } ?>
        </div>
        <?php if(!empty($ticketstype)){ ?>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn save">Approve</button>
        </div>
        <?php } ?>
    </div>
    </form>
    <!-- ================== -->