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


use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use QATools\BehatExtension\QATools;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class BehatExtension implements Extension
{

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
						->arrayNode('page_namespace_prefix')
							->requiresAtLeastOneElement()
							->prototype('scalar')->end()
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
				->end()
				->scalarNode('page_factory')
					->defaultValue('\QATools\QATools\HtmlElements\TypifiedPageFactory')
				->end()
			->end();
	}

	/**
	 * {@inheritdoc}
	 */
	public function load(ContainerBuilder $container, array $config)
	{
		$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
		$loader->load('config/services.yaml');

		$container->setParameter('qa_tools.behat-extension.config', $config);
	}

	/**
	 * {@inheritDoc}
	 */
	public function process(ContainerBuilder $container)
	{
	}

}

