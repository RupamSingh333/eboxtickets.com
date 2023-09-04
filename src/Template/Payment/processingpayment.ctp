


  
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
                       'action'=>'processingpayment',
                       'enctype' => 'multipart/form-data',
                       'validate' )); ?>

<h3>Transaction Details</h3>

<div class="col-sm-6">
<div class="form-group">
<label>SPI Token</label>
<?php echo $this->Form->input('spi_token',array('class'=>'form-control','placeholder'=>'SPI Token','label' =>false,'required'=>true)); ?>
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