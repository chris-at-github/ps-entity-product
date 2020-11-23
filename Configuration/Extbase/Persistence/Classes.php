<?php

// @see: https://docs.typo3.org/m/typo3/book-extbasefluid/master/en-us/6-Persistence/4-use-foreign-data-sources.html
return [
	\Ps\EntityProduct\Domain\Model\Product::class => [
		'tableName' => 'tx_entity_domain_model_entity',
		'recordType' => \Ps\EntityProduct\Domain\Model\Product::class,
		'properties' => []
	],
];