        <?php
        foreach ($blocks as $block) {
            $count_posts = 0;
            switch ($block->type)
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

            switch ($block->type) {
                case 1:
                    if (count($block->mainPosts)==$count_posts){
                        echo '<div class="list-three-images mainBlocks" id="'.$block->position.'">';
                        $i=0;
                        foreach ($block->mainPosts as $post) {
                            if ($i<3)
                                echo ' <a href="'.$post->url.'" class="list-three-item">
                                            <span class="list-three-img" style="background-image: url(upload/images/main/'.$post->photo.')"></span>
                                            <span class="list-three-text">'.$post->name.'</span>
                                            </a>';
                            $i++;
                        }
                        echo '</div>';
                    }
                    break;
                case 2:
                    if (count($block->mainPosts)==$count_posts){
                        echo '<div class="list-five-images mainBlocks"  id="'.$block->position.'">';
                        $i=0;
                        foreach ($block->mainPosts as $post) {
                            if ($i<5)
                                echo ' <a href="'.$post->url.'" class="list-five-item">
                                            <span class="list-five-item-overlay"></span>
                                            <span class="list-five-item-img" style="background-image: url(upload/images/main/'.$post->photo.')"></span>
                                            <span class="list-five-item-text">'.$post->name.'</span>
                                            </a>';
                            $i++;
                        }
                        echo '</div>';
                    }
                    break;
                case 3:
                    if (count($block->mainPosts)==$count_posts){
                        echo '<div class="list-two-images mainBlocks"  id="'.$block->position.'">';
                        $i=0;
                        foreach ($block->mainPosts as $post) {
                            if ($i<2)
                                echo ' <a href="'.$post->url.'" class="list-two-item" style="background-image: url(upload/images/main/'.$post->photo.')">
                                            <span class="list-two-item-img" >
                                            <span class="list-two-item-text">'.$post->name.'</span>
                                            </span>
                                            </a>';
                            $i++;
                        }
                        echo '</div>';
                    }
                    break;
                case 4:
                    if (count($block->mainPosts)==$count_posts) {
                        echo '<div class="simple-slider mainBlocks"  id="'.$block->position.'">';
                        foreach ($block->mainPosts as $post) {
                            echo ' <a href="' . $post->url . '" class="slider-content">
                                             <div class="slider-content-img" style="background-image: url(upload/images/main/' . $post->photo . ')"></div>

                                                <div class="slider-content-text">
                                                     <h3>' . $post->name . '</h3>
                                                </div>
                                            </a>';
                            if (isset($post->additional_photos))
                            {
                                $dop_Add = unserialize($post->additional_photos);
                                echo ' <div class="slider-list-img mainBlocks"  id="'.$block->position.'">
                <div class="slider-list-img-inner">
                    <a href="upload/images/main/'.$dop_Add[0].'" class="slider-list-item-img" style="background-image: url(upload/images/main/'.$dop_Add[0].')"></a>
                    <a href="upload/images/main/'.$dop_Add[1].'" class="slider-list-item-img" style="background-image: url(upload/images/main/'.$dop_Add[1].')"></a>
                    <a href="upload/images/main/'.$dop_Add[2].'" class="slider-list-item-img" style="background-image: url(upload/images/main/'.$dop_Add[2].')"></a>
                    <a href="upload/images/main/'.$dop_Add[3].'" class="slider-list-item-img" style="background-image: url(upload/images/main/'.$dop_Add[3].')"></a>
                    <a href="upload/images/main/'.$dop_Add[4].'" class="slider-list-item-img" style="background-image: url(upload/images/main/'.$dop_Add[4].')"></a>
                  </div>
               </div>';
                            }
                            break;
                        }
                        echo '</div>';
                    }

                    break;
                case 5:
                    if (count($block->mainPosts)==$count_posts){
                        echo '<div class="list-four-images mainBlocks"  id="'.$block->position.'">';
                        $i=0;
                        foreach ($block->mainPosts as $post) {
                            if ($i<4)
                                echo ' <a href="'.$post->url.'" class="list-four-item">
                                            <span class="list-four-img" style="background-image: url(upload/images/main/'.$post->photo.')"></span>
                                            <span class="list-four-text">'.$post->name.'</span>
                                            </a>';
                            $i++;
                        }
                        echo '</div>';
                    }
                    break;
                case 6:
                    if (count($block->mainPosts)==$count_posts){
                        foreach ($block->mainPosts as $post) {
                            echo '<div class="mainBlocks"  id="'.$block->position.'"> <a href="'.$post->url.'" class="main-news-bl" style="background-image: url(upload/images/main/'.$post->photo.')">
                                             <span class="main-news-inner">
                                              <span class="main-news-inner-text">
                                   '.$post->name.'
                                    </span>
                                </span>
                                            </a></div>';
                            break;
                        }
                    }
                    break;
                default:
                    return;
            };
        }

        ?>
