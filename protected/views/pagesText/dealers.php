<?php
/* @var $this PagesTextController */

$this->breadcrumbs = array(
    'Pages Text',
);
 $this->pageTitle = "Дилерам";
?>
<div class="for-deallers">
    <?= $dealers->full_text ?>
    <form class="col-textumns" id="form_user_message_pages">
        <div>
            <fieldset class="aright">
                <label>Ваша эл. почта</label>
                <input type="text" value="" class="input-simple" name="message[email]"/>
                <span class="error-text"></span>
            </fieldset>
            <fieldset class="aright">
                <label>Ваше имя</label>
                <input type="text" value="" class="input-simple" name="message[name]"/>
                <span class="error-text"></span>
            </fieldset>
        </div><!--
        --><div>
            <fieldset class="aright">
                <label>Текст сообщения</label>
                <textarea class="input-simple" name="message[message]"></textarea>
                <span class="error-text"></span>
            </fieldset>
            <fieldset class="aright">
                <button type="submit" class="btn-simple" onclick="userMessagePages(); return false;">
                    <span>Отправить</span>
                </button>
            </fieldset>
        </div>
    </form>
</div>
<script type="text/javascript" src="/js/pages.js"></script>