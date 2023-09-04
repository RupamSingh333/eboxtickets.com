    <?php echo $this->Form->create($packageData, array(
        'url' => array('controller' => 'event', 'action' => 'editpackage/' . $id),
        'class' => '',
        'id' => '',
        'enctype' => 'multipart/form-data',
        'validate',
        'autocomplete' => 'off'

    )); ?>


    <div class="row g-3 text-start">
        <div class="row g-3">
            <div class="col-md-4">
                <label><strong>Package Name:</strong></label>
                <?php
                echo $this->Form->input('package_name', [
                    'type' => 'text',
                    'label' => false,
                    'value' => $packageData['name'],
                    'class' => 'form-control',
                    'id' => 'packageName',
                    'required' => true,
                    'placeholder' => 'Enter Package Name'
                ]);

                ?>
            </div>
            <div class="col-md-4">
                <label><strong>Package Limit:</strong></label>
                <?php
                $limit = [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                echo $this->Form->input(
                    'package_limit',
                    [
                        'options' => $limit,
                        'empty' => '--Select Limit--',
                        'required' => 'required',
                        'label' => false,
                        'class' => 'form-select',
                        'disabled' => true // Set the disabled attribute to true
                    ]
                );
                ?>
            </div>


            <div class="col-md-4">
                <label><strong>Visibility:</strong></label>
                <?php
                $hidden = ['N' => 'Visible', 'Y' => 'Hidden'];
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
                if (!empty($packageData)) {
                    $i = 1;
                    foreach ($packageData['packagedetails'] as $key => $ticketDetails) {

                        $totalticket += $ticketDetails['price'] * $ticketDetails['qty'];
                ?>
                        <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <td><?php echo $ticketDetails['eventdetail']['title']; ?></td>
                            <td>
                                <input type="hidden" name="ticket_price[<?php echo $ticketDetails['eventdetail']['id']; ?>]" value="<?php echo $ticketDetails['price']; ?>">

                                <?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($ticketDetails['price'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; ?>

                            </td>
                            <td>
                                <?php
                                $type = [0 => 0, 1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                                echo $this->Form->input(
                                    'type[' . $ticketDetails['ticket_type_id'] . ']',
                                    ['options' => $type, 'value' => $ticketDetails['qty'], 'required' => 'required', 'label' => false, 'class' => 'qty', 'disabled' => true]
                                );
                                ?>

                            </td>
                            <td>
                                <span class="ticket_total">
                                    <?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($ticketDetails['price'] * $ticketDetails['qty'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; ?>
                                </span>
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

                    <?php
                    foreach ($addonsData as $addonskey => $addonsDetails) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <td><?php echo $addonsDetails['addon']['name']; ?></td>
                            <td>
                                <input type="hidden" name="addon_price[<?php echo $addonsDetails['addon_id']; ?>]" value="<?php echo $addonsDetails['price']; ?>">
                                <?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($addonsDetails['price'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; ?>
                            </td>
                            <td>
                                <?php
                                $type = [0 => 0, 1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                                echo $this->Form->input(
                                    'addons[' . $addonsDetails['addon_id'] . ']',
                                    [
                                        'options' => $type,
                                        'value' => $addonsDetails['qty'],
                                        'required' => 'required',
                                        'label' => false,
                                        'class' => 'addon-qty',
                                        'disabled' => true, // Add this line to set the field to readonly
                                    ]
                                );
                                ?>

                            </td>
                            <td>
                                <span class="addon-total">
                                    <?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($addonsDetails['price'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; ?>
                                </span>
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
                        <span id="complete">
                            <?php
                            echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$";
                            ?><?php echo number_format($packageData['total'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; ?>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <th>Discount</th>
                    <td>
                        <!-- <input type="number" id="discountCalculate" name="discount_percentage" step="0.01" onkeyup="if(this.value>100)this.value=0"> -->
                        <?php //echo $packageData['discount_percentage']; ?>
                    </td>
                    <td>
                        <input type="hidden" name="discount_amt">
                        <span id="discount"> 
                            <?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($packageData['discount_amt'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; ?>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <th>Grand Total</th>
                    <td></td>
                    <th>
                        <input type="hidden" name="grandtotal">
                        <span id="grandtotal"> <?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($packageData['grandtotal'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : " USD"; ?></span>
                    </th>
                </tr>

                <script>
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

                    function calculateTotalAmount() {
                        var ticketAmount = 0;
                        var addonAmount = 0;

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
                        var totalAmount = ticketAmount + addonAmount;

                        // Update the total amount element
                        var $totalAmountElement = $("#complete");
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
                        var grandTotal = totalAmount - discountAmount;
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

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="refreshPage()">Close</button>
        <button type="submit" class="btn save">Submit</button>
    </div>
    </form>

    <!-- Created Package Modal Closed -->