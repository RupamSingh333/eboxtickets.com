 <section class="content">
      <div class="row">
        <div class="col-xs-12">    
          <div class="box">
            <div class="box-header">
              <?php echo $this->Flash->render(); ?>
            </div><!-- /.box-header -->
            <div class="box-body">   
         <table class="table table-bordered">
      <tr>
        <th>Venue</th>
         <td><?php if(isset($venue_detail['location'])){ echo ucfirst($venue_detail['location']);}else{ echo 'N/A'; } ?></td>
      </tr>
  </table>
    </div>
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->  
</div>
<!-- /.row -->      
</section>
<!-- /.content -->  

  
    




  



