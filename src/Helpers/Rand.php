<?php
// I took this class from:
// https://github.com/beberlei/DoctrineExtensions/blob/master/src/Query/Mysql/Rand.php
namespace App\Helpers;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\AST\SimpleArithmeticExpression;
use Doctrine\ORM\Query\Lexer;

class Rand extends FunctionNode
{
    /**
     * @var SimpleArithmeticExpression
     */
    private $expression = null;

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        if ($this->expression) {
            return 'RAND(' . $this->expression->dispatch($sqlWalker) . ')';
        }

        return 'RAND()';
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $lexer = $parser->getLexer();
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        if (Lexer::T_CLOSE_PARENTHESIS !== $lexer->lookahead['type']) {
            $this->expression = $parser->SimpleArithmeticExpression();
        }

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
