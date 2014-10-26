<?php

/**
 * TPCMS Main language class
 */
class Language extends Database {

    private $language;
    private $default;

    public function __construct() {
        parent::__construct();

        $this->language = $this->get_language();  // Get current language
        $this->default = $this->get_default();  // Fall-back
    }

    /**
     * Get current language file
     * @return array
     */
    private function get_language() {
        $tmp = 'default';
        $file = ADMINPATH . 'languages/' . $tmp . '/language.php';
        if (file_exists($file)) {
            require_once $file;
            return $language;
        }
    }

    /**
     * Get language text
     * @param  string $key
     * @return string 
     */
    public function filter($key) {
        if (is_array($this->language) && array_key_exists($key, $this->language)) {
            return $this->language[$key];
        } else {
            // Fall-back
            return $this->default[$key];
        }
    }

    /**
     * Language writeing direction
     * @return string used in <body> as a class
     */
    public function type() {
        return $this->info('type');
    }

    /**
     * Lenguage details and meta
     * @param  string $key
     * @return string
     */
    public function info($key) {
        if (is_array($this->language['info']) && array_key_exists($key, $this->language['info'])) {
            return $this->language['info'][$key];
        } else {
            return $this->default['info'][$key];
        }
    }

    /**
     * Fall-back language select
     * @return array 
     */
    private function get_default() {
        $included_files = get_included_files();
        foreach ($included_files as $included_file) {
            if (strpos($included_file, 'languages\default\language.php')) {
                return false;
            }
        }
        $file = ADMINPATH . 'languages/default/language.php';
        require_once $file;
        return $language;
    }
}
