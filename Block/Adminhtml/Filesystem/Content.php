<?php
namespace Flagbit\Flysystem\Block\Adminhtml\Filesystem;

use \Magento\Backend\Block\Widget\Container;
use \Magento\Backend\Block\Widget\Context;
use \Magento\Framework\Serialize\Serializer\Json;

/**
 * Class Content
 * @package Flagbit\Flysystem\Block\Adminhtml\Filesystem
 */
class Content extends Container
{
    /**
     * @var Json
     */
    protected $_jsonEncoder;

    /**
     * Content constructor.
     * @param Context $context
     * @param Json $jsonEncoder
     * @param array $data
     */
    public function __construct(
        Context $context,
        Json $jsonEncoder,
        array $data = []
    ) {
        $this->_jsonEncoder = $jsonEncoder;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->_headerText = __('File Storage');
        $this->buttonList->remove('back');
        $this->buttonList->remove('edit');
        $this->buttonList->add(
            'new_folder',
            ['class' => 'save', 'label' => __('Create Folder...'), 'type' => 'button'],
            0,
            0,
            'header'
        );

        $this->buttonList->add(
            'delete_folder',
            ['class' => 'delete no-display', 'label' => __('Delete Folder'), 'type' => 'button'],
            0,
            0,
            'header'
        );

        $this->buttonList->add(
            'delete_files',
            ['class' => 'delete no-display', 'label' => __('Delete File'), 'type' => 'button'],
            0,
            0,
            'header'
        );

        $this->buttonList->add(
            'insert_files',
            ['class' => 'save no-display primary', 'label' => __('Insert File'), 'type' => 'button'],
            0,
            0,
            'header'
        );
    }

    /**
     * @return bool|string
     */
    public function getFilebrowserSetupObject()
    {
        $setupObject = [
            'newFolderPrompt' => __('New Folder Name:'),
            'deleteFolderConfirmationMessage' => __('Are you sure you want to delete this folder?'),
            'deleteFileConfirmationMessage' => __('Are you sure you want to delete this file?'),
            'targetElementId' => $this->getTargetElementId(),
            'contentsUrl' => $this->getContentsUrl(),
            'onInsertUrl' => $this->getOnInsertUrl(),
            'newFolderUrl' => $this->getNewfolderUrl(),
            'deleteFolderUrl' => $this->getDeletefolderUrl(),
            'deleteFilesUrl' => $this->getDeleteFilesUrl(),
            'headerText' => $this->getHeaderText(),
            'showBreadcrumbs' => true,
        ];

        return $this->_jsonEncoder->serialize($setupObject);
    }

    /**
     * @return string
     */
    public function getContentsUrl()
    {
        return $this->getUrl('flagbit_flysystem/*/contents');
    }

    /**
     * @return string
     */
    public function getOnInsertUrl()
    {
        return $this->getUrl('flagbit_flysystem/*/onInsert');
    }

    /**
     * @return string
     */
    public function getNewfolderUrl()
    {
        return $this->getUrl('flagbit_flysystem/*/newFolder');
    }

    /**
     * @return string
     */
    protected function getDeletefolderUrl()
    {
        return $this->getUrl('flagbit_flysystem/*/deleteFolder');
    }

    /**
     * @return string
     */
    public function getDeleteFilesUrl()
    {
        return $this->getUrl('flagbit_flysystem/*/deleteFiles');
    }

    /**
     * @return mixed
     */
    public function getTargetElementId()
    {
        return $this->getRequest()->getParam('target_element_id');
    }

    /**
     * @return mixed
     */
    public function getModalIdentifier()
    {
        return $this->getRequest()->getParam('identifier');
    }
}