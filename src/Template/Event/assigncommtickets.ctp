<style>
    .plusbutton {
        color: #fff !important;
        background-color: #e62d56;
        border: none;
        border-radius: 5px;
        font-weight: 900;
        font-size: 20px;
        display: inline-block;
    }
</style>

<?php
if (isset($user_id) && !empty($user_id) && isset($group_id) && !empty($group_id)) {
$compstickets = $this->Comman->findticketdetails($user_id, 0, $group_id,$event_id);
}else{
$compstickets = $this->Comman->findticketdetails($user_id, 0,0,$event_id);
}
?>

<div class="modal-header">
    <h5 class="modal-title">Edit <?php echo $getuser['name']; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form class="edit-form" action="<?php echo SITE_URL . 'event/assigncommtickets' ?>" method="post">

        <div class="form-group row mb-2">
            <input type="hidden" name="group_id" value="<?php echo $group_id;?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
            <input type="hidden" name="event_id" value="<?php echo $event_id;?>">

            <!-- <label for="" class="col-sm-8 col-form-label">
                Comps ($0.00 USD)
            </label> -->
            <!-- <div class="col-sm-4">

                <ul class="list-inline d-flex">
                <li class="list-inline-item"><a href="" class="plus"> <i class="bi bi-plus"></i></a>
                    </li>
               

                    <li class="list-inline-item">     <input type="text" name="count[]" value="<?php //echo isset($compstickets['id']) ? $compstickets['count'] : 0; ?>" class="form-control">
                    </li>
                   
                    <li class="list-inline-item"><a href="" class="minus"> <i class="bi bi-dash"></i></a></li>
                </ul>


            </div> -->
        </div>
        <?php foreach ($gettickettype as $key => $value) {
            $othertickets = $this->Comman->findticketdetails($user_id, $value['id'], $group_id,$event_id);
        ?>
            <div class="form-group row mb-2">
                <label for="" class="col-sm-8 col-form-label">
                    <?php echo $value['title'] . ' ($' . sprintf('%.2f',$value['price']) . ')'; ?>
                </label>
                <div class="col-sm-4">

                    <ul class="list-inline d-flex">
                    <li class="list-inline-item"><a href="" class="plus"> <i class="bi bi-plus"></i></a>
                        </li>
                        
                        <li class="list-inline-item">
                            <input type="text" name="count[<?php echo $value['id']; ?>]" value="<?php echo isset($othertickets['id']) ? $othertickets['count'] : 0; ?>" class="form-control">
                        </li>
                        
                        <li class="list-inline-item"><a href="" class="minus"> <i class="bi bi-dash"></i></a></li>
                    </ul>


                </div>
            </div>


        <?php } ?>


        <!-- </div> -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn save">Update Ticket</button>
        </div>
    </form>
</div>

<script>
    $('.plus').on('click', function() {
        $input = $(this).closest('ul').find('input');
        $input.val(parseInt($input.val()) + 1);

        return false;
    });

    $('.minus').on('click', function() {
        $input = $(this).closest('ul').find('input');
        value = parseInt($input.val()) - 1;
        $input.val(value > 0 ? value : 0);
        return false;
    });
</script>