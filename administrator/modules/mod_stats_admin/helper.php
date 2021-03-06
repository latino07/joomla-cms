<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_stats_admin
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * @package     Joomla.Administrator
 * @subpackage  mod_stats_admin
 * @since       3.0
 */
class modStatsHelper
{
	/**
	 * Method to retrieve information about the site
	 *
	 * @param   JObject  $params  Params object
	 *
	 * @return  array  Array containing site information
	 *
	 * @since   3.0
	 */
	public static function getStats(&$params)
	{
		$app   = JFactory::getApplication();
		$db    = JFactory::getDbo();
		$rows  = array();
		$query = $db->getQuery(true);

		$serverinfo = $params->get('serverinfo');
		$siteinfo   = $params->get('siteinfo');
		$counter    = $params->get('counter');
		$increase   = $params->get('increase');

		$i = 0;
		if ($serverinfo)
		{
			$rows[$i]        = new stdClass;
			$rows[$i]->title = JText::_('MOD_STATS_OS');
			$rows[$i]->icon  = 'screen';
			$rows[$i]->data  = substr(php_uname(), 0, 7);
			$i++;

			$rows[$i]        = new stdClass;
			$rows[$i]->title = JText::_('MOD_STATS_PHP');
			$rows[$i]->icon  = 'cogs';
			$rows[$i]->data  = phpversion();
			$i++;

			$rows[$i]        = new stdClass;
			$rows[$i]->title = JText::_($db->name);
			$rows[$i]->icon  = 'database';
			$rows[$i]->data  = $db->getVersion();
			$i++;

			$rows[$i]        = new stdClass;
			$rows[$i]->title = JTEXT::_('MOD_STATS_TIME');
			$rows[$i]->icon  = 'clock';
			$rows[$i]->data  = JHtml::_('date', 'now', 'H:i');
			$i++;

			$rows[$i]        = new stdClass;
			$rows[$i]->title = JText::_('MOD_STATS_CACHING');
			$rows[$i]->icon  = 'dashboard';
			$rows[$i]->data  = $app->getCfg('caching') ? JText::_('JENABLED') : JText::_('JDISABLED');
			$i++;

			$rows[$i]        = new stdClass;
			$rows[$i]->title = JText::_('MOD_STATS_GZIP');
			$rows[$i]->icon  = 'lightning';
			$rows[$i]->data  = $app->getCfg('gzip') ? JText::_('JENABLED') : JText::_('JDISABLED');
			$i++;
		}

		if ($siteinfo)
		{
			$query->select('COUNT(id) AS count_users');
			$query->from('#__users');
			$db->setQuery($query);
			$users = $db->loadResult();

			$query->clear();
			$query->select('COUNT(id) AS count_items');
			$query->from('#__content');
			$query->where('state = 1');
			$db->setQuery($query);
			$items = $db->loadResult();

			$query->clear();
			$query->select('COUNT(id) AS count_links ');
			$query->from('#__weblinks');
			$query->where('state = 1');
			$db->setQuery($query);
			$links = $db->loadResult();

			if ($users)
			{
				$rows[$i]        = new stdClass;
				$rows[$i]->title = JText::_('MOD_STATS_USERS');
				$rows[$i]->icon  = 'users';
				$rows[$i]->data  = $users;
				$i++;
			}

			if ($items)
			{
				$rows[$i]        = new stdClass;
				$rows[$i]->title = JText::_('MOD_STATS_ARTICLES');
				$rows[$i]->icon  = 'file';
				$rows[$i]->data  = $items;
				$i++;
			}

			if ($links)
			{
				$rows[$i]        = new stdClass;
				$rows[$i]->title = JText::_('MOD_STATS_WEBLINKS');
				$rows[$i]->icon  = 'out-2';
				$rows[$i]->data  = $links;
				$i++;
			}
		}

		if ($counter)
		{
			$query->clear();
			$query->select('SUM(hits) AS count_hits');
			$query->from('#__content');
			$query->where('state = 1');
			$db->setQuery($query);
			$hits = $db->loadResult();

			if ($hits)
			{
				$rows[$i]        = new stdClass;
				$rows[$i]->title = JText::_('MOD_STATS_ARTICLES_VIEW_HITS');
				$rows[$i]->icon  = 'eye';
				$rows[$i]->data  = $hits + $increase;
			}
		}

		return $rows;
	}
}
