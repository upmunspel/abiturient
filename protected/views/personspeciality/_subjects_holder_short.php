 <!-- ZNO -->
<?php if (empty($specialityid)){
    $specialityid = 0;
} 
?>
<!--Exams -->
<div class="span12 examsujects">
   <?php $this->renderPartial("_examsubjectsShort", array("model"=>$model,'specialityid'=>$specialityid)); ?>
</div>
