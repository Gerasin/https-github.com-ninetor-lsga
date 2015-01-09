<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/administration">Главная</a>
                    </li>
               </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
               <?php echo CHtml::form('', 'post', array('enctype' => 'multipart/form-data')); ?>
                <?php echo CHtml::errorSummary($form); ?>
                
                    <div class="form-group">
                        <label>Название</label>
                        <?php echo CHtml::activeTextField($form, 'title') ?>
                    </div>
                    <div class="form-group">
                        <label>Раздел</label>
                        <?php echo CHtml::activeTelField($form, 'section') ?>
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <?php echo CHtml::activeTextArea($form, 'description') ?>
                    </div>
                    <div class="form-group">
                        <label>Изображение</label>
                        <?php echo CHtml::activeFileField($form, 'image') ?>
                    </div>
                
                
                <?php echo CHtml::submitButton('Сохранить', array('class'=> 'btn btn-xs btn-success')); ?>
                <?php echo CHtml::endForm(); ?>
            </div>
        </div>
     </div>
</div>
