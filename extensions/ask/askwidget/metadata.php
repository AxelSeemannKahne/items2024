<?php
$sMetadataVersion = '2.1';

$aModule = [
    'id'           => 'askwidget',
    'title'        => 'ASK Widget Modul',
    'description'  => 'VisualCMS Custom-Widgets für OXID 7.1',
    'version'      => '1.0.0',
    'author'       => 'Axel Seemann-Kahne',
    'extend'       => [],
    'controllers'  => [
        'customtextimagerow' => \askwidget\Widget\CustomTextImageRow::class,
    ],
    'templates'    => [
        'custom_text_image_row.twig' => 'askwidget/views/tpl/visualcms_shortcode_text-image-row.html.twig',
    ],
    'events'       => [],
    'settings'     => [],
];