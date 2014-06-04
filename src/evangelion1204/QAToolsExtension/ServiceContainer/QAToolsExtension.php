<?php
/*
 * This file is part of QAToolsExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

namespace evangelion1204\QAToolsExtension\ServiceContainer;

use Behat\Behat\Context\ServiceContainer\ContextExtension;
use Behat\Mink\Mink;
use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use evangelion1204\QAToolsExtension\QATools;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;


class QAToolsExtension implements Extension
{

	const INITIALIZER_CLASS = 'evangelion1204\\QAToolsExtension\\Context\\Initializer\\QAToolsInitializer';

	/**
	 * @var QATools
	 */
	protected $qaTools;

	/**
	 * {@inheritdoc}
	 */
	public function getConfigKey()
	{
		return 'qa_tools';
	}

	/**
	 * {@inheritdoc}
	 */
	public function initialize(ExtensionManager $extensionManager)
	{

	}

	/**
	 * {@inheritdoc}
	 */
	public function configure(ArrayNodeDefinition $builder)
	{
		$builder
			->children()
				->arrayNode('qa_tools')
					->children()
						->scalarNode('base_url')
							->defaultNull()
						->end()
					->end()
				->end()
				->arrayNode('namespace')
					->children()
						->scalarNode('pages')
							->defaultNull()
						->end()
						->scalarNode('elements')
							->defaultNull()
						->end()
					->end()
				->end()
				->arrayNode('users')
					->prototype('array')
						->children()
							->scalarNode('firstname')->end()
							->scalarNode('lastname')->end()
						->end()
				->end()
			->end();
	}

	/**
	 * {@inheritdoc}
	 */
	public function load(ContainerBuilder $container, array $config)
	{
		$this->loadQATools($container, $config);
		$this->loadInitializer($container);
	}

	protected function loadQATools(ContainerBuilder $container, array $config)
	{
		/** @var Mink $mink */
		$mink = $container->get('mink');
		$this->qaTools = new QATools($mink, $config);
	}

	protected function loadInitializer(ContainerBuilder $container)
	{
		$definition = new Definition(self::INITIALIZER_CLASS, array($this->qaTools));
		$definition->addTag(ContextExtension::INITIALIZER_TAG, array('priority' => 0));
		$container->setDefinition('qa-tools.context_initializer', $definition);
	}

	/**
	 * {@inheritDoc}
	 */
	public function process(ContainerBuilder $container)
	{
		echo 'process';
	}
}
