<?php

namespace Pages\Action;
use App\Action\AppAction;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class IndexAction extends AppAction
{
    private $prefix = __DIR__ . '/../Resource/template/pages/';

    public function getMethod($slug = '')
    {
        if ($this->getRequest()->isAjax()) {
            if ($slug) {
                $page = 'pages/' . $slug . '.twig';
                $this->getResponder()->setData('page', $page);

                return;
            }
        }

        $pages = glob($this->prefix . '*.twig');
        foreach ($pages as $i => $page) {
            $pages[$i] = pathinfo($page, PATHINFO_FILENAME);
        }

        $this->getResponder()->setData('pages', $pages);
    }

    public function postMethod($slug)
    {
        file_put_contents($this->prefix . $slug . '.twig', $this->getRequest()->getPost('body'));
    }

    public function putMethod($slug)
    {
        file_put_contents($this->prefix . $slug . '.twig', $this->getRequest()->getPost('body'));
    }

    public function deleteMethod($slug)
    {
        unlink($this->prefix . $slug . '.twig');
    }
}
