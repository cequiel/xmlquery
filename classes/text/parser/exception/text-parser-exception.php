<?php
/**
 * This file is part of Soloproyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos/php.common-libs/blob/master/LICENSE BSD 2-Clause License
 * @link    https://github.com/soloproyectos/php.common-libs
 */
namespace com\soloproyectos\common\text\parser\exception;
use com\soloproyectos\common\text\parser\TextParser;
use com\soloproyectos\common\text\exception\TextException;

/**
 * class TextParserException
 *
 * @package Text\Parser\Exception
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos/php.common-libs/blob/master/LICENSE BSD 2-Clause License
 * @link    https://github.com/soloproyectos/php.common-libs
 */
class TextParserException extends TextException
{
    /**
     * The parser instance that threw the exception.
     * @var TextParser
     */
    private $_parser;

    /**
     * Constructor.
     *
     * @param string     $message The exception message
     * @param TextParser $parser  The parser object (default is null)
     */
    public function __construct($message, $parser = null)
    {
        $this->_parser = $parser;
        parent::__construct($message);
    }

    /**
     * Gets a printable message.
     *
     * This function provides a method to get printable messages.
     *
     * @return string
     */
    public function getPrintableMessage()
    {
        $ret = $this->message;

        if ($this->_parser != null) {
            $string = rtrim($this->_parser->getString());
            $offset = $this->_parser->getOffset();

            $rightStr = substr($string, $offset);
            $offset0 = $offset + strlen($rightStr) - strlen(ltrim($rightStr));

            $str1 = substr($string, 0, $offset0);
            $offset1 = strrpos($str1, "\n");
            if ($offset1 !== false) {
                $offset1++;
            }

            $str2 = substr($string, $offset1);
            $offset2 = strpos($str2, "\n");
            if ($offset2 === false) {
                $offset2 = strlen($str2);
            }

            $str3 = substr($str2, 0, $offset2);
            $line = $offset0 > 0? substr_count($string, "\n", 0, $offset0) : 0;
            $column = $offset0 - $offset1;

            $ret = "$str3\n" . str_repeat(" ", $column) . "^" . $this->message;
            if ($line > 0) {
                $ret .= " (line " . ($line + 1) . ")";
            }
        }

        return $ret;
    }

    /**
     * Gets a string representation of the instance.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . ":\n\n" . $this->getPrintableMessage() . "\n";
    }
}
