 <!-- ZNO -->
<?php if (empty($specialityid)){
    $specialityid = 0;
} 
?>
<div class="span7 znosubjects" id="znosubjects">
   <?php $this->renderPartial("_znosubjects", array("model"=>$model,'specialityid'=>$specialityid)); ?>
</div>
<!--Exams -->
<div class="span5 examsujects">
   <?php $this->renderPartial("_examsubjects", array("model"=>$model,'specialityid'=>$specialityid)); ?>
</div>
