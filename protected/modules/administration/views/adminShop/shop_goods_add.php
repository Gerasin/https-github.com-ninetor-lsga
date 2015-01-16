<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление нового товара
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li>
                        <i class="fa"></i><a href="/administration/shopGoods">Товары</a>
                    </li>
                    <li><i class="fa"></i>Добавление</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" method="post" id="form_goods_add" onsubmit="return false;">

                    <li class="list-group-item">Название: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="name" name="goods[name]"
                               value=""/>
                    </li>
                    <li class="list-group-item">Код товара: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="code" name="goods[code]"
                               value=""/>
                    </li>


                    <li class="list-group-item">Категория:
                        <select class="form-control" name="goods[category]" id="category">
                            <?php
                            foreach ($categories as $category) {
                                echo "<option value='$category->id'>$category->name</option>";
                            }
                            ?>
                        </select>
                    </li>

                    <li class="list-group-item">Кол-во на складе: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="warehouse_count" name="goods[warehouse_count]" value=""/>
                        <span id="errmsgcount" style="color: #ac2925"></span>
                    </li>
                    <li class="list-group-item">Сообщение при отсутствии на складе: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="empty_warehouse_message" name="goods[empty_warehouse_message]" value=""/>
                    </li>
                    <li class="list-group-item">Стоимость, руб.: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="price" name="goods[price]" value="0"/>
                        <span id="errmsgprice" style="color: #ac2925"></span>
                    </li>
                    <li class="list-group-item">Скидка, %: </br>
                        <input class="input-simple" type="text" style="width: 100%" id="discount" name="goods[discount]" value="0"/>
                        <span id="errmsgdsc" style="color: #ac2925"></span>
                    </li>
                    <li class="list-group-item">Изображение:
                        <input id="fileToUploadmain" type="file" size="45" name="fileToUpload" class="input">
                    </li>
                    <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                    <div class="success-edit-user">Данные сохранены</div>
                    <button type="submit" class="form-personal-submit" onclick="formgoodsaddsubmit()" id="form-goods-add-submit">Создать</button>
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