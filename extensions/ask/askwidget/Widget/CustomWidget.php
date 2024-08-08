<?php

namespace askwidget\widget;

use OxidEsales\Eshop\Application\Controller\WidgetController;

class CustomTextImageRow extends WidgetController
{
    public function render() {
        // Inhalte aus dem Backend ziehen
        $rowHeadline = $this->getConfig()->getConfigParam('sRowHeadline');
        $rowDesc = $this->getConfig()->getConfigParam('sRowDesc');
        $sImageURL1 = $this->getConfig()->getConfigParam('sImageURL1');
        $title1 = $this->getConfig()->getConfigParam('sTitle1');
        $desc1 = $this->getConfig()->getConfigParam('sDesc1');
        $buttonText1 = $this->getConfig()->getConfigParam('sButtonText1');

        // Inhalte an das Template übergeben
        $this->addTplParam('rowHeadline', $rowHeadline);
        $this->addTplParam('rowDesc', $rowDesc);
        $this->addTplParam('sImageURL1', $sImageURL1);
        $this->addTplParam('title1', $title1);
        $this->addTplParam('desc1', $desc1);
        $this->addTplParam('buttonText1', $buttonText1);

        return 'visualcms_shortcode_text-image-row.html.twig';
    }
}