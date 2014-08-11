<?php

namespace JetCharters\AppBundle\Service;

/**
 * Vzaar helper
 *
 * @author Jonathan McDill <jonathan.mcdill@gmail.com>
 */
class VzaarHelper
{

	private $upload_helper;
	private $gaufrette_filesystem;

    /**
     * Constructor
     */
    public function __construct($vich_upload_helper, $gaufrette_filesystem)
    {
    	$this->upload_helper = $vich_upload_helper;
    	$this->gaufrette_filesystem = $gaufrette_filesystem;
    }

    public function getVideo($entity, $propertyName)
    {
    	$video_info = array();

        if ($entity->getVideoName() != NULL)
        {
            $id = preg_replace('/[^0-9]+/i', '', $this->upload_helper->asset($entity, $propertyName));

            $fs = $this->gaufrette_filesystem->get('video_fs');
            $video = $fs->read($id);

            $video_info['video_embed'] = $video->html;
            $video_info['vzaar_status'] = $video->videoStatusDescription;
            $video_info['thumbnail'] = $video->thumbnailUrl;
        }
        else
        {
            $video_info['video_embed'] = "";
            $video_info['vzaar_status'] = "No video";
            $video_info['thumbnail'] = 'http://icons.iconarchive.com/icons/kyo-tux/phuzion/128/Misc-Video-icon.png';
        }

        return $video_info;
    }
}
