<?php
/*
 * This file is part of BehatExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

namespace QATools\BehatExtension\ServiceContainer;


use Behat\Behat\Context\ServiceContainer\ContextExtension;
use Behat\Mink\Mink;
use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use QATools\BehatExtension\QATools;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class BehatExtension implements Extension
{

	const INITIALIZER_CLASS = 'QATools\\BehatExtension\\Context\\Initializer\\QAToolsInitializer';

	/**
	 * QA-Tools instance.
	 *
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

	/**
	 * Load and create QA-Tools.
	 *
	 * @param ContainerBuilder $container Given container builder.
	 * @param array            $config    Config.
	 *
	 * @return void
	 */
	protected function loadQATools(ContainerBuilder $container, array $config)
	{
		/** @var Mink $mink */
		$mink = $container->get('mink');
		$this->qaTools = new QATools($mink, $config);
	}

	/**
	 * Load initializer.
	 *
	 * @param ContainerBuilder $container Given container builder.
	 *
	 * @return void
	 */
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

