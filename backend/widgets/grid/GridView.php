<?php

namespace backend\widgets\grid;

use yii\helpers\Html;

class GridView extends \yii\grid\GridView
{
    /**
     * @inheritdoc
     */
    public $dataColumnClass = 'backend\widgets\grid\DataColumn';

    /**
     * @inheritdoc
     */
    public $tableOptions = ['class' => 'table dataTable'];

    /**
     * @var bool whether to border grid cells
     */
    public $bordered = true;

    /**
     * @var bool whether to condense the grid
     */
    public $condensed = false;

    /**
     * @var bool whether to stripe the grid
     */
    public $striped = true;

    /**
     * @var bool whether to add a hover for grid rows
     */
    public $hover = false;

    public $filters_html = '';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->bordered) {
            Html::addCssClass($this->tableOptions, 'table-bordered');
        }
        if ($this->condensed) {
            Html::addCssClass($this->tableOptions, 'table-condensed');
        }
        if ($this->striped) {
            Html::addCssClass($this->tableOptions, 'table-striped');
        }
        if ($this->hover) {
            Html::addCssClass($this->tableOptions, 'table-hover');
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        GridViewAsset::register($this->view);
        parent::run();
    }

    /**
     * @inheritdoc
     */
    public function renderPager()
    {
        return Html::tag('div', parent::renderPager(), ['class' => 'dataTables_paginate paging_simple_numbers']);
    }

    public function renderFilters()
    {
        if ($this->filters_html) {
            $yourRows = '<tr class="operate-head"><td colspan="1">' . $this->filters_html . '<td></tr>';
            return parent::renderFilters() . $yourRows;
        }
    }

    public static function OperationsMenu($links = array())
    {
        if (!empty($links)) {
            $html = '<div class="operations_menu"><span class="operations_menu__btn"><em class="operations_menu__name"><i class="operations_menu__icon fa fa-cog"></i>Операции<i class="operations_menu__arrow"></i></em><ul class="operations_menu__list">';

            foreach ($links as $link) {
                $url = $link['url'];
                $label = $link['label'];

                $html .= '<li class="operations_menu__item"><a href="' . $url . '" class="operations_menu__link">' . $label . '</a></li>';
            }

            $html .= '</ul></span></div>';

            return $html;
        }

        return null;
    }
}
