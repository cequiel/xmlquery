<?php
/**
 * This file contains the CssParserFilterPseudoEq class.
 * 
 * PHP Version 5.3
 * 
 * @category Css
 * @package  CssParser
 * @author   Gonzalo Chumillas <gonzalo@soloproyectos.com>
 * @license  https://raw2.github.com/soloproyectos/php.common-libs/master/LICENSE BSD 2-Clause License
 * @link     https://github.com/soloproyectos/php.common-libs
 */
namespace com\soloproyectos\common\css\parser\filter;
use DOMElement;
use com\soloproyectos\common\css\parser\filter\CssParserFilterPseudo;

/**
 * Class CssParserFilterPseudoEq.
 * 
 * This class represents the first-child pseudo filter.
 * 
 * @category Css
 * @package  CssParser
 * @author   Gonzalo Chumillas <gonzalo@soloproyectos.com>
 * @license  https://raw2.github.com/soloproyectos/php.common-libs/master/LICENSE BSD 2-Clause License
 * @link     https://github.com/soloproyectos/php.common-libs
 */
class CssParserFilterPseudoEq extends CssParserFilterPseudo
{
    /**
     * Sibling position.
     * @var integer
     */
    private $_position;
    
    /**
     * Constructor.
     * 
     * @param string $input String input
     */
    public function __construct($input)
    {
        $this->_position = intval($input);
    }
    
    /**
     * Does the node match?
     * 
     * @param DOMElement $node     DOMElement object
     * @param integer    $position Node position
     * @param array      $items    List of nodes
     * 
     * @return boolean
     */
    public function match($node, $position, $items)
    {
        return $this->_position == $position;
    }
}
