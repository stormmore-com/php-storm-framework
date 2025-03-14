<?php

namespace Stormmore\Framework\SourceCode\Scanners;

use Exception;
use Stormmore\Framework\SourceCode\Parser\PhpClassFileParser;

class ClassScanner
{
    private array $directories;

    function __construct(...$directories)
    {
        $this->directories = $directories;
    }

    /**
     * @throws Exception
     */
    public function scan(): array
    {
        $classes = [];
        foreach ($this->getPhpFiles() as $phpFilePath) {
            $fileClasses = PhpClassFileParser::parse($phpFilePath);
            foreach($fileClasses as $class) {
                $classes[$class->getFullyQualifiedName()] = $phpFilePath;
            }
        }
        return $classes;
    }

    /**
     * @throws Exception
     */
    private function getPhpFiles(): array
    {
        $phpFiles = array();
        foreach ($this->directories as $directory) {
            is_dir($directory) or throw new Exception("ClassScanner: path [$directory] it's not directory");

            $directoryPhpFiles = $this->searchPhpFiles($directory);
            $phpFiles = array_merge($directoryPhpFiles, $phpFiles);
        }

        return $phpFiles;
    }

    private function searchPhpFiles($directory): array
    {
        $phpFiles = [];
        $resources = array_diff(scandir($directory), array('.', '..'));
        foreach ($resources as $resource) {
            $path = $directory . '/' . $resource;
            if (is_dir($path)) {
                $phpFiles = array_merge($phpFiles, $this->searchPhpFiles($path));
            } else if (str_ends_with($path, ".php")) {
                $phpFiles[] = $path;
            }
        }

        return $phpFiles;
    }
}