<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
  <?php echo $this->Html->meta(array('name' => 'author', 'content' => 'Samy Younsi','lang' => 'en')); ?>
  <?php echo $this->Html->meta(array('name' => 'description', 'content' => 'ParserXML.','lang' => 'en')); ?>
  <?php echo $this->Html->meta(array('name' => 'keywords', 'content' => 'parser,xml', 'lang' => 'en')); ?>
  <title>Parser Xml</title>
  <?php
  echo $this->Html->meta(
    'favicon.jpg',
    '/favicon.jpg',
    array('type' => 'icon')
    );

  echo $this->html->css('bootstrap');
  
  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');
  ?>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">App XMLParser</a>
            </div>
            
        </div>
    </nav>

    <div class="container">
       <header class="jumbotron hero-spacer">

        <?php echo $this->Form->create('Uploadxml', array('action' => 'add','type' => 'file')); ?>
        <fieldset>
            <?php
            echo $this->Form->input('xml_file', array('label' => 'Choose your xml file', 'type' =>'file'));
            ?>
        </fieldset>
        <?php 
        echo $this->Form->Submit('Upload',array('class' => 'btn btn-info btn-lg '));
        echo $this->Form->end(); ?> 
    </p>
</header>

<hr>

</div>

<div id="content">

   <?php echo $this->Session->flash(); ?>
   <?php echo $this->fetch('content'); ?>
 
</div>
<?php 	echo $this->html->script(array('jquery-1.10.2','bootstrap.min','script.js')); ; ?>

</body>
</html>
