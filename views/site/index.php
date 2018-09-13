<?php

/* @var $this yii\web\View */
use edofre\sliderpro\SliderPro;
use edofre\sliderpro\models\Slide;
use edofre\sliderpro\models\slides\Caption;
use edofre\sliderpro\models\slides\Image;
use edofre\sliderpro\models\slides\Layer;

$this->title = 'АИС Страховой компании';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>

        <p class="lead">АИС Страховой компании</p>
    </div>

    <div class="body-content">

        <div class="row">
            <?
            $slides = [];
            foreach ($types as $item) {
                $slides[] = new Slide([
                        'items' => [
                           new Caption(['tag' => 'p', 'content' => $item->name. '-' . $item->price . '(₽.)']),
                           new Layer(['tag' => 'p', 'content' => $item->description,
                                    'htmlOptions' => [
                                            'class' => 'sp-white sp-padding',
                                            'data-width' => "600",
                                            'data-horizontal' => "center",
                                            'data-vertical' => "10%",
                                            'data-show-transition' => "down",
                                            'data-hide-transition' => "up",
                                            'text-align' => 'center',]]),
                        ]
                ]);
                }
            ?>
            <?= SliderPro::widget([
                'id'            => 'my-slider',
                'slides'        => $slides,
                'thumbnails'    => null,
                'sliderOptions' => [
                    'width'  => 600,
                    'height' => 200,
                    'arrows' => true,
                ],
            ]);
            ?>
        </div>

    </div>
</div>
