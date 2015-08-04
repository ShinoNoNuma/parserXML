<div class="container">
<div class="row clearfix">
    <div class="col-md-12 column">
        <div class="row">
            <?php foreach ($uploadxmls as $uploadxml): ?>
            <div class="col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>
                            <?php echo h($uploadxml['Uploadxml']['xml']) ;?>
                        </h3>
                        
                        <p>
                            <a data-id="<?php echo h($uploadxml['Uploadxml']['id']) ;?>" data-path="<?php echo $this->Html->url(array(
              "controller" => "parsefiles",
              "action" => "parsexmlfile"));?>" class='btn btn-primary btn-large'>Parse XML File</a>
                            <?php echo $this->Form->create('Uploadxml', array('action' => 'edit/'.$uploadxml['Uploadxml']['id'].'','type' => 'file')); ?>
                            <fieldset>
                                <?php
                                echo $this->Form->input('id');
                                echo $this->Form->input('xml_file', array('label' => 'Edit your xml file', 'type' =>'file'));
                                ?>
                            </fieldset>
                            <?php 
                            echo $this->Form->Submit('Edit upload',array('class' => 'btn btn-warning '));
                            echo $this->Form->end(); ?> 
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
    </div>
</div>
<div id="resultxml">
	
</div>
</div>


</div>