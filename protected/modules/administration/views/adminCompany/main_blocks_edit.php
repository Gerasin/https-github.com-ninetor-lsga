<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Редактирование данных о блоке
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li>
                        <i class="fa"></i><a href="/administration/mainBlocks">Блоки на главной странице</a>
                    </li>
                    <li><i class="fa"></i>Редактирование</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" method="post" id="form_blocks_edit">
                    <li class="list-group-item">Тип блока: </br><input class="input-simple" type="text" style="width: 100%" id="type_block" name="type" readonly value="<?php echo $block->type?>"/></li>
                    <li class="list-group-item">Позиция: </br><input class="input-simple" type="text" style="width: 100%" id="position_block" name="position" readonly value="<?php echo $block->position?>"/></li>

                    <li class="list-group-item">
                    <?php
                    $col_blocks = 0;
                    $count_blocks = count($block->mainPosts);
                    switch($block->type)
                    {
                        case 1 :
                            $col_blocks = 3;
                            break;
                        case 2 :
                            $col_blocks = 5;
                            break;
                        case 3 :
                            $col_blocks = 2;
                            break;
                        case 4 :
                            $col_blocks = 1;
                            break;
                        case 5 :
                            $col_blocks = 4;
                            break;
                        case 6 :
                            $col_blocks = 1;
                            break;
                    }

                    echo'<p>';   if ($count_blocks < $col_blocks)
                    echo '<a href="/administration/mainBlocks/posts/add/'.$block->id.'" class="btn btn-xs btn-primary">Добавить</a> ';
                    echo' В блоке должно быть новостей: '.$col_blocks.'</p>';?>
                    <div class="table-responsive">
                        <?php if ($count_blocks > 0): ?>
                            <table id="table-posts-edit" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Изображение</th>
                                    <th>Текст</th>
                                    <th>Доп. изображения</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($block->mainPosts as $item): ?>
                                    <tr id="<?= $item->id; ?>">
                                        <td>
                                            <?= $item->url ?>
                                        </td>
                                        <td>
                                      <img src="/upload/images/main/<?= $item->photo?>" style="max-width: 100px; max-height: 100px;">
                                        </td>
                                        <td>
                                            <?= $item->name ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (isset($item->additional_photos))
                                            {
                                                $dop_Add = unserialize($item->additional_photos);
                                                foreach ($dop_Add as $picture) {
                                                echo '<img src="/upload/images/main/'.$picture.'" style="max-width: 100px; max-height: 100px;">';
                                                }
                                            }
                                            else
                                            echo 'Отсутствуют';
                                            ?>
                                        </td>
                                        <td>
<!--                                        <a href="/administration/mainBlocks/delete/--><?php // $item->id; ?><!--">удл.</a>-->
                                            <a href="/administration/mainBlocks/posts/edit/<?= $item->id; ?>">ред.</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            Нет данных
                        <?php endif; ?>
                    </div>

                    </li>
                </form>
            </div>
        </div>
    </div>
</div>