<div class="modal-header">
    <h4 class="modal-title">Staff List</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <?php if ($employee) { ?>
        <table class="table table-bordered table-striped" style="padding:0px" width="100%">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                </tr>
            </thead>
            <tbody class="table">
                <?php foreach ($employee as $key => $value) { ?>

                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $value['name'].' '.$value['lname']; ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td><?php echo $value['mobile']; ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <center><span>Staff not Available</span></center>
    <?php } ?>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-primary " data-dismiss="modal">Close</button>
</div>