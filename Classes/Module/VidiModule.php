<?php
namespace Fab\Media\Module;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class for retrieving information about the Media module.
 */
class VidiModule
{

    const SIGNATURE = 'file_VidiSysFileM1';
    const PARAMETER_PREFIX = 'tx_vidi_file_vidisysfilem1';

    const SIGNATURE_FOLDER_TREE_OMITTED = 'content_VidiSysFileM1';
    const PARAMETER_PREFIX_FOLDER_TREE_OMITTED = 'tx_vidi_content_vidisysfilem1';

    /**
     * @return string
     */
    static public function getSignature()
    {
        return self::getMediaModule()->hasFolderTree() ? self::SIGNATURE : self::SIGNATURE_FOLDER_TREE_OMITTED;
    }

    /**
     * @return string
     */
    static public function getParameterPrefix()
    {
        return self::getMediaModule()->hasFolderTree() ? self::PARAMETER_PREFIX : self::PARAMETER_PREFIX_FOLDER_TREE_OMITTED;
    }

    /**
     * @return MediaModule
     */
    static protected function getMediaModule()
    {
        return GeneralUtility::makeInstance('Fab\Media\Module\MediaModule');
    }
}