<?php defined('INST_INSTALLER_PATH') || exit('No direct script access allowed');

/**
 *
 * @package    EasyAds
 * @author     CodinBit <contact@codinbit.com>
 * @link       https://store.codinbit.com
 * @copyright  2017 EasyAds (https://store.codinbit.com)
 * @license    https://www.codinbit.com
 * @since      1.0
 */
 
?>

<?php if(empty($result['summary']['errors']) && empty($result['summary']['warnings'])) { ?>
<div class="alert alert-success alert-block">
    Congratulations! Your server configuration satisfies all requirements.
</div>
<?php } elseif(!empty($result['summary']['warnings'])) { ?>
<div class="alert alert-warning alert-block">
    Your server configuration satisfies the minimum requirements.<br />
    Please pay attention to the warnings listed below if your application will use the corresponding features.<br />
    <b><u>Contact your hosting company if you want to install or update any component from below on your server!</u></b>
</div>
<?php } else { ?>
<div class="alert alert-danger alert-block">
    Unfortunately your server configuration does not satisfy the minimum requirements.<br />
    <b><u>Contact your hosting company if you want to install or update any component from below on your server!</u></b>
</div>
<?php } ?>

<form method="post">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Requirements</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Result</th>
                        <th>Required by</th>
                        <th>Memo</th>
                    </tr>
                    <?php foreach($result['requirements'] as $requirement): ?>
                    <tr>
                        <td><?php echo $requirement['name']; ?></td>
                        <td class="<?php echo $requirement['condition'] ? 'success' : ($requirement['error'] ? 'danger' : 'warning'); ?>">
                        <?php echo $requirement['condition'] ? 'Passed' : ($requirement['error'] ? 'Failed' : 'Warning'); ?>
                        </td>
                        <td><?php echo $requirement['by']; ?></td>
                        <td><?php echo $requirement['memo']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="clearfix"><!-- --></div>      
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <button class="btn btn-primary btn-flat" value="<?php echo empty($result['summary']['errors']) ? 1 : 0; ?>" name="result"><?php if (empty($result['summary']['errors'])) { ?> Next <?php } else { ?> Check again <?php }?></button>
            </div>
            <div class="clearfix"><!-- --></div>        
        </div>
    </div>
</form>