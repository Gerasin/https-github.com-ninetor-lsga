
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   Блоки на главной странице
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i>  <a href="/administration">Главная</a>
                    </li>

                    <li class="active">
                        <i class="fa"></i> Блоки на главной странице
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">

            <h3>Главный блок</h3>
            <div class="table-responsive">
                    <table id="table-mainBlockMain" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Тип блока (номер - внешний вид)</th>
                            <th>Приоритет позиции</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($blocks as $item){
                            if ($item->position==0){
                                ?>
                                <tr id="<?= $item->id; ?>">
                                    <td style="width: 500px;">
                                        <?= $item->type ?> - <img src="/images/main_blocks/<?= $item->type?>.png" style="max-width: 450px; max-height: 100px;">
                                    </td>
                                    <td>
                                        В начале страницы
                                    </td>
                                    <td>
                                        <a href="/administration/mainBlocks/edit/<?= $item->id; ?>">ред.</a>
                                    </td>
                                </tr>
                            <?php break;}} ?>
                        </tbody>
                    </table>
            </div>
            <div class="col-lg-12">
                <h3>Блоки</h3>
                <p><a href="/administration/mainBlocks/add" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <?php if (count($blocks) > 1): ?>
                        <table id="table-mainBlocks" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Тип блока (номер - внешний вид)</th>
                                <th>Приоритет позиции</th>
                                <th>Тексты постов в блоке</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($blocks as $item):
                                $count_posts = 0;
                                switch ($item->type)
                                {
                                    case 1 :
                                        $count_posts = 3;
                                        break;
                                    case 2 :
                                        $count_posts = 5;
                                        break;
                                    case 3 :
                                        $count_posts = 2;
                                        break;
                                    case 4:
                                    case 6:
                                        $count_posts = 1;
                                        break;
                                    case 5 :
                                        $count_posts = 4;
                                        break;
                                }
                                if ($item->position!=0):
                                ?>
                                <tr id="<?= $item->id; ?>" <?php if (count($item->mainPosts) != $count_posts) echo'style="background-color: #ac2925"'; ?> >
                                    <td style="width: 500px;">
                                    <?= $item->type ?> - <img src="/images/main_blocks/<?= $item->type?>" style="max-width: 450px; max-height: 100px;">
                                    </td>
                                    <td>
                                        <?= $item->position ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($item->mainPosts as $post) {
                                            echo $post->name.'<br>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="/administration/mainBlocks/delete/<?= $item->id; ?>">удл.</a>
                                        <a href="/administration/mainBlocks/edit/<?= $item->id; ?>">ред.</a>
                                    </td>
                                </tr>
                            <?php endif; endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        Нет данных
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
