<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

class MarkdownClipboardPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPageInitialized' => ['onPageInitialized', 0]
        ];
    }

    public function onPageInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }
        $this->enable([
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ]);
    }

    public function onTwigSiteVariables()
    {
        if ($this->config->get('plugins.markdown-clipboard.built_in_css')) {
            $this->grav['assets']->addCss('plugin://markdown-clipboard/css/clipboard-default.css');
        }
        $this->grav['assets']->addJs('plugin://markdown-clipboard/js/clipboard.min.init.js');
    }
}
