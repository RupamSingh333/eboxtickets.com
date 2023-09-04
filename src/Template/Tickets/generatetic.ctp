<div class="modal-body">
    <div class="over" id="divToPrint">
        <div class="ticket_bg">
            <?php
            $file_pointer = '/var/www/html/eboxtickets.com/webroot/eventblurimages/' . $ticketgen['ticket']['event']['feat_image'];

            if (file_exists($file_pointer)) {
            ?>
                <img src="<?php echo SITE_URL; ?>/eventblurimages/<?php echo $ticketgen['ticket']['event']['feat_image']; ?>" class="img_bg">

            <?php } else { ?>
                <img src="<?php echo IMAGE_PATH . 'eventimages/' . $ticketgen['ticket']['event']['feat_image']; ?>" class="img_bg">

            <?php } ?>

            <div class="ticket_contant">
                <div class="row ">
                    <div class="col-12 d-flex mb-4 justify-content-between align-items-center">
                        <img class="ticket_logo" src="<?php echo IMAGE_PATH; ?>Logo.png" alt="logo">
                        <!-- <h6>#01</h6> -->
                    </div>
                    <div class="col-sm-7 col-7">
                        <div class="ticket_info">
                            <h6>EVENT</h6>
                            <p><?php echo ucwords(strtolower($ticketgen['ticket']['event']['name'])); ?></p>
                            <h6>DATE</h6>
                            <p>
                                <?php
                                $datetime = date('D, M jS Y', strtotime(($ticketgen['choosedate'] != '') ? $ticketgen['choosedate'] : $ticketgen['ticket']['event']['date_from']));
                                echo $datetime; ?>
                            </p>
                            <!-- <p>Sat, Aug 20th 2022 / <span>03:30pm</span></p> -->
                            <h6>TYPE</h6>
                            <p><?php echo ucwords(str_replace('_', ' ', $ticketname)); ?></p>
                            <?php if ($ticketgen['ticket']['event']['is_free'] == 'Y') { ?>
                                <h6>Status</h6>
                                <p><?php echo ($ticketgen['is_rsvp'] == 'N') ? 'Not Attending' : 'Attending'; ?></p>
                            <?php } ?>
                            <h6>PURCHASER</h6>
                            <p><?php echo ucwords(strtolower($user_name)); ?></p>
                            <h6>NAME</h6>
                            <p><?php echo $ticketgen['name']; ?></p>
                        </div>

                    </div>
                    <div class="col-sm-5 col-5">
                        <img src="<?php echo IMAGE_PATH . 'eventimages/' . $ticketgen['ticket']['event']['feat_image']; ?>" class="img-fluid img_t" alt="img">

                    </div>

                    <div class="col-12 my-4 text-center ">
                        <img src="<?php echo SITE_URL . 'qrimages/temp/' . $ticketgen['qrcode']; ?>" class="ticket_qucode" alt="img">

                    </div>
                </div>
            </div>


        </div>
        <!-- </div> -->

    </div>

</div>
<div class="modal-footer">

    <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
    <a class="save" download href="<?php echo SITE_URL; ?>eventticketimages/<?php echo $ticketgen['qrcode']; ?>">Download Ticket</a>
</div>

<script>
    $(document).ready(function() {
        html2canvas([document.getElementById('divToPrint')], {
            onrendered: function(canvas) {
                //document.getElementById('canvas').appendChild(canvas);
                var data = canvas.toDataURL('image/png');
                // AJAX call to send `data` to a PHP file that creates an image from the dataURI string and saves it to a directory on the server
                var image = new Image();
                image.src = data;
                var file = dataURLtoBlob(data);
                var fd = new FormData();
                fd.append("imageNameHere", file);
                fd.append("ticketqr", '<?php echo $ticketgen['qrcode']; ?>');
                $.ajax({
                    url: '<?php echo SITE_URL; ?>tickets/uploadticketimage',
                    type: "POST",
                    data: fd,
                    processData: false,
                    contentType: false,
                }).done(function(respond) {});
            }
        });

        function dataURLtoBlob(dataURL) {
            // Decode the dataURL    
            var binary = atob(dataURL.split(',')[1]);
            // Create 8-bit unsigned array
            var array = [];
            for (var i = 0; i < binary.length; i++) {
                array.push(binary.charCodeAt(i));
            }
            // Return our Blob object
            return new Blob([new Uint8Array(array)], {
                type: 'image/png'
            });
        }

    });

    $(document).bind("contextmenu", function(e) {
        return false;
    });
</script>