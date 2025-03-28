<?php
class ModernUIPlugin extends Plugin {
    var $config_class = 'ModernUIConfig';

    function bootstrap() {
        $cssEnabled = (bool) $this->getConfig()->get('css_enabled');

        if ($cssEnabled && $this->isClientSide()) {
            ob_start(array($this, 'modifyClientPage'));
        }
    }

    function modifyClientPage($buffer) {
        $themeCSS = '<link rel="stylesheet" type="text/css" href="/osticket/assets/modernui/css/theme.css">';
        $themeJS = '<script defer src="/osticket/assets/modernui/js/theme.js"></script>';
        $tailwindCSS = '<script defer src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>';
        $buffer = str_replace('</head>', $themeCSS . $themeJS . $tailwindCSS . '</head>', $buffer);

        return $buffer;
    }

    private function isClientSide() {
        return defined('INCLUDE_DIR') && strpos($_SERVER['REQUEST_URI'], '/scp') === false;
    }
}

class ModernUIConfig extends PluginConfig {
    function getOptions() {
        return array(
            'css_enabled' => new BooleanField(array(
                'label' => 'Enable Custom CSS',
                'default' => true
            ))
        );
    }
}
