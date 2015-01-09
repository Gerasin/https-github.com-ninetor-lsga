<?php
    $this->pageTitle = $category->name;
?>
<ul class="breadcrumbs-bl">
    <li>
        <a class="breadcrumbs-link" href="/">Главная</a>
    </li>
    <li>&rarr;</li>
    <li>
        <a class="breadcrumbs-link" href="/category/<?= $category->id ?>"><?= $category->name ?></a>
    </li>
    <li>&rarr;</li>
    <li><?= $page->name ?></li>
</ul>
<div class="page-detail-aside">
    <div class="list-review">
        <?php if ($categoryPages): ?>
            <?php foreach ($categoryPages as $value): ?>
                <a class="list-review-item" href="/category/page/<?php echo $value->id ?>">
                    <span class="list-review-img" style="background-image: url(/upload/images/pages/_temp/<?php echo $value->img ?>)">
                    </span>
                    <span class="list-review-text">
                        <?= $value->name?>
                    </span>
                </a> <!-- end list-review-item -->
            <?php endforeach; ?>
        <?php endif; ?>        
    </div> <!-- end list-review -->
</div>
<div class="page-detail">
    <div class="page-detail-head">
        <h1 class="page-detail-title">
            <?= $page->name ?>
        </h1>
    </div> <!-- end page-detail-head -->
    <div class="page-detail-content">
        <?= $page->full_text ?>
    </div> <!-- end page-detail-content -->

    <?php if (Yii::app()->user->isGuest): ?>  
        <div class="must-registration">
            <p>Для того, чтобы написать комментарий вам нужно <a href="/registration">зарегистрироваться</a> на сайте</p>
        </div>    
    <?php else: ?>
        <div class="detail-sharing" id="detail-sharing">
            <div class="sharing-con">
            </div>
            <div class="rating-con" style="display:none">
                <a class="rating-plus" href="#"><span class="inner"></span></a>
                <div class="rating-text">+289</div>
                <a class="rating-minus" href="#"><span class="inner"></span></a>
            </div>
        </div> <!-- end detail-sharing -->
    <?php endif; ?>     
    <a class="comment-toggle" href="#">Комментарии</a>
    <div class="comment-all" id="comment-all">
        <?php if (!Yii::app()->user->isGuest): ?>  
            <div class="comment-block">
                <form action="#">
                    <input type="hidden" name="id_parent" id="id_parent" value=""/>
                    <textarea class="comment-text" name="text" id="comment" cols="30" rows="10"></textarea>
                    <span class="error-text" id="error-text"></span>
                    <div class="comment-block-bottom">
                        <a class="comment-btn" href="#" onclick="addComment(<?= $page->id ?>); return false;"><span>Опубликовать</span></a>
                        <div class="comment-author">
                            <?php if ($user->img): ?>
                                <div class="comment-author-author" style="background-image: url('/upload/images/users/_temp/<?= $user->img ?>')"></div>
                            <?php else: ?>
                                <div class="comment-author-author" style="background-image: url(/upload/images/users/avatar.png)"></div>                         
                            <?php endif; ?>
                            <div class="comment-author-text">
                                <?= $user->name ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- end comment-block -->
        <?php endif; ?> 
        <!-- end comment-block -->
        <div class="comment-list">          
            <?php if ($comments): ?>
                <?php foreach ($comments as $value): ?>
                    <div class="comment-list-item">
                        <div class="comment-like-bl <?php if(!is_null($value['user_click'])&&$value['user_click']==1):?>select-like<?php elseif(!is_null($value['user_click'])&&$value['user_click']==0):?>select-dislike<?php endif;?>">
                            <a class="comment-dislike" id="comment-dislike-<?= $value['id'] ?>" <?php if(is_null($value['user_click'])):?>onclick="dislikeComment('<?= $value['id'] ?>'); return false;" href="#"<?php endif;?>></a>
                            <div class="comment-rating-value" id="comment-rating-value-<?= $value['id'] ?>">(<?= $value['like'] ?>)</div>
                            <a class="comment-like" id="comment-like-<?= $value['id'] ?>" <?php if(is_null($value['user_click'])):?>href="#" onclick="likeComment('<?= $value['id'] ?>'); return false;"<?php endif;?>></a>
                        </div>
                        <div class="comment-avatar">
                            <?php if ($value['user_img']): ?>
                                <div class="comment-avatar-img" style="background-image: url(/upload/images/users/temp/<?= $value['user_img'] ?>)"></div>
                            <?php else: ?>
                                <div class="comment-avatar-img" style="background-image: url(/upload/images/users/avatar.png)"></div>
                            <?php endif; ?>
                            <div class="comment-avatar-rating">
                                (<?= $value['user_like'] ?>)
                            </div>
                        </div>
                        <div class="comment-text">
                            <div class="comment-text-author">
                                <?= $value['user_name'] ?>
                                <span class="comment-text-time"><?= date('Y-m-d', $value['date']) ?></span>
                            </div>
                            <div class="comment-text-inner">
                                <?= $value['text'] ?>
                            </div>
                        </div> <!-- end comment-text -->
                        <a class="comment-text-link" href="#" onclick="replyComment('<?= $value['id'] ?>', '<?= $value['user_name'] ?>'); return false;">Ответить</a>
                    </div> <!-- end comment-list-item -->
                    <?php if ($value['children']): ?>
                        <?php foreach ($value['children'] as $item): ?>
                            <div class="comment-list-item sub-level">
                                <div class="comment-like-bl <?php if(!is_null($item['user_click'])&&$item['user_click']==1):?>select-like<?php elseif(!is_null($item['user_click'])&&$item['user_click']==0):?>select-dislike<?php endif;?>">
                                    <a class="comment-dislike" id="comment-dislike-<?= $item['id'] ?>" <?php if(is_null($item['user_click'])):?>onclick="dislikeComment('<?= $item['id'] ?>'); return false;" href="#"<?php endif;?>></a>
                                    <div class="comment-rating-value" id="comment-rating-value-<?= $item['id'] ?>">(<?= $item['like'] ?>)</div>
                                    <a class="comment-like" id="comment-like-<?= $item['id'] ?>" <?php if(is_null($item['user_click'])):?>href="#" onclick="likeComment('<?= $item['id'] ?>'); return false;"<?php endif;?>></a>
                                </div>
                                <div class="comment-avatar">
                                    <?php if ($item['user_img']): ?>
                                        <div class="comment-avatar-img" style="background-image: url(/upload/images/users/temp/<?= $item['user_img'] ?>)"></div>
                                    <?php else: ?>
                                        <div class="comment-avatar-img" style="background-image: url(/upload/images/users/avatar.png)"></div>
                                    <?php endif; ?>
                                    <div class="comment-avatar-rating">
                                        (<?= $item['user_like'] ?>)
                                    </div>
                                </div>
                                <div class="comment-text">
                                    <div class="comment-text-author">
                                        <?= $item['user_name'] ?>
                                        <span class="comment-text-time"><?= date('Y-m-d', $item['date']) ?></span>
                                    </div>
                                    <div class="comment-text-inner">
                                        <?= $item['text'] ?>
                                    </div>
                                </div> <!-- end comment-text -->                               
                            </div> <!-- end comment-list-item -->
                            <?php if ($value['children']): ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                Нет комментариев
            <?php endif; ?>
        </div> <!-- end comment-list -->
    </div>
</div>
<script src="/js/comments.js"></script>