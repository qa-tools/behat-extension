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

use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class QAToolsExtension implements Extension
{

	const INITIALIZER_CLASS = 'evangelion1204\\QAToolsExtension\\Context\\Initializer\\QAToolsInitializer';

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
				->scalarNode('base_url')
					->defaultNull()
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

	}

	protected function loadInitializer(ContainerBuilder $container)
	{
		$definition = new Definition(self::INITIALIZER_CLASS, array(
			new Reference(self::MINK_ID),
			'%mink.parameters%',
		));
		$definition->addTag(ContextExtension::INITIALIZER_TAG, array('priority' => 0));
		$container->setDefinition('mink.context_initializer', $definition);
	}

	/**
	 * {@inheritDoc}
	 */
	public function process(ContainerBuilder $container)
	{
		echo 'process';
	}
}
