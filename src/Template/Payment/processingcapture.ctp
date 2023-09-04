


  
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
                       'action'=>'processingcapture',
                       'enctype' => 'multipart/form-data',
                       'validate' )); ?>

<h3>Transaction Details</h3>

<div class="col-sm-6">
<div class="form-group">
<label>Transaction identifier</label>
<?php echo $this->Form->input('transaction_identifier',array('class'=>'form-control','placeholder'=>'Transaction identifier','label' =>false,'required'=>true,)); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>TotalAmount</label>
<?php echo $this->Form->input('total_amount',array('class'=>'form-control','placeholder'=>'TotalAmount','label' =>false,'required'=>true,'value'=>$total_amount,'readonly')); ?>
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<label>ExternalIdentifier</label>
<?php echo $this->Form->input('external_identifier',array('class'=>'form-control','placeholder'=>'ExternalIdentifier','label' =>false,'required'=>true,'value'=>'null')); ?>
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