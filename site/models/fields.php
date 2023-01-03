<?php
/**
 * @version    SVN: <svn_id>
 * @package    Tjfields
 * @author     Techjoomla <extensions@techjoomla.com>
 * @copyright  Copyright (c) 2009-2018 TechJoomla. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Table\Table;

jimport('joomla.application.component.modellist');

/**
 * Tjfields model.
 *
 * @since  2.2
 */
class TjfieldsModelFields extends ListModel
{
	/**
	 * Function used for getting the storage path of file field
	 *
	 * @param   integer  $fieldValueId        field value id
	 *
	 * @param   integer  $subformFileFieldId  subform file field id
	 *
	 * @return  object
	 */
	public function getMediaStoragePath($fieldValueId, $subformFileFieldId='0')
	{
		$fieldData = new stdClass;

		Table::addIncludePath(JPATH_ROOT . '/administrator/components/com_tjfields/tables');
		$tjFieldFieldValuesTable = Table::getInstance('fieldsvalue', 'TjfieldsTable');
		$tjFieldFieldValuesTable->load(array('id' => $fieldValueId));

		Table::addIncludePath(JPATH_ROOT . '/administrator/components/com_tjfields/tables');
		$fieldData->tjFieldFieldTable = Table::getInstance('field', 'TjfieldsTable');

		if ($subformFileFieldId)
		{
			$fieldData->tjFieldFieldTable->load(array('id' => $subformFileFieldId));
		}
		else
		{
			$fieldData->tjFieldFieldTable->load(array('id' => $tjFieldFieldValuesTable->field_id));
		}

		$fieldData->tjFieldFieldTable->field_id = $tjFieldFieldValuesTable->field_id;
		$fieldData->tjFieldFieldTable->user_id = $tjFieldFieldValuesTable->user_id;
		$fieldData->tjFieldFieldTable->fieldValueId = $tjFieldFieldValuesTable->id;

		return $fieldData;
	}
}
