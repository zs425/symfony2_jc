<?php

namespace JetCharters\AppBundle\Service;

use Gaufrette\Adapter;
use Gaufrette\Util;
use Gaufrette\Exception;
use Andheiberg\Vzaar\Vzaar;
/**
 * Vzaar Gaufrette Adapter
 *
 * @author Jonathan McDill <jonathan.mcdill@gmail.com>
 */
class VzaarGaufretteAdapter implements Adapter, \Vich\UploaderBundle\Naming\NamerInterface
{

    private $vzaar;
    private $guid;

    /**
     * Constructor
     */
    public function __construct($vzaar_token, $vzaar_secret)
    {
        $this->vzaar = new Vzaar($vzaar_token, $vzaar_secret);
    }

    public function read($key)
    {
        $video = $this->vzaar->videoDetails($key, true);

        return $video;
    }

    public function write($key, $content)
    {
        return true;
    }

    public function name($obj, \Vich\UploaderBundle\Mapping\PropertyMapping $field) {

        $auth = $this->vzaar->whoAmI();
        if ($auth->vzaar_api->test->login == "Not Authorized") die("Vzaar API not authorized");

        $refObj = new \ReflectionObject($obj);

        $refProp = $refObj->getProperty('video');
        $refProp->setAccessible(true);

        $file = $refProp->getValue($obj);
        // die(var_dump($file));

        try {
            $guid = $this->vzaar->uploadVideo($file);
            $video = $this->vzaar->processVideo($guid, 'Test', 'Test', 1); // TODO: get description, etc
        } catch (\Exception $e) {
            throw $e;
        }

        return $video;
    }

    public function delete($key)
    {
        return $this->vzaar->deleteVideo($key);
    }

    public function rename($sourceKey, $targetKey)
    {
        return true;
    }

    public function mtime($key)
    {
        return true; //strtotime($metadata['modified']);
    }

    public function keys()
    {
        return true;
    }

    public function exists($key)
    {
        return true;
    }

    public function isDirectory($key) {

    }

    public function listKeys() {

    }
}
