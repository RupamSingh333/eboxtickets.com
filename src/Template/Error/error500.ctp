<!-- <script>
    function goBack() {
        window.history.back();
    }
</script>

<section class="not_found_404">
    <img class="error_404" src="<?php //echo SITE_URL; ?>/images/404.png" alt="">
    <h2>Oops! This Page Could Not Be Found</h2>
    <p class="error_p">Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily
        unavailable <br> <button class="go_back_btn" onclick="goBack()">Go Back</button></p>
</section>


<link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Titillium+Web:700,900" rel="stylesheet">
 Custom stlylesheet -->
<!-- <link type="text/css" rel="stylesheet" href="<?php //echo SITE_URL; ?>css/errorsstyle.css" /> --> 

<?php
if($message=='Expired token'){
    $response['success']=false;
    $response['isAuthTokenExpired']=true;
    echo json_encode($response); die;
    }
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?php if ($error instanceof Error) : ?>
        <strong>Error in: </strong>
        <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
<?php endif; ?>
<?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')) :
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<h2><?= __d('cake', 'An Internal Error Has Occurred') ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= h($message) ?>
</p>
