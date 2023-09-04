<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
<section id="Dashboard_section">
    <div class="d-flex">
        <?php echo $this->element('organizerdashboard'); ?>
        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <?php echo $this->element('allevent'); ?>
            <div class="pro_section">
                <!--  -->
                <div class="table-responsive">
                    <div class="scroll_tab">
                        <ul id="progressbar">
                            <li class="active"><a href="<?php echo SITE_URL; ?>event/settings/<?php echo $id; ?>">Manage Event</a> </li>
                            <li class="active"><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Manage Tickets</a></li>
                            <li><a href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>">Manage Committee</a> </li>
                            <li><a href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Publish Event</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <h4>Manage Packages</h4>
            <hr>
            <p>You can manage all your packages here.</p>
            <?php echo $this->Flash->render(); ?>
            <div class="row align-items-baseline">
                <div class="col-sm-9">
                    <ul class="tabes d-flex">
                        <li><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Manage</a></li>
                        <li><a href="<?php echo SITE_URL; ?>event/addons/<?php echo $id; ?>">Addons</a></li>
                        <li><a href="<?php echo SITE_URL; ?>event/questions/<?php echo $id; ?>">Questions</a></li>
                        <li><a class="active" href="<?php echo SITE_URL; ?>event/package/<?php echo $id; ?>">Package</a></li>
                    </ul>
                    <!-- <hr> -->
                </div>
                <div class="col-sm-3 addbtn">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn add_green" data-bs-toggle="modal" data-bs-target="#addgroupticket">
                        <h6 class="add_ticket d-flex align-items-center"> <i class="bi bi-plus"></i> <span>Create Package</span> </h6>
                    </button>

                    <!--Created Package Modal -->
                    <div class="modal fade" id="addgroupticket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form method="post" enctype="multipart/form-data" class="needs-validation" action="<?php echo SITE_URL; ?>event/package/<?php echo $id; ?>" id="myForm">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Package</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- =============== -->

                                        <div class="row g-3 text-start">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label><strong>Package Name:</strong></label>
                                                    <input type="text" name="package_name" class="form-control" id="packageName" required placeholder="Enter Package Name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label><strong>Package Limit:</strong></label>
                                                    <?php
                                                    $limit = [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                                                    echo $this->Form->input(
                                                        'package_limit',
                                                        ['options' => $limit, 'empty' => '--Select Limit--', 'default' => '', 'required' => 'required', 'label' => false, 'class' => 'form-select']
                                                    ); ?>
                                                </div>

                                                <div class="col-md-4">
                                                    <label><strong>Visibility:</strong></label>
                                                    <?php
                                                    $hidden = ['Y' => 'Visible', 'N' => 'Hidden'];
                                                    echo $this->Form->input(
                                                        'hidden',
                                                        ['empty' => 'Choose One', 'options' => $hidden, 'required' => 'required', 'class' => 'form-select', 'default' => '', 'label' => false]
                                                    ); ?>
                                                </div>
                                            </div>

                                            <table class="table table-striped">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th scope="col" width="5%">S.no</th>
                                                        <th scope="col" width="20%">Ticket Type</th>
                                                        <th scope="col" width="10%">Price</th>
                                                        <th scope="col" width="10%">Qty</th>
                                                        <th scope="col" width="10%">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($findtickets)) {
                                                        $i = 1;
                                                        $totalamt = 0;
                                                        $grandTotal = 0;

                                                        foreach ($findtickets as $key => $ticketName) {

                                                            if ($ticketName['type'] != 'open_sales') {
                                                                continue;
                                                            }
                                                    ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $i++; ?></th>
                                                                <td><?php echo $ticketName['title']; ?></td>
                                                                <td>
                                                                    <input type="hidden" name="ticket_price[<?php echo $ticketName['id']; ?>]" value="<?php echo $ticketName['price']; ?>">

                                                                    <?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($ticketName['price'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $type = [0 => 0, 1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                                                                    echo $this->Form->input(
                                                                        'type[' . $ticketName['id'] . ']',
                                                                        ['options' => $type, 'default' => '', 'required' => 'required', 'label' => false, 'class' => 'qty']
                                                                    ); ?>
                                                                </td>
                                                                <td>
                                                                    <span class="ticket_total"> </span>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>

                                                    <?php
                                                    }
                                                    if (!empty($event['addons'][0])) {  ?>
                                                        <thead class="table-primary">
                                                            <tr>
                                                                <th scope="col"></th>
                                                                <th scope="col">Addons</th>
                                                                <th scope="col"></th>
                                                                <th scope="col"></th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>

                                                        <?php foreach ($event['addons'] as $addonskey => $addonsDetails) { ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $i++; ?></th>
                                                                <td><?php echo $addonsDetails['name']; ?></td>
                                                                <td>
                                                                    <input type="hidden" name="addon_price[<?php echo $addonsDetails['id']; ?>]" value="<?php echo $addonsDetails['price']; ?>">
                                                                    <?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($addonsDetails['price'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $type = [0 => 0, 1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                                                                    echo $this->Form->input(
                                                                        'addons[' . $addonsDetails['id'] . ']',
                                                                        ['options' => $type, 'default' => '', 'required' => 'required', 'label' => false, 'class' => 'addon-qty']
                                                                    ); ?>
                                                                </td>
                                                                <td>
                                                                    <span class="addon-total"> </span>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>

                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <th>Total</th>
                                                        <td></td>
                                                        <td>
                                                            <input type="hidden" name="total">
                                                            <span id="complete"> </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <th>Discount</th>
                                                        <td>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="discount_amt">
                                                            <input type="number" id="discountCalculate" class="form-control discountamt" placeholder="Amount" name="discount_percentage" step="0.01" onkeyup="if(this.value<0)this.value=0" value="0">
                                                            <!-- <span id="discount"> </span> -->
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <th>Grand Total</th>
                                                        <td></td>
                                                        <th>
                                                            <input type="hidden" name="grandtotal">
                                                            <span id="grandtotal"> </span>
                                                        </th>
                                                    </tr>

                                                    <script>
                                                        // $(document).ready(function() {
                                                        //     $("#myForm").submit(function(e) {
                                                        //         var selectedValue = parseInt($(".qty").val());
                                                        //         if (selectedValue === 0) {
                                                        //             e.preventDefault();
                                                        //             alert("Please select a quantity greater than 0.");
                                                        //         }
                                                        //     });
                                                        // });

                                                        function refreshPage() {
                                                            location.reload();
                                                        }


                                                        jQuery($ => {
                                                            $('.qty').on('change', e => {
                                                                let qty = parseInt(e.target.value);
                                                                let $ticketPrice = $(e.target).closest('tr').find('input[name^="ticket_price"]');
                                                                let ticketPrice = parseFloat($ticketPrice.val());
                                                                let totalPrice = qty * ticketPrice;
                                                                let $totalPriceElement = $(e.target).closest('tr').find('.ticket_total');
                                                                $totalPriceElement.html("<?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?>" + totalPrice.toFixed(2) + " <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : "USD"; ?>");

                                                                calculateTotalAmount();

                                                            });
                                                        });

                                                        jQuery($ => {
                                                            $('.addon-qty').on('change', e => {
                                                                let $row = $(e.target).closest('tr');
                                                                let price = parseFloat($row.find('input[type="hidden"]').val());
                                                                let qty = parseInt(e.target.value);
                                                                let total = price * qty;
                                                                $row.find('.addon-total').html(`<?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?>${total.toFixed(2)} <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : "USD"; ?>`);
                                                                calculateTotalAmount();
                                                            });
                                                        });

                                                        // function calculateTotalAmount() {
                                                        //     var ticketAmount = 0;
                                                        //     var addonAmount = 0;
                                                        //     var discountPercentage = parseFloat($("#discountCalculate").val());

                                                        //     if (discountPercentage > 100) {
                                                        //         $("#discountCalculate").val(0);
                                                        //         return false;
                                                        //     }


                                                        //     // Calculate the total ticket amount
                                                        //     $(".ticket_total").each(function() {
                                                        //         var amount = parseFloat($(this).text().replace(/[^0-9.-]+/g, ""));
                                                        //         if (!isNaN(amount)) {
                                                        //             ticketAmount += amount;
                                                        //         }
                                                        //     });

                                                        //     // Calculate the total addon amount
                                                        //     $(".addon-total").each(function() {
                                                        //         var amount = parseFloat($(this).text().replace(/[^0-9.-]+/g, ""));
                                                        //         if (!isNaN(amount)) {
                                                        //             addonAmount += amount;
                                                        //         }
                                                        //     });

                                                        //     // Calculate the total amount
                                                        //     var totalAmount = ticketAmount + addonAmount;

                                                        //     // Update the total amount element
                                                        //     var $totalAmountElement = $("#complete");
                                                        //     $totalAmountElement.html("<?php //echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; 
                                                                                            ?>" + totalAmount.toFixed(2) + " <?php //echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : "USD"; 
                                                                                                                                ?>");

                                                        //     // Update the hidden input field for the total amount
                                                        //     $("input[name='total']").val(totalAmount.toFixed(2));

                                                        //     // Calculate the discount amount

                                                        //     if (!isNaN(discountPercentage)) {
                                                        //         discountPercentage = totalAmount * discountPercentage / 100;
                                                        //         $("#discount").val(discountPercentage.toFixed(2));
                                                        //     }

                                                        //     // Update the total discount element
                                                        //     var $totalDiscount = $("#discount");
                                                        //     if ($("#discountCalculate").val() != "") {
                                                        //         $totalDiscount.html("<?php //echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; 
                                                                                        ?>" + discountPercentage.toFixed(2) + " <?php //echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : "USD"; 
                                                                                                                                ?>");
                                                        //     } else {
                                                        //         $totalDiscount.html("");
                                                        //     }

                                                        //     // Update Grand total amount 
                                                        //     var $grandTotal = $("#grandtotal");
                                                        //     if (isNaN(discountPercentage)) {
                                                        //         grandTotal = totalAmount;
                                                        //     } else {
                                                        //         var grandTotal = totalAmount - discountPercentage;
                                                        //     }
                                                        //     $grandTotal.html("<?php //echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; 
                                                                                    ?>" + grandTotal.toFixed(2) + " <?php //echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; 
                                                                                                                    ?>");

                                                        //     //Update Grand total hidden field 
                                                        //     $("input[name='grandtotal']").val(grandTotal.toFixed(2));

                                                        //     //Update discount_amt hidden field 
                                                        //     $("input[name='discount_amt']").val(discountPercentage.toFixed(2));

                                                        // }

                                                        function calculateTotalAmount() {
                                                            var ticketAmount = 0;
                                                            var addonAmount = 0;
                                                            let grandTotal = 0;
                                                            var totalAmount = 0;
                                                            var $totalAmountElement = 0;

                                                            // Calculate the total ticket amount
                                                            $(".ticket_total").each(function() {
                                                                var amount = parseFloat($(this).text().replace(/[^0-9.-]+/g, ""));
                                                                if (!isNaN(amount)) {
                                                                    ticketAmount += amount;
                                                                }
                                                            });

                                                            // Calculate the total addon amount
                                                            $(".addon-total").each(function() {
                                                                var amount = parseFloat($(this).text().replace(/[^0-9.-]+/g, ""));
                                                                if (!isNaN(amount)) {
                                                                    addonAmount += amount;
                                                                }
                                                            });


                                                            // Calculate the total amount
                                                            totalAmount = ticketAmount + addonAmount;

                                                            // Update the total amount element
                                                            $totalAmountElement = $("#complete");
                                                            $totalAmountElement.html("<?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?>" + totalAmount.toFixed(2) + " <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : "USD"; ?>");


                                                            // Update the hidden input field for the total amount
                                                            $("input[name='total']").val(totalAmount.toFixed(2));

                                                            // Calculate the discount amount
                                                            var discountAmount = parseFloat($("#discountCalculate").val());

                                                            // Update the discount amount element
                                                            var $totalDiscount = $("#discount");
                                                            if (discountAmount > 0) {
                                                                $totalDiscount.html("<?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?>" + discountAmount.toFixed(2) + " <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : "USD"; ?>");
                                                            } else {
                                                                $totalDiscount.html("");
                                                            }

                                                            // Update Grand total amount 
                                                            grandTotal = totalAmount - discountAmount;
                                                            // console.log(grandTotal);
                                                            // console.log(discountAmount);
                                                            var $grandTotal = $("#grandtotal");
                                                            $grandTotal.html("<?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?>" + grandTotal.toFixed(2) + " <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; ?>");

                                                            //Update Grand total hidden field 
                                                            $("input[name='grandtotal']").val(grandTotal.toFixed(2));

                                                            //Update discount_amt hidden field 
                                                            $("input[name='discount_amt']").val(discountAmount.toFixed(2));
                                                        }

                                                        //Discount calculate
                                                        jQuery($ => {
                                                            // Attach an event listener to the discount input element
                                                            $('#discountCalculate').on('change', () => {
                                                                calculateTotalAmount();
                                                            });
                                                        });
                                                    </script>

                                                </tbody>
                                            </table>


                                        </div>
                                        <!-- ================== -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="refreshPage()">Close</button>
                                        <button type="submit" class="btn save">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Created Package Modal Closed -->
                </div>
            </div>

            <div class="contant_bg">
                <div class="event_settings">

                    <h6>Packages</h6>
                    <hr>
                    <?php
                    if (!empty($packageData)) {
                        foreach ($packageData as $key => $value) { //pr($value);exit;
                    ?>
                            <div class="row d-flex justify-content-end align-items-center item_bg">
                                <div class="col-sm-10 on_sale">

                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <p class="p_icon head">
                                                <?php echo ucwords(strtolower($value['name'])); ?>
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="col-sm-4 col-12">
                                                    <p class="p_icon">
                                                        <strong><i class="bi bi-cash"></i> Price:</strong> <?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($value['grandtotal'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : "USD"; ?>
                                                    </p>
                                                </div>

                                                <div class="col-sm-4 col-12">
                                                    <p class="p_icon">
                                                        <strong><i class="bi bi-eye"></i> Visibility:</strong> <?php echo $value['hidden'] == 'Y' ? 'Hidden' : 'Visible'; ?>
                                                    </p>
                                                </div>
                                                <div class="col-sm-4 col-12">
                                                    <p class="p_icon">
                                                        <strong><i class="bi bi-bag-plus-fill"></i> Limit:</strong> <?php echo $value['package_limit']; ?>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-sm-2 text-end">

                                    <div class="dropdown">
                                        <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="globalModalssbid dropdown-item" href="<?php echo SITE_URL; ?>event/editpackage/<?php echo $event['id'] . '/' . $value['id']; ?>" title="Edit Addon"> Edit</a> </li>

                                            <li>
                                                <a class="dropdown-item" href="<?php echo SITE_URL . 'event/toggle/hiddenpackage/' . $value['id']; ?>"><?php if ($value['hidden'] == 'Y') {
                                                                                                                                                            echo 'Show';
                                                                                                                                                        } else {
                                                                                                                                                            echo 'Hide';
                                                                                                                                                        } ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>

                        <center>
                            <p><i>You don`t have any package created.</i></p>
                        </center>

                    <?php } ?>

                    <div class="next_prew_btn d-flex justify-content-between">

                        <a class="prew" href="<?php echo SITE_URL; ?>event/settings/<?php echo $id; ?>">Previous</a>
                        <a class="next" href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>">Next</a>
                    </div>

                </div>
            </div>

        </div>
        <!-- </div> -->
    </div>
</section>

<script>
    $(document).on('click', '.globalModalssbid', function(e) {
        $('#modifieddatebid').modal('show').find('.modal-body').html('<h6 style="color:red;">Loading....Please Wait</h6>');
        e.preventDefault();
        $('#modifieddatebid').modal('show').find('.modal-body').load($(this).attr('href'));
    });
</script>

<div class="modal fade" id="modifieddatebid">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
    function isPrice(e) {
        var e = e || window.event;
        var k = e.which || e.keyCode;
        var s = String.fromCharCode(k);
        if (/^[\\\"\'\;\:\.\,\[\]\>\<\/\?\=\+\_\|~`!@#\$%^&*\(\)a-z\A-Z]$/i.test(s)) {
            alert("Special characters not acceptable");
            return false;
        }
    }
</script>