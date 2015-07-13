<?php

namespace Pages\Responder;
use App\Responder\AppResponder;

/**
 * Index Responder
 *
 * @package Pages\Responder
 */
class IndexResponder extends AppResponder
{
    public function getMethod()
    {
        $content = '';

        /** @var \Twig_Environment $twig */
        $twig = $this->getContainer()->get('twig');

        if ($this->getRequest()->isAjax()) {
            if ($pages = $this->getData('pages', false)) {
                $content = json_encode(['pages' => $pages]);
            } elseif ($page = $this->getData('page', false)) {
                $content = $twig->render('@Pages/' . $page);
            }
        } else {
            $pages = $this->getData('pages', false);
            $content = $twig->render('@Pages/index.twig', ['pages' => $pages]);
        }

        $this->getResponse()->setContent($content);
    }

    public function postMethod()
    {
        $this->getResponse()->setContent('OK');
    }

    public function putMethod()
    {
        $this->getResponse()->setContent('OK');
    }

    public function deleteMethod()
    {
        $this->getResponse()->setContent('OK');
    }
}
