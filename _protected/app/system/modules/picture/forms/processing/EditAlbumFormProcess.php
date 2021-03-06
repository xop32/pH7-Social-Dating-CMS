<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Picture / Form / Processing
 */
namespace PH7;
defined('PH7') or exit('Restricted access');

use PH7\Framework\Mvc\Router\Uri, PH7\Framework\Url\Header;

class EditAlbumFormProcess extends Form
{

    public function __construct()
    {
        parent::__construct();
        $iAlbumId = (int)$this->httpRequest->get('album_id');

        (new PictureModel)->updateAlbum($this->session->get('member_id'), $iAlbumId, $this->httpRequest->post('name'), $this->httpRequest->post('description'), $this->dateTime->get()->dateTime('Y-m-d H:i:s'));

        /* Clean PictureModel Cache */
        (new Framework\Cache\Cache)->start(PictureModel::CACHE_GROUP, null, null)->clear();

        Header::redirect(Uri::get('picture', 'main', 'albums', $this->session->get('member_username'), $iAlbumId), t('Your album has been updated successfully!'));
    }

}
