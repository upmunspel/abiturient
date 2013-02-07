<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<div class="row">
		<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
		<?php if ($column->name!='Visible') {
                echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n";}
                else {
                echo "<div id='togle_Visible'>
                    <?php echo \$form->checkBox(\$model,'Visible'); ?>
                 </div> 
                    <script type='text/javascript'>
                        $('#togle_Visible').toggleButtons({
                        label: {
                            enabled: 'Так',
                            disabled: 'Ні'
                        }
                    });
                 </script>   \n"; }; ?>
		<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
	</div>

<?php
}
?>
	<div class="row buttons">
		<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Створити' : 'Зберегти'); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->