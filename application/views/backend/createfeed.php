<div id="page-title">
    <a href="<?php echo site_url("site/viewfeed"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">feed Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create feed </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createfeedsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Title</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="title" value='<?php echo set_value(' title ');?>'>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="description" id="" cols="20" rows="10" class="form-control tinymce"><?php echo set_value( 'description');?></textarea>
                                </div>
                            </div>
                            <div class=" form-group">
                              <label class="col-sm-2 control-label">Interests</label>
                              <div class="col-sm-4">
                                <?php

                                    echo form_dropdown('interest[]',$interest,set_value('interest'),'id="select2" class="chzn-select form-control" 	data-placeholder="Choose a Interest..." multiple');
                                ?>
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url("site/viewfeed"); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
