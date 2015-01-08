<?php
$this->pageTitle = "ЛСГА";
?>
<div class="header-inner-big">
    <?php if (!is_null($homeProblem)): ?>
    <div class="poll-bl">
        <div class="poll-bl-bg"></div>
        <div class="poll-bl-bg-inner"></div>
        <form class="poll-bl-inner" id="poll_bl_inner" action="#" onsubmit="return false;">
            <h3 class="poll-title">
                <?php echo $homeProblem->text; ?>
            </h3>
            <div class="poll-variants">
                <div class="poll-variant-col">
                    <?php foreach ($homeAns as $value): ?>
                        <label class="poll-variant-item" >
                            <span class="poll-variant-item-radio"></span>
                            <input type="checkbox" name="poll[<?= $value->id; ?>]" value="<?= $value->id; ?>"/>
                            <span class="poll-variant-text"><?= $value->text; ?></span>
                        </label>
                    <?php endforeach; ?>
                </div> <!-- end poll-variant-item -->

            </div> <!-- end poll-varians -->
            <div class="acenter">
                <button type="submit" class="poll-btn" onclick="homeProblem(); return false;"><span>Проголосовать</span></button>
            </div>
        </form> <!-- end poll-bl-inner -->
    </div>
    <?php endif; ?>
    <div class="header-content">
        <h1 class="header-content-title">
            Что такое LSGA?
        </h1>

        <div class="header-content-text">
            <div class="col-text">
                Двукратный чемпион мира назначен тест-пилотом команды Volkswagen в WRC. 46-летний финн поможет немецкому коллективу в развитии заводской машины Polo R, которая проводит второй сезон в мировом первенстве.
            </div>

            <div class="col-text">
                Чемпион мира по ралли Маркус Гронхольм назначен тест-пилотом команды Volkswagen в WRC. 46-летний финн поможет немецкому коллективу в развитии заводской машины Polo R, которая проводит второй сезон в первенстве.
            </div>
        </div>
    </div> <!-- end header content -->

    <a id="main_block_main" href=" <?=$main_block_main->mainPosts[0]->url?>" class="main-news-bl" style="background-image: url(upload/images/main/<?=$main_block_main->mainPosts[0]->photo?>);">
        <span class="main-news-inner">
            <span class="main-news-inner-text">
           <?=$main_block_main->mainPosts[0]->name?>
            </span>
        </span>
    </a> <!-- end main-news-bl -->
</div> </header>

<div class="wrapper">
    <div class="content">
    </div>
    <div id="mainLoader"><img src="/images/loader.gif"></div>
</div>

<script>
    $(document).scroll(function() {
        if (this.body.scrollTop>(this.body.scrollHeight-screen.height+50))
        {
            var position = $('.mainBlocks:last').attr("id");
            getBlocks(position);
        }
    });

    $(document).ready(function(){
        getBlocks(<?=++$blocks_pos?>);
    });
    var timeout = null;

    function getBlocks(position)
    {
        if (position!=null && position>0){
            $('#mainLoader').show();
            clearTimeout(timeout);
            timeout = null;
            console.log(position);
            timeout = setTimeout(function(){
                $.ajax({
                    data: {"position":position},
                    dataType: 'json',
                    type: 'POST',
                    url: '/main/loadBlocks',
                    success: function (data) {
                        if (data.success == 1) {
                            console.log(data);
                            $('#mainLoader').hide();
                            $(".content").append(data.blocks);
                        }
                        else {

                        }
                    },
                    error: function() {
                        $('#mainLoader').hide();
                    }
                });
            }, 1000);
        }
    }
</script>