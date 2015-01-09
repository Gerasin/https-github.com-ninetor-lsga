<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                Добавление нового блока на главную страницу
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li>
                        <i class="fa"></i><a href="/administration/mainBlocks">Блоки на главной странице</a>
                    </li>
                    <li><i class="fa"></i>Добавление</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" method="post" id="form_blocks_edit">
                    <li class="list-group-item">Тип блока:
                        <select class="form-control" name="type" id="type_block_add">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                    </select>
                        <img src="/images/main_blocks/1.png" style="max-width: 450px; max-height: 100px;" id="imageAddBlock">
                    </li>
                    <li class="list-group-item">Позиция: </br><input class="input-simple" type="text" style="width: 100%" id="position_block" name="position" readonly value="<?php echo $position?>"/></li>
                    <button type="submit" class="form-personal-submit"  id="form-blocks-add-submit">Создать</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#type_block_add').change(function () {
        $('#imageAddBlock').attr('src','/images/main_blocks/'+$('#type_block_add').val()+'.png');
    });
</script>