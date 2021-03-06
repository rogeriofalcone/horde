<?php
/**
 * Horde_ActiveSync_Message_AirSyncBaseFileAttachment::
 *
 * Portions of this class were ported from the Z-Push project:
 *   File      :   wbxml.php
 *   Project   :   Z-Push
 *   Descr     :   WBXML mapping file
 *
 *   Created   :   01.10.2007
 *
 *   � Zarafa Deutschland GmbH, www.zarafaserver.de
 *   This file is distributed under GPL-2.0.
 *   Consult COPYING file for details
 *
 * @license   http://www.horde.org/licenses/gpl GPLv2
 *            NOTE: According to sec. 8 of the GENERAL PUBLIC LICENSE (GPL),
 *            Version 2, the distribution of the Horde_ActiveSync module in or
 *            to the United States of America is excluded from the scope of this
 *            license.
 * @copyright 2011-2013 Horde LLC (http://www.horde.org)
 * @author    Michael J Rubinsky <mrubinsk@horde.org>
 * @package   ActiveSync
 */
/**
 * Horde_ActiveSync_Message_AirSyncFileAttachment::
 *
 * @license   http://www.horde.org/licenses/gpl GPLv2
 *            NOTE: According to sec. 8 of the GENERAL PUBLIC LICENSE (GPL),
 *            Version 2, the distribution of the Horde_ActiveSync module in or
 *            to the United States of America is excluded from the scope of this
 *            license.
 * @copyright 2011-2013 Horde LLC (http://www.horde.org)
 * @author    Michael J Rubinsky <mrubinsk@horde.org>
 * @package   ActiveSync
 *
 * @property string contenttype   The content type of the attachment.
 * @property mixed string|stream  The attachment data.
 * @property integer total        The total size of the attachment.
 * @property integer range        @todo
 */
class Horde_ActiveSync_Message_AirSyncBaseFileAttachment extends Horde_ActiveSync_Message_Base
{
    /**
     * Property map
     *
     * @var array
     */
    protected $_mapping = array(
        Horde_ActiveSync_Request_ItemOperations::ITEMOPERATIONS_RANGE => array(self::KEY_ATTRIBUTE => 'range'),
        Horde_ActiveSync_Request_ItemOperations::ITEMOPERATIONS_TOTAL => array(self::KEY_ATTRIBUTE => 'total'),
        Horde_ActiveSync::AIRSYNCBASE_CONTENTTYPE => array(self::KEY_ATTRIBUTE => 'contenttype'),
        Horde_ActiveSync_Request_ItemOperations::ITEMOPERATIONS_DATA => array(self::KEY_ATTRIBUTE => 'data')
    );

    /**
     * Property values
     *
     * @var array
     */
    protected $_properties = array(
        'range' => false,
        'total' => false,
        'contenttype' => false,
        'data' => false,
    );

    /**
     * Return the message type.
     *
     * @return string
     */
    public function getClass()
    {
        return 'AirSyncBaseFileAttachment';
    }

    /**
     * Checks if the data needs to be encoded like e.g., when outputing binary
     * data in-line during ITEMOPERATIONS requests.
     *
     * @param mixed  $data  The data to check. A string or stream resource.
     * @param string $tag   The tag we are outputing.
     *
     * @return mixed  The encoded data. A string or stream resource with
     *                a filter attached.
     */
    protected function _checkEncoding($data, $tag)
    {
        if ($tag == Horde_ActiveSync_Request_ItemOperations::ITEMOPERATIONS_DATA) {
            if (is_resource($data)) {
                stream_filter_append($data, 'convert.base64-encode', STREAM_FILTER_READ);
            } else {
                $data = base64_encode($data);
            }
        }

        return $data;
    }

}
