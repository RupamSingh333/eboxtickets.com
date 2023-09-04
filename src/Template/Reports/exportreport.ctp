<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<!-- <script src="https://code.jquery.com/jquery-2.1.4.js"></script> -->
<!-- <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script> -->


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<section id="Dashboard_section">
    <div class="row g-0">
        <?php echo $this->element('organizerdashboard'); ?>

        <div class="col-sm-9">
        <div class="dsa_contant">
                <div class="d-flex justify-content-between align-items-center">
                <h4>Ticket Reports</h4>
                <a class="export_Report" href="<?php echo SITE_URL; ?>reports/exportreport/<?php echo $id; ?>"><i class="bi bi-file-earmark-excel"></i></a>
                </div>
                <hr>
                <div class="contant_bg">
                    <div class="event_settings">

<?php echo $this->Form->create('', array('url' => array('controller' => 'reports', 'action' => 'exportreport/'.$id),'class' => 'row g-3','id' => '','enctype' => 'multipart/form-data','validate','autocomplete' => 'off')); ?>


                            <div class="col-md-4"> 
                                <input type= "hidden" name="id" value = "<?php echo $id; ?>">                               
                                <input type="text" class="form-control" id="inputEmail4" name="title" placeholder="Title">
                            </div>
                        
                            <div class="col-4">
                                <button type="submit" class="btn save">Submit</button>
                            </div>
                        </form>


                    </div>
                </div>




         


            </div>
        </div>
    </div>
</section>
<style>