<?php

namespace Behat\Mink\Element;

use Behat\Mink\Exception\ElementNotFoundException;

/*
 * This file is part of the Behat\Mink.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Actions holder element.
 *
 * @author      Konstantin Kudryashov <ever.zet@gmail.com>
 */
abstract class ActionableElement extends Element
{
    /**
     * Finds link with specified locator.
     *
     * @param   string  $locator    link id, title, text or image alt
     *
     * @return  Behat\Mink\Element\NodeElement|null
     */
    abstract public function findLink($locator);

    /**
     * Finds button (input[type=submit|image|button], button) with specified locator.
     *
     * @param   string  $locator    button id, value or alt
     *
     * @return  Behat\Mink\Element\NodeElement|null
     */
    abstract public function findButton($locator);

    /**
     * Finds field (input, textarea, select) with specified locator.
     *
     * @param   string  $locator    input id, name or label
     *
     * @return  Behat\Mink\Element\NodeElement|null
     */
    abstract public function findField($locator);

    /**
     * Clicks link with specified locator.
     *
     * @param   string  $locator    link id, title, text or image alt
     *
     * @throws  Behat\Mink\Exception\ElementNotFoundException
     */
    public function clickLink($locator)
    {
        $link = $this->findLink($locator);

        if (null === $link) {
            throw new ElementNotFoundException('link', $locator);
        }

        $this->getSession()->getDriver()->click($link->getXpath());
    }

    /**
     * Clicks link with specified xpath.
     *
     * @param   string  $xpath    xpath
     */
    public function clickLinkByContent($content)
    {
        $this->getSession()->getDriver()->click("//a[contains(.,'".$content."')]");
    }

    /**
     * Clicks link with specified xpath.
     *
     * @param   string  $xpath    xpath
     */
    public function clickLinkByXpath($xpath)
    {
        $this->getSession()->getDriver()->click($xpath);
    }

    /**
     * Clicks button (input[type=submit|image|button], button) with specified locator.
     *
     * @param   string  $locator    button id, value or alt
     *
     * @throws  Behat\Mink\Exception\ElementNotFoundException
     */
    public function clickButton($locator)
    {
        $button = $this->findButton($locator);

        if (null === $button) {
            throw new ElementNotFoundException('button', $locator);
        }

        $this->getSession()->getDriver()->click($button->getXpath());
    }

    /**
     * Fills in field (input, textarea, select) with specified locator.
     *
     * @param   string  $locator    input id, name or label
     *
     * @throws  Behat\Mink\Exception\ElementNotFoundException
     */
    public function fillField($locator, $value)
    {
        $field = $this->findField($locator);

        if (null === $field) {
            throw new ElementNotFoundException('field', $field);
        }

        $this->getSession()->getDriver()->setValue($field->getXpath(), $value);
    }

    /**
     * Fills in field (input, textarea, select) with specified xpath.
     *
     * @param   string  $xpath    Xpath expression
     */
    public function fillFieldByXpath($xpath, $value)
    {
        $this->getSession()->getDriver()->setValue($xpath, $value);
    }

    /**
     * Checks checkbox with specified locator.
     *
     * @param   string  $locator    input id, name or label
     *
     * @throws  Behat\Mink\Exception\ElementNotFoundException
     */
    public function checkField($locator)
    {
        $field = $this->findField($locator);

        if (null === $field) {
            throw new ElementNotFoundException('field', $field);
        }

        $this->getSession()->getDriver()->check($field->getXpath());
    }

    /**
     * Checks checkbox with specified xpath.
     *
     * @param   string  $xpath    Xpath expression
     */
    public function checkFieldByXpath($xpath)
    {
        $this->getSession()->getDriver()->check($xpath);
    }

    /**
     * Unchecks checkbox with specified locator.
     *
     * @param   string  $locator    input id, name or label
     *
     * @throws  Behat\Mink\Exception\ElementNotFoundException
     */
    public function uncheckField($locator)
    {
        $field = $this->findField($locator);

        if (null === $field) {
            throw new ElementNotFoundException('field', $field);
        }

        $this->getSession()->getDriver()->uncheck($field->getXpath());
    }

    /**
     * Unchecks checkbox with specified xpath.
     *
     * @param   string  $xpath    Xpath expression
     */
    public function uncheckFieldByXpath($xpath)
    {
        $this->getSession()->getDriver()->uncheck($xpath);
    }

    /**
     * Selects option from select field with specified locator.
     *
     * @param   string  $locator    input id, name or label
     *
     * @throws  Behat\Mink\Exception\ElementNotFoundException
     */
    public function selectFieldOption($locator, $value)
    {
        $field = $this->findField($locator);

        if (null === $field) {
            throw new ElementNotFoundException('field', $field);
        }

        $this->getSession()->getDriver()->selectOption($field->getXpath(), $value);
    }

    /**
     * Attach file to file field with specified locator.
     *
     * @param   string  $locator    input id, name or label
     *
     * @throws  Behat\Mink\Exception\ElementNotFoundException
     */
    public function attachFileToField($locator, $path)
    {
        $field = $this->findField($locator);

        if (null === $field) {
            throw new ElementNotFoundException('field', $field);
        }

        $this->getSession()->getDriver()->attachFile($field->getXpath(), $path);
    }

    /**
     * Get attribute from element given as xpath
     *
     * @param   string  $xpath    xpath selector
     * @param   string  $attr    attribute to return
     *
     * @throws  Behat\Mink\Exception\ElementNotFoundException
     */
    public function getAttrByXpath($xpath, $attr)
    {
        $field = $this->findByXpath($xpath);
        if (null === $field) {
            throw new ElementNotFoundException('field', $field);
        }
        return $this->getSession()->getDriver()->getAttribute($xpath, $attr);
    }

    /**
     * Get text from element given as xpath
     *
     * @param   string  $xpath    xpath selector
     *
     * @throws  Behat\Mink\Exception\ElementNotFoundException
     */
    public function getTextByXpath($xpath)
    {
        $field = $this->findByXpath($xpath);
        if (null === $field) {
            throw new ElementNotFoundException('field', $field);
        }
        return $this->getSession()->getDriver()->getText($xpath);
    }
}
