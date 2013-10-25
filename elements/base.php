<?php
/**
 * @version     $Id: base.php 1623 2012-09-21 14:45:25Z lefteris.kavadas $
 * @package     K2
 * @author      JoomlaWorks http://www.joomlaworks.net
 * @copyright   Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die ;


    jimport('joomla.form.formfield');
    class K2Element extends JFormField
    {

        function getInput()
        {
            return $this->fetchElement($this->name, $this->value, $this->element, $this->options['control']);
        }

        function getLabel()
        {
            if (method_exists($this, 'fetchTooltip'))
            {
                return $this->fetchTooltip($this->element['label'], $this->description, $this->element, $this->options['control'], $this->element['name'] = '');
            }
            else
            {
                return parent::getLabel();
            }

        }

        function render()
        {
            return $this->getInput();
        }

    }


