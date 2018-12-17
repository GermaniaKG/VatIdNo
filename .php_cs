<?php
$header = "";

$finder = PhpCsFixer\Finder::create()
	->in(__DIR__.'/src')
	->in(__DIR__.'/tests/src')
;

return PhpCsFixer\Config::create()
	->setRules([
		'@PSR2' => true,
		'no_alternative_syntax' => false
	])
	->setFinder($finder)
;

