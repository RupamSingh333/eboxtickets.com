


  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/card/1.3.1/js/card.min.js"></script>



  <link rel="stylesheet" href="  https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


  

<style>
.container-fluid {
    margin-top: 15px;
}
  </style>

<script>

// A $( document ).ready() block.
$( document ).ready(function() {
  

  new Card({
  form: 'form',
  container: '.card',
  formSelectors: {
    numberInput: 'input[name=number]',
    expiryInput: 'input[name=expiry]',
    cvcInput: 'input[name=cvv]',
    nameInput: 'input[name=name]'
  },

  width: 390, // optional — default 350px
  formatting: true,

  placeholders: {
    // number: '•••• •••• •••• ••••',
    // name: 'Full Name',
    // expiry: '••/••',
    // cvc: '•••'
  }
});
 
});



  </script>







  <div class = "container">
<div class = "row">
<?php echo $this->Form->create('forget',array(
                       'class'=>'form-horizontal',
                       'controller'=>'payment',
                       'action'=>'processingsale',
                       'enctype' => 'multipart/form-data',
                       'validate' )); ?>

<h3>Transaction Details</h3>

<div class="col-sm-6">
<div class="form-group">
<label>Transaction identifier</label>
<?php echo $this->Form->input('transaction_identifier',array('class'=>'form-control','placeholder'=>'Transaction identifier','label' =>false,'required'=>true,'value'=>$transaction_identifier,'readonly')); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>TotalAmount</label>
<?php echo $this->Form->input('total_amount',array('class'=>'form-control','placeholder'=>'TotalAmount','label' =>false,'required'=>true,'value'=>$total_amount)); ?>
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<label>CurrencyCode</label>
<?php echo $this->Form->input('currency_code',array('class'=>'form-control','placeholder'=>'CurrencyCode','label' =>false,'required'=>true,'value'=>$currency_code)); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>ThreeDSecure</label>
<?php echo $this->Form->input('threedsecure',array('class'=>'form-control','placeholder'=>'ThreeDSecure','label' =>false,'required'=>true,'value'=>'true','readonly')); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>OrderId</label>
<?php echo $this->Form->input('OrderIdentifier',array('class'=>'form-control','placeholder'=>'OrderId','label' =>false,'required'=>true,'value'=>$OrderIdentifier)); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>AddressMatch</label>
<?php echo $this->Form->input('address_match',array('class'=>'form-control','placeholder'=>'OrderId','label' =>false,'required'=>true,'value'=>'false','readonly')); ?>
</div>
</div>


<h3> Source </h3>

<div class="col-sm-6">
<div class="form-group">
<label>CardPan</label>
<?php echo $this->Form->input('cardpan',array('class'=>'form-control','placeholder'=>'CardPan','label' =>false,'required'=>true,'value'=>$cardpan)); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>CardCvv</label>
<?php echo $this->Form->input('CardCvv',array('class'=>'form-control','placeholder'=>'CardCvv','label' =>false,'required'=>true,'value'=>$CardCvv)); ?>
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<label>CardExpiration</label>
<?php echo $this->Form->input('CardExpiration',array('class'=>'form-control','placeholder'=>'CardExpiration','label' =>false,'required'=>true,'value'=>$CardExpiration)); ?>
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<label>CardholderName</label>
<?php echo $this->Form->input('CardholderName',array('class'=>'form-control','placeholder'=>'CardholderName','label' =>false,'required'=>true,'value'=>$CardholderName)); ?>
</div>
</div>




<h3> Billing </h3>

<div class="col-sm-6">
<div class="form-group">
<label>FirstName</label>
<?php echo $this->Form->input('firstname',array('class'=>'form-control','placeholder'=>'FirstName','label' =>false,'required'=>true,'value'=>$firstname)); ?>
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<label>LastName</label>
<?php echo $this->Form->input('lastname',array('class'=>'form-control','placeholder'=>'LastName','label' =>false,'required'=>true,'value'=>$lastname)); ?>
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<label>Line1</label>
<?php echo $this->Form->input('line1',array('class'=>'form-control','placeholder'=>'Line1','label' =>false,'required'=>true,'value'=>$line1)); ?>
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<label>Line2</label>
<?php echo $this->Form->input('line2',array('class'=>'form-control','placeholder'=>'Line2','label' =>false,'required'=>true,'value'=>$line2)); ?>
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<label>City</label>
<?php echo $this->Form->input('city',array('class'=>'form-control','placeholder'=>'City','label' =>false,'required'=>true,'value'=>$city)); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>State</label>
<?php echo $this->Form->input('state',array('class'=>'form-control','placeholder'=>'State','label' =>false,'required'=>true,'value'=>$state)); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>PostalCode</label>
<?php echo $this->Form->input('postal_code',array('class'=>'form-control','placeholder'=>'PostalCode','label' =>false,'required'=>true,'value'=>$postal_code)); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>CountryCode</label>
<?php echo $this->Form->input('country_code',array('class'=>'form-control','placeholder'=>'CountryCode','label' =>false,'required'=>true,'value'=>$country_code)); ?>
</div>
</div>



<div class="col-sm-6">
<div class="form-group">
<label>EmailAddress</label>
<?php echo $this->Form->input('email_address',array('class'=>'form-control','placeholder'=>'EmailAddress','label' =>false,'required'=>true,'value'=>$email_address)); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>Phone Number</label>
<?php echo $this->Form->input('phonenumber',array('class'=>'form-control','placeholder'=>'Phone Number','label' =>false,'required'=>true,'value'=>$phonenumber)); ?>
</div>
</div>



<h3> Threedsecure</h3>

<div class="col-sm-6">
<div class="form-group">
<label>ChallengeWindowSize</label>
<?php echo $this->Form->input('challenge_window_size',array('class'=>'form-control','placeholder'=>'MerchantResponseUrl','label' =>false,'required'=>true,'value'=>$challenge_window_size)); ?>
</div>
</div>



<div class="col-sm-6">
<div class="form-group">
<label>ChallengeIndicator</label>
<?php echo $this->Form->input('challenge_indictor',array('class'=>'form-control','placeholder'=>'MerchantResponseUrl','label' =>false,'required'=>true,'value'=>$challenge_indictor)); ?>
</div>
</div>



<div class="col-sm-6">
<div class="form-group">
<label>MerchantResponseUrl</label>
<?php echo $this->Form->input('merchant_response_url',array('class'=>'form-control','placeholder'=>'MerchantResponseUrl','label' =>false,'required'=>true,'value'=>$merchant_response_url)); ?>

</div>
</div>



<div class="col-sm-12">
<div class="form-group">
<button type="submit" class="btn btn-primary"><?php echo  "Submit"; ?></button>
</div>
</div>
<?php echo $this->Form->end(); ?>
</div>
</div>