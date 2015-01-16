<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Редактирование товара
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li>
                        <i class="fa"></i><a href="/administration/shopGoods">Товары</a>
                    </li>
                    <li><i class="fa"></i>Редактирование</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" method="post" id="form_goods_edit" onsubmit="return false;">
                    <li class="list-group-item">Название: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="name" name="goods[name]"
                               value="<?=$goods->name?>"/>
                    </li>
                    <li class="list-group-item">Код товара: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="code" name="goods[code]"
                               value="<?=$goods->code?>"/>
                    </li>


                    <li class="list-group-item">Категория:
                        <select class="form-control" name="goods[category]" id="category">
                            <?php
                            foreach ($categories as $category) {
                                if ($category->id==$goods->shop_category_id)
                               echo "<option value='$category->id' selected>$category->name</option>";
                                    else
                                echo "<option value='$category->id'>$category->name</option>";
                            }
                            ?>
                        </select>
                    </li>

                    <li class="list-group-item">Кол-во на складе: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="warehouse_count" name="goods[warehouse_count]" value="<?=$goods->warehouse_count?>"/>
                        <span id="errmsgcount" style="color: #ac2925"></span>
                    </li>
                    <li class="list-group-item">Сообщение при отсутствии на складе: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="empty_warehouse_message" name="goods[empty_warehouse_message]" value="<?=$goods->empty_warehouse_message?>"/>
                    </li>
                    <li class="list-group-item">Стоимость, руб.: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="price" name="goods[price]" value="<?=$goods->price?>"/>
                        <span id="errmsgprice" style="color: #ac2925"></span>
                    </li>
                    <li class="list-group-item">Скидка, %: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="discount" name="goods[discount]" value="<?=$goods->discount?>"/>
                        <span id="errmsgdsc" style="color: #ac2925"></span>
                    </li>
                    <li class="list-group-item">Изображение:
                        <input id="fileToUploadmain" type="file" size="45" name="fileToUpload" class="input">
                        <?php if (isset($goods->picture))
                            echo '<img src="/upload/images/tovars/'.$goods->picture.'"/>';?>
                    </li>
                    <li class="list-group-item"><p>Свойства:</p>
                        <?php
                        echo '<a href="/administration/shopGoods/'.$goods->id.'/addProperty" class="btn btn-xs btn-primary">Добавить</a>';
                        if (count($goods->shopGoodsProperties)){?>
                        <div class="table-responsive">
                            <table id="table-shop-properties" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Свойство</th>
                                    <th>Содержание</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($goods->shopGoodsProperties as $item): ?>
                                    <tr id="<?= $item->id; ?>">
                                        <td>
                                            <?= $item->title; ?>
                                        </td>
                                        <td>
                                            <?= $item->text; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/shopGoods/<?=$goods->id?>/editProperty/<?= $item->id; ?>">ред.</a>
                                        </td>
                                        <td>
                                            <a href="/administration/shopGoods/<?=$goods->id?>/deleteProperty/<?= $item->id; ?>">удл.</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </li>
                    <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                    <div class="success-edit-user">Данные сохранены</div>
                    <button type="submit" class="form-personal-submit" onclick="formgoodseditsubmit(<?=$goods->id?>)" id="form-goods-add-submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //called when key is pressed in textbox
        $("#warehouse_count").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#errmsgcount").html("Только цифры").show().fadeOut("slow");
                return false;
            }
        });
        $("#price").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#errmsgprice").html("Только цифры").show().fadeOut("slow");
                return false;
            }
        });
        $("#discount").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#errmsgdsc").html("Только цифры").show().fadeOut("slow");
                return false;
            }
        });
    });

</script>