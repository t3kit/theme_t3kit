<?php
namespace T3kit\themeT3kit\Hooks;

use \TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\PageLayoutView;

class ImageTextLinkPreviewRenderer implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface
{
	/**
	 * Preprocesses the preview rendering of the custom content element which has image and media image
	 *
	 * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
	 * @param bool $drawItem Whether to draw the item using the default functionalities
	 * @param string $headerContent Header content
	 * @param string $itemContent Item content
	 * @param array $row Record row of tt_content
	 * @return void
	 */
	public function preProcess(PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row) {
		if ($row['CType'] === 'imageTextLink') {
			if ($row['bodytext']) {
				$itemContent .= $parentObject->linkEditContent($parentObject->renderText($row['bodytext']), $row) . '<br />';
			}

			if ($row['image']) {
				$itemContent .= $parentObject->linkEditContent($parentObject->getThumbCodeUnlinked($row, 'tt_content', 'image'), $row);
				$fileReferences = BackendUtility::resolveFileReferences('tt_content', 'image', $row);

				if (!empty($fileReferences)) {
					$linkedContent = '';
					foreach ($fileReferences as $fileReference) {
						$description = $fileReference->getDescription();
						if ($description !== null && $description !== '') {
							$linkedContent .= htmlspecialchars($description) . '<br />';
						}
					}

					$itemContent .= $parentObject->linkEditContent($linkedContent, $row);
					unset($linkedContent);
				}
			}

			if ($row['media']) {
				$itemContent .= $parentObject->linkEditContent($parentObject->getThumbCodeUnlinked($row, 'tt_content', 'media'), $row);
			}
			if ($row['assets']) {
				$itemContent .= $parentObject->linkEditContent($parentObject->getThumbCodeUnlinked($row, 'tt_content', 'assets'), $row);
			}

			$drawItem = false;
		}
	}
}
