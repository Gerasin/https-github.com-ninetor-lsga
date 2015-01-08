<?php

class CustomLinkPager extends CLinkPager
{
   const CSS_FIRST_PAGE='first';
   const CSS_LAST_PAGE='left';
   const CSS_PREVIOUS_PAGE='left';
   const CSS_NEXT_PAGE='right';
   const CSS_INTERNAL_PAGE='page';
   const CSS_HIDDEN_PAGE='hidden';
   const CSS_SELECTED_PAGE='active';

    public function init()
    {
        if ($this->nextPageLabel === null)
            $this->nextPageLabel = Yii::t('yii', 'Вперед');
        if ($this->prevPageLabel === null)
            $this->prevPageLabel = Yii::t('yii', 'Назад');
        if ($this->firstPageLabel === null)
            $this->firstPageLabel = Yii::t('yii', '&lt;&lt; First');
        if ($this->lastPageLabel === null)
            $this->lastPageLabel = Yii::t('yii', 'Last &gt;&gt;');
        if ($this->header === null)
            $this->header = Yii::t('yii', 'Go to page: ');

        if (!isset($this->htmlOptions['id']))
            $this->htmlOptions['id'] = $this->getId();
        if (!isset($this->htmlOptions['class']))
            $this->htmlOptions['class'] = 'pagination';
    }

    public function run()
    {
        
        $buttons = $this->createPageButtons();
        if (empty($buttons))
            return;
        echo CHtml::tag('div', $this->htmlOptions, implode("\n", $buttons));
    }

    protected function createPageButtons()
    {
        if (($pageCount = $this->getPageCount()) <= 1)
            return array();

        list($beginPage, $endPage) = $this->getPageRange();
        $currentPage = $this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $buttons = array();

        // first page
        // $buttons[]=$this->createPageButton($this->firstPageLabel,0,$this->firstPageCssClass,$currentPage<=0,false);
        // prev page
        if (($page = $currentPage - 1) < 0)
            $page = 0;
        $buttons[] = $this->createPageButton($this->prevPageLabel, $page, $this->previousPageCssClass, $currentPage <= 0, false);

        // internal pages
        for ($i = $beginPage; $i <= $endPage; ++$i)
            $buttons[] = $this->createPageButton($i + 1, $i, $this->internalPageCssClass, false, $i == $currentPage);

        // next page
        if (($page = $currentPage + 1) >= $pageCount - 1)
            $page = $pageCount - 1;
        $buttons[] = $this->createPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);

        // last page
        // $buttons[]=$this->createPageButton($this->lastPageLabel,$pageCount-1,$this->lastPageCssClass,$currentPage>=$pageCount-1,false);

        return $buttons;
    }
    protected function createPageButton($label, $page, $class, $hidden, $selected)
    {
        if ($hidden || $selected)
            $class.=' ' . ($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);
        return '<span class="' . $class . '">' . CHtml::link($label, $this->createPageUrl($page)) . '</span>';
    }

}