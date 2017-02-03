<?php

namespace T3kit\themeT3kit\Xclass;

use TYPO3\CMS\Backend\Template\Components\Buttons\InputButton;
use TYPO3\CMS\Backend\Template\Components\Buttons\SplitButton;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;

class DefaultSplitButton extends SplitButton {

    protected $defaultButtonSet = FALSE;

    /**
     * Returns the current button
     *
     * @return array
     */
    public function getButton()
    {
        if (! $this->defaultButtonSet) {
            $user = $this->getBackendUser();
            if (isset($user->user['default_save_button']) && ! empty($user->user['default_save_button'])) {
                $defaultButtonAction = $user->user['default_save_button'];
            } else {
                return parent::getButton();
            }

            $primaryAction = NULL;
            if (isset($this->items['primary'])) {
                /** @var InputButton $primaryAction */
                $primaryAction = $this->items['primary'];
                if ($defaultButtonAction == $primaryAction->getName()) {
                    $this->defaultButtonSet = TRUE;
                    return $this->items;
                }
            }

            if (isset($this->items['options'])) {
                /** @var InputButton $availableOption */
                foreach ($this->items['options'] as $key => $availableOption) {
                    if ($defaultButtonAction == $availableOption->getName()) {
                        $this->items['primary'] = $availableOption;
                        $this->defaultButtonSet = TRUE;
                        unset($this->items['options'][$key]);

                        if ($primaryAction) {
                            array_unshift($this->items['options'], $primaryAction);
                        }
                        break;
                    }
                }

                if (! isset($this->items['primary'])) {
                    $primaryAction = array_shift($this->items['options']);
                    $this->items['primary'] = $primaryAction;
                }
            }
        }
        return $this->items;
    }

    /**
     * @return BackendUserAuthentication
     */
    protected function getBackendUser()
    {
        return $GLOBALS['BE_USER'];
    }
}
