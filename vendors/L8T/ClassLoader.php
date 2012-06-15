<?php

namespace L8T;

/**
 * ClassLoader implementation. Autoload classes using the SPL autoloader
 *
 * @author rwngallego
 */
class ClassLoader {

    private $fileExtension = '.php';
    private $namespaces;

    /**
     * Creates a new classloader
     * @param string $namespaces
     */
    public function __construct($namespaces) {
        $this->namespaces = $namespaces;
    }

    public function register() {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function loadClass($className) {
		foreach($this->namespaces as $ns => $path){
			$fileToLoad = $path . '/'.
					str_replace('\\', DIRECTORY_SEPARATOR, $className) . $this->fileExtension;
			if ($ns !== null && strpos($className, $ns . '\\') !== 0)
				continue;
			else {
				if (file_exists($fileToLoad) == true){
					require ( $fileToLoad );
					return true;
				}
				continue;
			}
		}
    }
}

?>
