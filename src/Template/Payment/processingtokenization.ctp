


  
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
                       'action'=>'processingtokenization',
                       'enctype' => 'multipart/form-data',
                       'validate' )); ?>

<h3>Transaction Details</h3>

<div class="col-sm-6">
<div class="form-group">
<label>Tokenize</label>
<?php echo $this->Form->input('Tokenize',array('class'=>'form-control','placeholder'=>'Tokenize','label' =>false,'required'=>true,'value'=>'true','readonly')); ?>
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
<label>ExternalIdentifier</label>
<?php echo $this->Form->input('external_identifier',array('class'=>'form-control','placeholder'=>'ExternalIdentifier','label' =>false)); ?>
</div>
</div>
  


<div class="col-sm-6">
<div class="form-group">
<label>OrderIdentifier</label>
<?php echo $this->Form->input('order_identifier',array('class'=>'form-control','placeholder'=>'OrderIdentifier','label' =>false)); ?>
</div>
</div>
  


<h3> Source </h3>


<div class="col-sm-6">
<div class="form-group">
<label>CardPresent</label>
<?php echo $this->Form->input('cardpresent',array('class'=>'form-control','placeholder'=>'CardPresent','label' =>false,'required'=>true,'value'=>'false','readonly')); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>Debit</label>
<?php echo $this->Form->input('debit',array('class'=>'form-control','placeholder'=>'Debit','label' =>false,'required'=>true,'value'=>'false','readonly')); ?>
</div>
</div>

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



   

<div class="col-sm-12">
<div class="form-group">
<button type="submit" class="btn btn-primary"><?php echo  "Submit"; ?></button>
</div>
</div>
<?php echo $this->Form->end(); ?>
</div>
</div>