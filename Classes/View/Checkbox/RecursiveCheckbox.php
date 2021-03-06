<?php
namespace Fab\Media\View\Checkbox;

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

use Fab\Media\Module\MediaModule;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Fab\Vidi\View\AbstractComponentView;

/**
 * View which renders a checkbox for recursive file browsing.
 */
class RecursiveCheckbox extends AbstractComponentView
{

    /**
     * @var \Fab\Vidi\Module\ModuleLoader
     * @inject
     */
    protected $moduleLoader;

    /**
     * Renders a checkbox for recursive file browsing.
     *
     * @return string
     */
    public function render()
    {

        $output = '';
        if ($this->isDisplayed()) {
            $this->loadRequireJsCode();
            $output = $this->renderRecursiveCheckbox();
        }

        return $output;
    }

    /**
     * @return string
     */
    protected function isDisplayed()
    {
        $isDisplayed = $this->getMediaModule()->hasFolderTree();
        if ($this->getModuleLoader()->hasPlugin()) {
            $isDisplayed = FALSE;
        }
        return $isDisplayed;
    }

    /**
     * @return string
     */
    protected function renderRecursiveCheckbox()
    {

        $template = '<form action="%s" id="form-checkbox-hasRecursiveSelection" method="get">
						<label>
							<input type="checkbox"
									name="%s[hasRecursiveSelection]"
									checked="checked"
									class="btn btn-min"
									id="checkbox-hasRecursiveSelection"/>
							<span style="position: relative; top: 3px">%s</span>
						</label>
					</form>';

        return sprintf(
            $template,
            $this->getModuleLoader()->getModuleUrl(),
            $this->moduleLoader->getParameterPrefix(),
            $this->getLanguageService()->sL('LLL:EXT:media/Resources/Private/Language/locallang.xlf:browse_subfolders')
        );
    }

    /**
     * @return void
     */
    protected function loadRequireJsCode()
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);

        $configuration['paths']['Fab/Media'] = '../typo3conf/ext/media/Resources/Public/JavaScript';
        $pageRenderer->addRequireJsConfiguration($configuration);
        $pageRenderer->loadRequireJsModule('Fab/Media/BrowseRecursively');
    }


    /**
     * @return MediaModule
     */
    protected function getMediaModule()
    {
        return GeneralUtility::makeInstance('Fab\Media\Module\MediaModule');
    }

}
